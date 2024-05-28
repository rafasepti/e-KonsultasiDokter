<?php

namespace App\Http\Controllers;

use App\Models\Janji;
use App\Http\Requests\StoreJanjiRequest;
use App\Http\Requests\UpdateJanjiRequest;
use App\Models\Dokter;
use App\Models\OrderChat;
use App\Models\Pasien;
use App\Models\ProfileRS;
use App\Models\Spesialisasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

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
        $dokter = Dokter::with('user')
            ->where('spesialisasi_id', $id)
            ->has('user')
            ->get();
        return view('janji_rs/janji_spesialisasi', compact('dokter', 'spesialisasi'));
    }

    public function order($id)
    {
        $pasien = Pasien::where('user_id', Auth::id())->get();
        $dokter = Dokter::with('jadwalDokter')->where('id', $id)->first();
        $total_janji = $dokter->harga_janji;

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
                    'gross_amount' => $total_janji, //gross amount diisi total tagihan
                ),
                'customer_details' => array(
                    'first_name' => Auth::user()->name,
                    'last_name' => '',
                    'email' => Auth::user()->email,
                    'phone' => '',
                ),
            );
            
            $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('janji_rs/janji_order', compact('pasien', 'dokter', 'total_janji', 'snapToken'));
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

    public function historyJanji(Request $request){
        $status = $request->query('status');
    
        if ($status) {
            $janji = Janji::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
        } else {
            $janji = Janji::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        }
        
        return view('history/history_janji', compact('janji', 'status'));
    }

    public function batal($id){
        Janji::where('id', $id)->update([
            'status' => 'dibatalkan'
        ]);

        return redirect('/history-janji');
    }

    public function historyChatGet(Request $request){
        if ($request->ajax()) {
            $orderChats = OrderChat::with(['pasien', 'dokter.spesialisasi'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
            return DataTables::of($orderChats)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/status-chat/konfirmasi/'.$b->id.'" class="btn btn-primary">
                            Konfirmasi
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function historyJanjiGet(Request $request){
        if(auth()->user()->hak_akses == "dokter"){
            $dokter_id = Dokter::where('kode_dokter', auth()->user()->user_id)->first();
            $orderJanji = Janji::with(['pasien', 'user'])
                ->where('dokter_id', $dokter_id->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $orderJanji = Janji::with(['pasien', 'user', 'dokter'])
                ->orderBy('created_at', 'desc')
                ->get();
        }
        if ($request->ajax()) {
            
            return DataTables::of($orderJanji)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    if(auth()->user()->hak_akses == 'dokter'){
                        if($b->status != 'dibatalkan'){
                            $actionBtn = 
                            '
                                <a href="/status-janji/detail/'.$b->id.'" class="btn btn-info">
                                    Detail
                                </a>
                                <a href="/status-janji/ubah-status/'.$b->id.'" class="btn btn-primary">
                                    Edit
                                </a>
                            ';
                        }else{
                            $actionBtn = 
                            '
                                <a href="/status-janji/detail/'.$b->id.'" class="btn btn-info">
                                    Detail
                                </a>
                            ';
                        }
                    }else{
                        $actionBtn = 
                        '
                            <a href="/status-janji/detail/'.$b->id.'" class="btn btn-info">
                                Detail
                            </a>
                        ';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //untuk pasien
    public function printSurat($id){
        $profile_rs = ProfileRS::first();
        $janji = Janji::with(['pasien', 'dokter'])
            ->where('id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        
        Carbon::setLocale('id');
        $tgl = $janji->tgl;
        // Mengonversi tanggal ke format yang diinginkan
        $tanggalBaru = Carbon::parse($tgl)->translatedFormat('l, d M Y');
        return view('history.print_janji', compact('janji', 'profile_rs', 'tanggalBaru'));
    }

    public function laporan(){
        if(auth()->user()->hak_akses == "dokter"){
            $dokter_id = Dokter::where('kode_dokter', auth()->user()->user_id)->first();
            $janji = Janji::with(['pasien', 'user'])
                ->where('dokter_id', $dokter_id->id)
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            $janji = Janji::with(['pasien', 'user', 'dokter'])
                ->orderBy('created_at', 'desc')
                ->get();
        }
        $profile_rs = ProfileRS::first();
        // dd($janji);
        return view('janji_rs.laporan_janji', compact('janji', 'profile_rs'));
    }

    //untuk dokter
    public function printJanji($id){
        $profile_rs = ProfileRS::first();
        $janji = Janji::with(['pasien', 'user','dokter'])
            ->where('id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        
        Carbon::setLocale('id');
        $tgl = $janji->tgl;
        // Mengonversi tanggal ke format yang diinginkan
        $tanggalBaru = Carbon::parse($tgl)->translatedFormat('l, d M Y');
        return view('janji_rs.print', compact('janji', 'profile_rs', 'tanggalBaru'));
    }

    public function show($id){
        $profile_rs = ProfileRS::first();
        $janji = Janji::with(['pasien', 'user','dokter'])
            ->where('id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        
        Carbon::setLocale('id');
        $tgl = $janji->tgl;
        // Mengonversi tanggal ke format yang diinginkan
        $tanggalBaru = Carbon::parse($tgl)->translatedFormat('l, d M Y');
        return view('janji_rs.detail', compact('janji', 'profile_rs', 'tanggalBaru'));
    }

    public function editStatus($id){
        $janji = Janji::with(['pasien', 'user','dokter'])
            ->where('id', $id)
            ->orderBy('created_at', 'desc')
            ->first();
        return view('janji_rs.ubah_status', compact('id', 'janji'));
    }

    public function updateStatus(Request $request){
        Janji::where('id', $request->id)
            ->update([
                'status' => $request->status,
                'riwayat_medis' => $request->riwayat_medis,
                'gelaja_keluhan' => $request->gelaja_keluhan,
                'diagnosa' => $request->diagnosa,
                'rencana_pengobatan' => $request->rencana_pengobatan,
                'tindak_lanjut' => $request->tindak_lanjut,
            ]);
        return redirect('/status-janji');
    }

    public function statusJanji(){
        if(auth()->user()->hak_akses == "dokter"){
            return view('janji_rs.status_janji');
        }else{
            return view('janji_rs.status_janji_petugas');
        }
    }
    
}
