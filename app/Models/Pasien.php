<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    protected $table = "pasien";
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderChat()
    {
        return $this->hasOne(OrderChat::class, 'pasien_id');
    }
    
    public function janji()
    {
        return $this->hasOne(Janji::class, 'pasien_id');
    }
}
