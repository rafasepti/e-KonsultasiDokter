<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function pengguna(){
        return view('pengguna/v_pengguna');
    }
}
