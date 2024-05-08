<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileRS extends Model
{
    use HasFactory;
    protected $table = "profile_rs";
    protected $guarded = ['created_at', 'updated_at'];
}
