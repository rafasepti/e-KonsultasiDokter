<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChat extends Model
{
    use HasFactory;
    protected $table = "order_chat";
    protected $guarded = ['created_at', 'updated_at'];
}
