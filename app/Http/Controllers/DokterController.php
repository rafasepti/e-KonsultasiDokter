<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Http\Requests\StoreDokterRequest;
use App\Http\Requests\UpdateDokterRequest;
use App\Models\JadwalDokter;
use App\Models\Spesialisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $jadwalDokter = JadwalDokter::where('dokter_id', $id)->get();
        return view('dokter/jadwal_dokter', compact(
            'jadwal', 
            'dokter',
            'jadwalDokter'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:3048', // Sesuaikan dengan kebutuhan Anda
        ]);
        
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('foto');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'assets/images/foto_dokter';
		$file->move($tujuan_upload,$nama_file);
        $gambarPath = 'assets/images/foto_dokter/' . $nama_file;

        $kode = Dokter::kodeDokter();
        Dokter::create([
            'kode_dokter' => $kode,
            'nama_dokter' => $request->nama_dokter,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
            'harga_chat' => $request->harga_chat,
            'harga_janji' => $request->harga_janji,
            'spesialisasi_id' => $request->spesialisasi_id,
            'foto' => $gambarPath,
        ]);
        return redirect('/dokter');
    }

    public function jadwalStore(Request $request)
    {
        
        $rules = [
            'hari' => 'required|array',
            'hari.*' => 'required|string',
        ];

        foreach ($request->hari as $hari) {
            $rules['jam_' . strtolower($hari)] = 'required|array';
            $rules['jam_' . strtolower($hari) . '.*'] = 'required|string';
        }
        $validatedData = $request->validate($rules);

        $dokter_id = $request->dokter_id;

        foreach ($request->hari as $hari) {
            $existingJadwal = JadwalDokter::where('hari', ucfirst($hari))
            ->where('dokter_id', $dokter_id)
            ->exists();
    
            if ($existingJadwal) {
                // Ambil semua hari yang mungkin ada dalam jadwal
                $allDays = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

                // Hapus jadwal lama yang tidak ada dalam permintaan
                foreach ($allDays as $day) {
                    if (!in_array($day, $request->hari)) {
                        JadwalDokter::where('dokter_id', $dokter_id)
                            ->where('hari', ucfirst($day))
                            ->delete();
                    }
                }

                // Tambahkan jadwal baru
                foreach ($request->hari as $day) {
                    // Hapus jadwal lama untuk hari tersebut
                    JadwalDokter::where('dokter_id', $dokter_id)
                        ->where('hari', ucfirst($day))
                        ->delete();

                    // Tambahkan jadwal baru untuk hari tersebut
                    foreach ($request->input('jam_' . strtolower($day)) as $jam) {
                        JadwalDokter::create([
                            'hari' => ucfirst($day), // Pastikan hari diawali dengan huruf besar
                            'jam' => $jam,
                            'dokter_id' => $dokter_id, // ID dokter sesuai dengan dokter yang bersangkutan
                        ]);
                    }
                }

                return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
            }else{
                //Buat data baru
                foreach ($request->input('jam_' . strtolower($hari)) as $jam) {
                    JadwalDokter::create([
                        'hari' => ucfirst($hari), // Pastikan hari diawali dengan huruf besar
                        'jam' => $jam,
                        'dokter_id' => $dokter_id, // ID dokter sesuai dengan dokter yang bersangkutan
                    ]);
                }
            }
        }

        return redirect('/dokter')->with('success', 'Jadwal dokter berhasil disimpan.');
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
        $dokter = Dokter::where('id', $request->id)->first();

        if($dokter->foto != null){
            Storage::delete($dokter->foto);
        }

        $request->validate([
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:3048', // Sesuaikan dengan kebutuhan Anda
        ]);
        
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('foto');

        if($request->file('foto')){
            $nama_file = time()."_".$file->getClientOriginalName();
 
      	        // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'assets/images/logo';
            $file->move($tujuan_upload,$nama_file);
            $gambarPath = 'assets/images/logo/' . $nama_file;
        }else{
            $gambarPath = $dokter->foto;
        }

        Dokter::where('id', $request->id)->update([
            'nama_dokter' => $request->nama_dokter,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
            'harga_chat' => $request->harga_chat,
            'harga_janji' => $request->harga_janji,
            'spesialisasi_id' => $request->spesialisasi_id,
            'foto' => $gambarPath,
        ]);
        return redirect('/dokter');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokter = Dokter::where('id', $id)->first();

        if($dokter->foto != null){
            Storage::delete($dokter->foto);
        }
        Dokter::where('id',$id)->delete();
        return redirect('/dokter');
    }
}
