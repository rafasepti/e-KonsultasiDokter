<?php

namespace App\Http\Controllers;

use App\Models\OrderChat;
use App\Models\PGPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    // public function cekstatus(){
    
    //     //query data transaksi yang masih pending	
	// 	$hasil = Pembayaran::viewstatusPGAll();
    //     $id = array();
    //     $no_transaksi = array();
	// 	foreach($hasil as $ks){
	// 		array_push($id,$ks->order_id);
    //         array_push($no_transaksi,$ks->no_transaksi);
	// 	}
    //     for($i=0; $i<count($id); $i++){
    //         $ch = curl_init(); 
    //         $login = env('MIDTRANS_SERVER_KEY');
    //         $password = '';
    //         $orderid = $id[$i];
    //         $no_transaksi = $no_transaksi[$i];
    //         $URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
    //         curl_setopt($ch, CURLOPT_URL, $URL);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    //         curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //         curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
    //         $output = curl_exec($ch); 
    //         curl_close($ch);    
    //         $outputjson = json_decode($output, true);
    //         // var_dump($outputjson);

    //         $affected = DB::update(
    //             'update pg_penjualan 
    //              set status_code = ?,
    //                  transaction_status = ?,
    //                  transaction_time = ?,
    //                  settlement_time = ?,
    //                  status_message = ?,
    //                  merchant_id = ?
    //              where order_id = ?',
    //             [
    //                 $outputjson['status_code'],
    //                 $outputjson['transaction_status'],
    //                 $outputjson['transaction_time'],
    //                 $outputjson['settlement_time'],
    //                 $outputjson['status_message'],
    //                 $outputjson['merchant_id'],
    //                 $orderid
    //             ]
    //         );

    //         // simpan data
    //         $empData = ['no_transaksi' => $no_transaksi, 'tgl_bayar' => $outputjson['transaction_time'], 'bukti_bayar' => 'midtrans-logo.png', 'jenis_pembayaran' => 'pg', 'status' => 'approved'];
    //         Pembayaran::create($empData);

    //         // update status
    //         $affected = DB::table('penjualan')
    //           ->where('no_transaksi', $no_transaksi)
    //           ->update(['status' => 'selesai']);
    //     }

    //     return view('midtrans/autorefresh');
    // }

    // // bayar
    // public function bayar(Request $request){
    //     //id customer dari session, ini bisa diganti sesuai kebutuhan
    //     $id_user = Auth::id();
    //     $keranjang = Penjualan::viewSiapBayar($id_user);
    //     $jml_data = Penjualan::jmlviewSiapBayar($id_user);

    //     foreach($jml_data as $k):
    //         $jml = $k->jml;
    //     endforeach;

    //     if($jml>0){
    //         // 
    //         // dapatkan total tagihan
    //         $no_transaksi = '';
    //         $totaltagihan = 0;
            
    //         $myArray = array(); //untuk menyimpan objek array
    //         foreach($keranjang as $k):
    //             $no_transaksi = $k->no_transaksi ;
    //             $totaltagihan = $totaltagihan + $k->total ;

    //             // untuk data item detail
    //             // kita perlu membuat objek dulu kemudian di masukkan ke array
    //             $foo = array(
    //                     'id'=> $k->id_penjualan_detail,
    //                     'price' => $k->biaya,
    //                     'quantity' => $k->jml_barang,
    //                     'name' => $k->jenis_pakaian,

    //             );
    //             // tambahkan ke myarray
    //             array_push($myArray,$foo);

    //         endforeach;

    //         \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    //         // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //         \Midtrans\Config::$isProduction = false;
    //         // Set sanitization on (default)
    //         \Midtrans\Config::$isSanitized = true;
    //         // Set 3DS transaction for credit card to true
    //         \Midtrans\Config::$is3ds = true;

    //         $params = array(
    //             'transaction_details' => array(
    //                 'order_id' => rand(), //idpesanan ini nanti dpt diambil dari no_pesanan
    //                 'gross_amount' => $totaltagihan, //gross amount diisi total tagihan
    //             ),
    //             'item_details' => $myArray,
    //             'customer_details' => array(
    //                 'first_name' => Auth::user()->name,
    //                 'last_name' => '',
    //                 'email' => Auth::user()->email,
    //                 'phone' => '',
    //             ),
    //         );
            
    //         $snapToken = \Midtrans\Snap::getSnapToken($params);


    //         return view('midtrans/viewcheckout',
    //                     [
    //                         'keranjang' => $keranjang,
    //                         'snap_token' => $snapToken,
    //                     ]
    //                 );
    //         // 
    //     }else{
    //         // tidak ada keranjang kembalikan ke depan
    //         if($request->session()->get('kelompok')=='customer'){
    //             return redirect('/pembayaran/viewstatus');
    //         }else{
    //             return redirect('/pembayaran/viewstatusPG');
    //         }
    //     }

        
    // }

    // proses bayar
    public function proses_bayar(Request $request){
        $order_chat = OrderChat::create([
            'user_id' => Auth::id(),
            'pasien_id' => $request->pasien_id,
            'user_id' => $request->dokter_id,
            'total_bayar' => $request->total_bayar,
        ]);
        $newOrderId = $order_chat->id;
        // $json = json_decode($request->get('x_json'));
        $json  = json_decode($request->x_json);

        //$order_id = $json->order_id;
        $order_id = $newOrderId;
        $gross_amount = $json->gross_amount;
        $transaction_status = $json->transaction_status;
        $transaction_id = $json->transaction_id;
        $payment_type = $json->payment_type;
        $status_code = $json->status_code;
        //DB::insert('insert into pg_penjualan (id_penjualan, order_id, gross_amount, transaction_id, payment_type, status_code) values (?, ?, ?, ?, ?, ?)', [$id_penjualan, $order_id, $gross_amount, $transaction_id, $payment_type, $status_code]);
        $pg_penjualan = PGPenjualan::create([
            'order_id' => $order_id,
            'gross_amount' => $gross_amount,
            'transaction_status' => $transaction_status,
            'transaction_id' => $transaction_id,
            'payment_type' => $payment_type,
            'status_code' => $status_code,
        ]);

        return redirect('/chat-dokter');
    }

    // cek status
    public function tes($id){
    
        
            $ch = curl_init(); 
            $login = env('MIDTRANS_SERVER_KEY');
            $password = '';
            $orderid = $id;
            $URL =  'https://api.sandbox.midtrans.com/v2/'.$orderid.'/status';
            curl_setopt($ch, CURLOPT_URL, $URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");  
            $output = curl_exec($ch); 
            curl_close($ch);    
            $outputjson = json_decode($output, true);
            var_dump($outputjson);

            echo $outputjson['status_code']."<br>";
            echo $outputjson['payment_type']."<br>";
            echo $outputjson['transaction_status']."<br>";
            echo $outputjson['transaction_time']."<br>";
            echo $outputjson['settlement_time']."<br>";
            echo $outputjson['status_message']."<br>";
            echo $outputjson['merchant_id']."<br>";
    }
}
