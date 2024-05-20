<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $pasien = Pasien::count();
        $dokter = Dokter::count();
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Sum total_bayar dari tabel order_chat untuk bulan dan tahun saat ini
        $totalBayarThisMonth = DB::table('order_chat')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('total_bayar');

        // Sum harga dari tabel janji untuk bulan dan tahun saat ini
        $hargaThisMonth = DB::table('janji')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('harga');

        // Sum total_bayar dari tabel order_chat di tahun saat ini
        $totalBayarThisYear = DB::table('order_chat')
            ->whereYear('created_at', $currentYear)
            ->sum('total_bayar');

        // Sum harga dari tabel janji di tahun saat ini
        $hargaThisYear = DB::table('janji')
            ->whereYear('created_at', $currentYear)
            ->sum('harga');

        // Menggabungkan hasil bulanan dari kedua tabel
        $totalThisMonth = $totalBayarThisMonth + $hargaThisMonth;

        // Menggabungkan hasil tahunan dari kedua tabel
        $totalThisYear = $totalBayarThisYear + $hargaThisYear;

        return view ('admin/v_admin', compact(
            'pasien',
            'dokter',
            'totalThisMonth', 
            'totalThisYear'
        ));
    }
}
