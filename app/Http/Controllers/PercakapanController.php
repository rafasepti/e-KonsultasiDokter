<?php

namespace App\Http\Controllers;

use App\Models\Percakapan;
use App\Http\Requests\StorePercakapanRequest;
use App\Http\Requests\UpdatePercakapanRequest;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Spesialisasi;
use Illuminate\Support\Facades\Auth;

class PercakapanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spesialisasi = Spesialisasi::all();
        return view('chat/v_chat', compact('spesialisasi'));
    }

    public function spesialisasi($id){
        $spesialisasi = Spesialisasi::where('id', $id)->first();
        $dokter = Dokter::with('user')
            ->where('spesialisasi_id', $id)
            ->has('user')
            ->get();
        return view('chat/chat_spesialisasi', compact('dokter', 'spesialisasi'));
    }

    public function order($id)
    {
        $pasien = Pasien::where('user_id', Auth::id())->get();
        $dokter = Dokter::where('id', $id)->first();
        $total_chat = $dokter->harga_chat + 2000;

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
                    'gross_amount' => $total_chat, //gross amount diisi total tagihan
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'phone' => '',
                ),
            );
            
            $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('chat/chat_order', compact('pasien', 'dokter', 'total_chat', 'snapToken'));
    }

    public function chat()
    {
        return view('chat/status_chat');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePercakapanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Percakapan $percakapan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Percakapan $percakapan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePercakapanRequest $request, Percakapan $percakapan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Percakapan $percakapan)
    {
        //
    }
}
