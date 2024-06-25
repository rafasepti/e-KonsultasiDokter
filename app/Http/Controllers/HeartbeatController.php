<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HeartbeatController extends Controller
{
    public function update(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            //$user = User::where(Auth::id());
            if ($user) {
                $user->active_status = 1;
                $user->save();
                return response()->json(['status' => 'success']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Not authenticated'], 401);
        }
    }
}
