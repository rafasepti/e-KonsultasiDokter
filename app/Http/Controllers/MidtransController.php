<?php

namespace App\Http\Controllers;

use App\Events\NewDataCreated;
use App\Models\Dokter;
use App\Models\Janji;
use App\Models\OrderChat;
use App\Models\Pasien;
use App\Models\PGPenjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Chatify\Facades\ChatifyMessenger as Chatify;

class MidtransController extends Controller
{
    //untuk contoh sederhana midtrans
    public function index(Request $request)
    {
        // definisikan parameter midtrans
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(), //idpesanan ini nanti dpt diambil dari no_pesanan
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'bambang',
                'last_name' => 'suhendro',
                'email' => 'bams@gmail.com',
                'phone' => '0821142334',
            ),
        );
         
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        return view(    'midtrans/view',
                        [
                            'snap_token' => $snapToken,
                        ]
        );
    }

    // // cek status
    public function cekstatus(){    
        //query data transaksi yang masih pending	
		//$hasil = Pembayaran::viewstatusPGAll();
        $hasil = OrderChat::viewstatusPGAll();
        $id = array();
        $no_transaksi = array();
		foreach($hasil as $ks){
			array_push($id,$ks->order_id);
            array_push($no_transaksi,$ks->no_transaksi);
		}
        for($i=0; $i<count($id); $i++){
            $ch = curl_init(); 
            $login = env('MIDTRANS_SERVER_KEY');
            $password = '';
            $orderid = $id[$i];
            $no_transaksi = $no_transaksi[$i];
            $URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
            $output = curl_exec($ch); 
            curl_close($ch);    
            $outputjson = json_decode($output, true);
            // var_dump($outputjson);

            $affected = DB::update(
                'update pg_penjualan 
                 set status_code = ?,
                     transaction_status = ?,
                     transaction_time = ?,
                     settlement_time = ?,
                     status_message = ?,
                     merchant_id = ?
                 where order_id = ?',
                [
                    $outputjson['status_code'],
                    $outputjson['transaction_status'],
                    $outputjson['transaction_time'],
                    $outputjson['settlement_time'],
                    $outputjson['status_message'],
                    $outputjson['merchant_id'],
                    $orderid
                ]
            );

            // simpan data
            $empData = ['no_transaksi' => $no_transaksi, 'tgl_bayar' => $outputjson['transaction_time'], 'bukti_bayar' => 'midtrans-logo.png', 'jenis_pembayaran' => 'pg', 'status' => 'approved'];
            OrderChat::create($empData);

            // update status
            $affected = DB::table('penjualan')
              ->where('no_transaksi', $no_transaksi)
              ->update(['status' => 'selesai']);
        }

        return view('midtrans/autorefresh');
    }

    // proses bayar
    public function prosesBayar(Request $request){
        $pasien = Pasien::where('id', $request->pasien_id)->first();
        if($pasien->jk == '' || $pasien->tgl_lahir == '' || $pasien->bb == '' || $pasien->tb == ''){
            $request->validate([
                'jk1' => 'required',
                'tgl_lahir1' => 'required',
                'bb1' => 'required',
                'tb1' => 'required',
            ]);

            $data_pasien = Pasien::where('id', $request->pasien_id)->update([
                'jk' => $request->jk1,
                'tgl_lahir' => $request->tgl_lahir1,
                'bb' => $request->bb1,
                'tb' => $request->tb1,
            ]);
        }
        $order_chat = OrderChat::create([
            'user_id' => Auth::id(),
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'total_bayar' => $request->total_bayar,
        ]);
        $newOrderId = $order_chat->id;

        // Kirim data order ke Pusher
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ]);

        $pusher->trigger('orders-channel', 'new-order', $order_chat);
        // $json = json_decode($request->get('x_json'));
        $json  = json_decode($request->x_json);

        $order_id = $json->order_id;
        $order_dokter_id = $newOrderId;
        $gross_amount = $json->gross_amount;
        $transaction_status = $json->transaction_status;
        $transaction_id = $json->transaction_id;
        $payment_type = $json->payment_type;
        $status_code = $json->status_code;
        //DB::insert('insert into pg_penjualan (id_penjualan, order_id, gross_amount, transaction_id, payment_type, status_code) values (?, ?, ?, ?, ?, ?)', [$id_penjualan, $order_id, $gross_amount, $transaction_id, $payment_type, $status_code]);
        $pg_penjualan = PGPenjualan::create([
            'order_dokter_id' => $order_dokter_id,
            'jenis_order' => "chat_dokter",
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_status' => $transaction_status,
            'transaction_id' => $transaction_id,
            'payment_type' => $payment_type,
            'status_code' => $status_code,
        ]);

        $dokter = Dokter::with('user')
            ->where('id', $request->dokter_id)
            ->first();

        $user_dokter = User::where('user_id', $dokter->kode_dokter)->first();
        if($user_dokter->chat_pasien >= 1){
            // Add a message "Chat time is 30 minutes"
            $message = Chatify::newMessage([
                'from_id' => $dokter->user->id,
                'to_id' => Auth::id(),
                'body' => "Mohon Tunggu, dokter sedang chat pasien lain",
                'attachment' => null,
            ]);
            $messageData = Chatify::parseMessage($message);
            if (Auth::user()->id != $dokter->user->id) {
                Chatify::push("private-chatify." . $dokter->user->id, 'messaging', [
                    'from_id' => $dokter->user->id,
                    'to_id' => Auth::user()->id,
                    'message' => Chatify::messageCard($messageData, true)
                ]);
            }
        }

        return redirect('/ChatDokter/'.$dokter->user->id);
    }

    public function prosesBayarJanji(Request $request){
        $pasien = Pasien::where('id', $request->pasien_id)->first();
        if($pasien->jk == '' || $pasien->tgl_lahir == '' || $pasien->bb == '' || $pasien->tb == ''){
            $request->validate([
                'jk1' => 'required',
                'tgl_lahir1' => 'required',
                'bb1' => 'required',
                'tb1' => 'required',
                'penyakit_derita' => 'required',
                'keterangan' => 'required',
            ]);

            $data_pasien = Pasien::where('id', $request->pasien_id)->update([
                'jk' => $request->jk1,
                'tgl_lahir' => $request->tgl_lahir1,
                'bb' => $request->bb1,
                'tb' => $request->tb1,
            ]);
        }
        if($pasien->alamat == ''){
            $request->validate([
                'alamat' => 'required',
            ]);
            Pasien::where('id', $request->pasien_id)->update([
                'alamat' => $request->alamat,
            ]);
        }
        $order_janji = Janji::create([
            'user_id' => Auth::id(),
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'harga' => $request->total_bayar,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'penyakit' => $request->penyakit_derita,
            'ket' => $request->keterangan,
        ]);
        $newJanjiId = $order_janji->id;

        // Kirim data order ke Pusher
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ]);

        $pusher->trigger('orders-channel', 'new-order-janji', $order_janji);
        // $json = json_decode($request->get('x_json'));
        $json  = json_decode($request->x_json);

        $order_id = $json->order_id;
        $order_dokter_id = $newJanjiId;
        $gross_amount = $json->gross_amount;
        $transaction_status = $json->transaction_status;
        $transaction_id = $json->transaction_id;
        $payment_type = $json->payment_type;
        $status_code = $json->status_code;
        //DB::insert('insert into pg_penjualan (id_penjualan, order_id, gross_amount, transaction_id, payment_type, status_code) values (?, ?, ?, ?, ?, ?)', [$id_penjualan, $order_id, $gross_amount, $transaction_id, $payment_type, $status_code]);
        $pg_penjualan = PGPenjualan::create([
            'order_dokter_id' => $order_dokter_id,
            'jenis_order' => "janji_dokter",
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_status' => $transaction_status,
            'transaction_id' => $transaction_id,
            'payment_type' => $payment_type,
            'status_code' => $status_code,
        ]);

        $dokter = Dokter::with('user')
            ->where('id', $request->dokter_id)
            ->first();
        return redirect('/history-janji');
    }
}
