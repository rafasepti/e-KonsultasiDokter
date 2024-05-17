<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Janji extends Model
{
    use HasFactory;
    protected $table = "janji";
    protected $guarded = ['created_at', 'updated_at'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}
