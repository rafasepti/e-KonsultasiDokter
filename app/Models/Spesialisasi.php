<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    use HasFactory;
    protected $table = "spesialisasi";
    protected $fillable = [
        'nama_spesialisasi',
        'gelar',
    ];
}
