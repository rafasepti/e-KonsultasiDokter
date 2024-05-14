<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dokter extends Model
{
    use HasFactory;
    protected $table = "dokter";
    protected $guarded = ['created_at', 'updated_at'];

    public function spesialisasi()
    {
        return $this->belongsTo(Spesialisasi::class, 'spesialisasi_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'kode_dokter');
    }

    public function orderChat()
    {
        return $this->hasOne(OrderChat::class, 'dokter_id');
    }

    public static function kodeDokter(){
        $sql = "SELECT IFNULL(MAX(kode_dokter), 'D00000')
            AS kode_dokter FROM dokter";
            $kode_dokter = DB::select($sql);

            foreach ($kode_dokter as $ids) {
                $dk = $ids->kode_dokter;
            }
            $noawal = substr($dk,5);
            $noakhir = (int)$noawal + 1;
            $noakhir = 'D'.str_pad($noakhir,6,"0",STR_PAD_LEFT);
            return $noakhir;
    }
}
