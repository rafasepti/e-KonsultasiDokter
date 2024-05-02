<?php

namespace App\Http\Controllers;

use App\Models\Spesialisasi;
use App\Http\Requests\StoreSpesialisasiRequest;
use App\Http\Requests\UpdateSpesialisasiRequest;
use Illuminate\Http\Request;

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
                        <a href="/spesialisasi/edit/'.$b->id.'" class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="/spesialisasi/hapus/'.$b->id.'" class="btn btn-outline-danger" onclick="return confirm(`Apakah anda yakin?`)">
                            <i class="bi bi-trash-fill"></i>
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpesialisasiRequest $request)
    {
        //
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
    public function edit(Spesialisasi $spesialisasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpesialisasiRequest $request, Spesialisasi $spesialisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spesialisasi $spesialisasi)
    {
        //
    }
}
