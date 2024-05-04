<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Http\Requests\StoreDokterRequest;
use App\Http\Requests\UpdateDokterRequest;
use App\Models\JadwalDokter;
use App\Models\Spesialisasi;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dokter/v_dokter');
    }

    public function dokterGet(Request $request){
        if ($request->ajax()) {
            $dokter = Dokter::with('spesialisasi')->get();
            return DataTables::of($dokter)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/dokter/jadwal/'.$b->id.'" class="btn btn-success btn-sm">
                            Jadwal
                        </a>
                        <a href="/dokter/edit/'.$b->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/dokter/hapus/'.$b->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
                            Hapus
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spesialisasi = Spesialisasi::all();
        return view('dokter/tambah_dokter', compact('spesialisasi'));
    }

    public function jadwal($id)
    {
        $jadwal = JadwalDokter::where('id', $id)->first();
        $dokter = Dokter::where('id', $id)->first();
        return view('dokter/jadwal_dokter', compact('jadwal', 'dokter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kode = Dokter::kodeDokter();
        Dokter::create([
            'kode_dokter' => $kode,
            'nama_dokter' => $request->nama_dokter,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
            'harga_chat' => $request->harga_chat,
            'harga_janji' => $request->harga_janji,
            'spesialisasi_id' => $request->spesialisasi_id,
        ]);
        return redirect('/dokter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokter $dokter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $spesialisasi = Spesialisasi::all();
        $dokter = Dokter::where('id', $id)->first();
        return view('dokter/edit_dokter',
        compact('spesialisasi', 'dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Dokter::where('id', $request->id)->update([
            'nama_dokter' => $request->nama_dokter,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
            'harga_chat' => $request->harga_chat,
            'harga_janji' => $request->harga_janji,
            'spesialisasi_id' => $request->spesialisasi_id,
        ]);
        return redirect('/dokter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Dokter::where('id',$id)->delete();
        return redirect('/dokter');
    }
}
