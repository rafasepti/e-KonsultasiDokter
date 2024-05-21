<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\OrderChat;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Chatify\Facades\ChatifyMessenger as Chatify;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function viewStatus(){
        $dokter_id = Dokter::where('kode_dokter', auth()->user()->user_id)->first();
        $pembayaran = OrderChat::where('user_id',$dokter_id->id);
        return view('chat/status_chat',
                    compact('pembayaran')
                  );
    }
    public function statusGet(Request $request){
        if ($request->ajax()) {
            $dokter_id = Dokter::where('kode_dokter', auth()->user()->user_id)->first();
            $orderChats = OrderChat::with(['pasien', 'user'])
                ->where('dokter_id',$dokter_id->id)
                ->orderBy('created_at', 'desc')
                ->get();
            return DataTables::of($orderChats)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    if ($b->status_chat == "not_accepted") {
                        return '<a href="/status-chat/konfirmasi/'.$b->id.'" class="btn btn-primary">Konfirmasi</a>';
                    } else {
                        return '<a href="/ChatDokter/'.$b->user->id.'" class="btn btn-info">Chat</a>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function update($id){
        OrderChat::where('id', $id)->update([
            'status_chat' => 'accepted'
        ]);

        $dokter_id = Dokter::where('kode_dokter', auth()->user()->user_id)->first();
        $orderChat = OrderChat::where('dokter_id', $dokter_id->id)
            ->where('id', $id)
            ->where('status_chat', 'accepted')
            ->first();
        $pasien = Pasien::where('id', $orderChat->pasien_id)->first();
        $tgl_lahir = Carbon::parse($pasien->tgl_lahir);
        $umur = $tgl_lahir->age;
        
        if ($orderChat) {
            $messageBody = "Waktu chat 30 menit.\n";
            $messageBody .= "Nama Pasien: " . $pasien->nama_pasien . "\n";
            $messageBody .= "Umur: " . $umur . " tahun \n";
            $messageBody .= "Berat Badan: " . $pasien->bb . " kg \n";
            $messageBody .= "Tinggi Badan: " . $pasien->tb . " cm \n";
            // Add a message "Chat time is 30 minutes"
            $message = Chatify::newMessage([
                'from_id' => Auth::id(),
                'to_id' => $orderChat->user_id,
                'body' => $messageBody,
                'attachment' => null,
            ]);
            $messageData = Chatify::parseMessage($message);
            if (Auth::user()->id != $orderChat->user_id) {
                Chatify::push("private-chatify.".$orderChat->user_id, 'messaging', [
                    'from_id' => Auth::user()->id,
                    'to_id' => $orderChat->user_id,
                    'message' => Chatify::messageCard($messageData, true)
                ]);
            }
        }else{
            Log::error('Patient not found for orderChat ID: ' . $orderChat->id);
        }
        
        $order = OrderChat::where('id', $id)->first();
        if ($order) {
            $user_id = $order->user_id; // Ganti 'user_id' dengan nama kolom yang sesuai di tabel OrderChat
            return redirect('/ChatDokter/'.$user_id);
        }
    }

    public function checkData(Request $request)
    {
        $newData = OrderChat::latest()->first();
        return response()->json(['hasNewData' => $newData ? true : false]);
    }

    public function historyChat(Request $request){
        $status = $request->query('status');
    
        if ($status) {
            $chat = OrderChat::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->where('status_chat', $status)
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $chat = OrderChat::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        }
        
        return view('history/history_chat', compact('chat', 'status'));
    }
}
