<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PGPenjualan extends Model
{
    use HasFactory;
    protected $table = "pg_penjualan";
    protected $guarded = ['created_at', 'updated_at'];

    public function OrderChat()
    {
        return $this->belongsTo(OrderChat::class, 'order_dokter_id');
    }

    public function Janji()
    {
        return $this->belongsTo(OrderChat::class, 'order_dokter_id');
    }
}
