<?php

namespace App\Http\Controllers;

use App\Models\Spesialisasi;
use App\Http\Requests\StoreSpesialisasiRequest;
use App\Http\Requests\UpdateSpesialisasiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SpesialisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('spesialisasi/v_spesialisasi');
    }

    public function spesialisasiGet(Request $request){
        if ($request->ajax()) {
            $spesialisasi = Spesialisasi::all();
            return DataTables::of($spesialisasi)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/spesialisasi/edit/'.$b->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/spesialisasi/hapus/'.$b->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
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
        return view('spesialisasi/tambah_spesialis');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);
        
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'assets/images/logo_spesialisasi';
		$file->move($tujuan_upload,$nama_file);
        $gambarPath = 'assets/images/logo_spesialisasi/' . $nama_file;
        
        Spesialisasi::create([
            'nama_spesialisasi' => $request->nama_spesialisasi,
            'gelar' => $request->gelar,
            'logo' => $gambarPath,
        ]);

        return redirect('/spesialisasi');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spesialisasi $spesialisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $spesialisasi = Spesialisasi::where('id',$id)->first();
        return view('spesialisasi/edit_spesialis',
        compact('spesialisasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
        ]);
        
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('logo');
 
		$nama_file = time()."_".$file->getClientOriginalName();
 
        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'assets/images/logo_spesialisasi';
		$file->move($tujuan_upload,$nama_file);
        $gambarPath = 'assets/images/logo_spesialisasi/' . $nama_file;
        
        Spesialisasi::where('id', $request->id)->update([
            'nama_spesialisasi' => $request->nama_spesialisasi,
            'gelar' => $request->gelar,
            'logo' => $gambarPath,
        ]);
        return redirect('/spesialisasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       Spesialisasi::where('id',$id)->delete();
       return redirect('/spesialisasi');
    }
}
