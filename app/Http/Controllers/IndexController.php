<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pusher\Pusher;

class IndexController extends Controller
{
    public function pengguna(){
        return view('pengguna/v_pengguna');
    }

    public function sendData(Request $request)
    {
        $data = ['message' => 'Hello, Pusher!'];
        $options = array( 'cluster' => 'ap1', 'useTLS' => true );
        $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), $options);

        $pusher->trigger('my-channel', 'my-event', $data);

        return response()->json(['status' => 'success']);
    }
}
