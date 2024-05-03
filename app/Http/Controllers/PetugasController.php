<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Http\Requests\StorePetugasRequest;
use App\Http\Requests\UpdatePetugasRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('petugas/v_petugas');
    }

    public function petugasGet(Request $request){
        if ($request->ajax()) {
            $petugas = Petugas::all();
            return DataTables::of($petugas)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/petugas/edit/'.$b->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/petugas/hapus/'.$b->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
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
        return view('petugas/tambah_petugas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Petugas::create([
            'nama_petugas' => $request->nama_petugas,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
        ]);
        return redirect('/petugas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $petugas = Petugas::where('id', $id)->first();
        return view('petugas/edit_petugas',
        compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Petugas::where('id', $request->id)->update([
            'nama_petugas' => $request->nama_petugas,
            'no_hp' => $request->no_hp,
            'jk' => $request->jk,
        ]);
        return redirect('/petugas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Petugas::where('id',$id)->delete();
        return redirect('/petugas');
    }
}
