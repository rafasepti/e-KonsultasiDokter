<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderChat extends Model
{
    use HasFactory;
    protected $table = "order_chat";
    protected $guarded = ['created_at', 'updated_at'];

    public static function viewstatusPGAll()
    {
        // query kode perusahaan
        $sql = "SELECT order_chat.*,c.status_code,c.order_id
                FROM order_chat b
                JOIN pg_penjualan c
                ON (b.id=c.order_dokter_id)
                WHERE b.status in ('siap_bayar')
                AND b.no_transaksi NOT IN 
                (SELECT no_transaksi FROM pembayaran WHERE jenis_pembayaran = 'tunai')
                ";
        $list = DB::select($sql);

        return $list;
    }
}
