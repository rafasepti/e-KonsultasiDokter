<?php

namespace App\Http\Controllers;

use App\Models\OrderChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function viewStatus(){
        $id_pengguna = Auth::id();
        $pembayaran = OrderChat::where('user_id',$id_pengguna);
        return view('chat/status_chat',
                    compact('pembayaran')
                  );
    }
    public function statusGet(Request $request){
        if ($request->ajax()) {
            $orderChats = OrderChat::with(['pasien', 'user'])
                ->get();
            return DataTables::of($orderChats)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/status-chat/konfirmasi/'.$b->id.'" class="btn btn-primary">
                            Konfirmasi
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function update($id){
        OrderChat::where('id', $id)->update([
            'status_chat' => 'accepted'
        ]);
        $order = OrderChat::where('id', $id)->first();
        
        if ($order) {
            $user_id = $order->user_id; // Ganti 'user_id' dengan nama kolom yang sesuai di tabel OrderChat
            return redirect('/ChatDokter/'.$user_id);
        }
    }
}
