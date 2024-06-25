<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('akun/v_akun');
    }

    public function userGet(Request $request){
        if ($request->ajax()) {
            $user = User::where('hak_akses', 'petugas')
            ->orWhere('hak_akses', 'dokter')
            ->orWhere('hak_akses', 'admin')
            ->get();
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/akun/edit/'.$b->id.'" class="btn btn-info btn-sm">
                            Edit
                        </a>
                        <a href="/akun/hapus/'.$b->id.'" class="btn btn-danger btn-sm" onclick="return confirm(`Apakah anda yakin?`)">
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
        $dokter = Dokter::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('dokter.kode_dokter', '=', 'users.user_id');
        })->get();
        $petugas = Petugas::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('users')
                  ->whereColumn('petugas.kode_petugas', '=', 'users.user_id');
        })->get();
        return view('akun/tambah_akun', compact('dokter', 'petugas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        if($request->hak_akses == "dokter"){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->input('password')),
                'user_id' => $request->kode_dokter,
                'hak_akses' => $request->hak_akses,
            ]);
        }else{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->input('password')),
                'hak_akses' => $request->hak_akses,
                'user_id' => $request->kode_petugas,
            ]);
        }
        return redirect('/akun');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $kode = $user->user_id;

        $dokter = null;
        $petugas = null;

        if ($user->hak_akses === 'dokter') {
            $dokter = Dokter::where('kode_dokter', $kode)->first();
        } elseif ($user->hak_akses === 'petugas' || $user->hak_akses === 'admin') {
            $petugas = Petugas::where('kode_petugas', $kode)->first();
        }

        return view('akun/edit_akun', compact('user', 'dokter', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $request->id, // validasi unique, tetapi melewati validasi untuk record yang diubah
            // tambahkan validasi lain sesuai kebutuhan Anda
        ]);
        if($request->hak_akses == "dokter"){
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'hak_akses' => $request->hak_akses,
                'user_id' => $request->kode_dokter,
            ]);
        }else{
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'hak_akses' => $request->hak_akses,
                'user_id' => $request->kode_petugas,
            ]);
        }
        return redirect('/akun');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect('/akun');
    }

    public function getStatus($id)
    {
        $user = User::find($id);
        return response()->json(['status' => $user->active_status]);
    }
}
