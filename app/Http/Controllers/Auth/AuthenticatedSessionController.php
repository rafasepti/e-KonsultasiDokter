<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\ProfileRS;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $profile_rs = ProfileRS::first();
        return view('auth.login', compact('profile_rs'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $hak_akses = auth()->user()->hak_akses;

        // Update active status to 1 when login is successful
        User::updateActiveStatus(Auth::id(),1);

        if ($hak_akses === 'admin') {
            return redirect()->intended(route('index.admin', absolute: false));
            
        } else {
            return redirect()->intended(route('index', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        User::updateActiveStatus(Auth::id(),0);
        
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
