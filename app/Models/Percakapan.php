<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Percakapan extends Model
{
    use HasFactory;
    protected $table = "percakapan";
    protected $guarded = ['created_at', 'updated_at'];
}
