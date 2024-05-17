<?php

namespace App\Http\Controllers;

use App\Models\Janji;
use App\Http\Requests\StoreJanjiRequest;
use App\Http\Requests\UpdateJanjiRequest;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Spesialisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spesialisasi = Spesialisasi::all();
        return view('janji_rs/v_janji', compact('spesialisasi'));
    }

    public function spesialisasi($id){
        $spesialisasi = Spesialisasi::where('id', $id)->first();
        $dokter = Dokter::where('spesialisasi_id', $id)->get();
        return view('janji_rs/janji_spesialisasi', compact('dokter', 'spesialisasi'));
    }

    public function order($id)
    {
        $pasien = Pasien::where('user_id', Auth::id())->get();
        $dokter = Dokter::with('jadwalDokter')->where('id', $id)->first();
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

        return view('janji_rs/janji_order', compact('pasien', 'dokter', 'total_chat', 'snapToken'));
    }

    public function jadwalDokter(Request $request)
    {
        $selectedDay = $request->input('day');
        $dokterId = $request->input('dokter_id');

        // Ambil jadwal dokter berdasarkan ID dokter dan hari yang dipilih
        $dokter = Dokter::with(['jadwalDokter' => function ($query) use ($selectedDay) {
            $query->where('hari', $selectedDay);
        }])->find($dokterId);

        // Ambil jadwal dokter dari relasi
        $jadwalDokter = $dokter->jadwalDokter;

        // Kembalikan jadwal dokter dalam bentuk JSON
        return response()->json($jadwalDokter);
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
    public function store(StoreJanjiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Janji $janji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Janji $janji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJanjiRequest $request, Janji $janji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Janji $janji)
    {
        //
    }
}
