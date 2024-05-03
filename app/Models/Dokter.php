<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    protected $table = "dokter";
    protected $guarded = ['created_at', 'updated_at'];

    public function spesialisasi()
    {
        return $this->belongsTo(Spesialisasi::class, 'spesialisasi_id');
    }
}
