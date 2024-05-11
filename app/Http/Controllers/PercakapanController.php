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
        $dokter = Dokter::where('spesialisasi_id', $id)->get();
        return view('chat/chat_spesialisasi', compact('dokter', 'spesialisasi'));
    }

    public function order($id)
    {
        $pasien = Pasien::where('user_id', Auth::id())->get();
        $dokter = Dokter::where('id', $id)->first();
        $total_chat = $dokter->harga_chat + 2000;
        return view('chat/chat_order', compact('pasien', 'dokter', 'total_chat'));
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
