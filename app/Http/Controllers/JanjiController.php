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
        $dokter = Dokter::where('spesialisasi_id', $id)->get();
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

    public function historyJanji(){
        $janji = Janji::with(['pasien', 'dokter'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('history/history_janji', compact('janji'));
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
        if ($request->ajax()) {
            $orderJanji = Janji::with(['pasien', 'dokter'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
            return DataTables::of($orderJanji)
                ->addIndexColumn()
                ->addColumn('action', function($b){
                    $actionBtn = 
                    '
                        <a href="/history-janji/surat/'.$b->id.'" class="btn btn-primary">
                            Surat Konfirmasi
                        </a>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

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
    
}
