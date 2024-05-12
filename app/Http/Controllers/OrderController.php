<?php

namespace App\Http\Controllers;

use App\Models\OrderChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function viewStatus(){
        $id_pengguna = Auth::id();
        $pembayaran = OrderChat::where('user_id',$id_pengguna);
        return view('chat/status_chat',
                    compact('pembayaran')
                  );
    }
}
