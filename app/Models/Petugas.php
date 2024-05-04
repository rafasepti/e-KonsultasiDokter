<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Petugas extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public static function kodePetugas(){
        $sql = "SELECT IFNULL(MAX(kode_petugas), 'P00000')
            AS kode_petugas FROM petugas";
            $kode_petugas = DB::select($sql);

            foreach ($kode_petugas as $ids) {
                $dk = $ids->kode_petugas;
            }
            $noawal = substr($dk,5);
            $noakhir = (int)$noawal + 1;
            $noakhir = 'P'.str_pad($noakhir,6,"0",STR_PAD_LEFT);
            return $noakhir;
    }
}
