<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Auth
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
     
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'], 
        ]);       

        
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = auth()->guard('admin')->user()->id_level;
            $request->session()->regenerate();
            if ($admin == 1) {
                return redirect()->intended(RouteServiceProvider::HOME);
            }elseif ($admin == 2) {
                return redirect()->intended('/konfirmasi-pembayaran');
            }
               
        }

        if (Auth::guard('pelanggan')->attempt($credentials)) {
            // $pelanggan = auth()->guard('pelanggan')->user()->status;
            $request->session()->regenerate();
           
            return redirect('/beranda');
        }

        
        $request->authenticate();
        

        // $request->session()->regenerate();

        // return redirect()->intended('/profile');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        
        Auth::guard('admin')->logout();
        Auth::guard('pelanggan')->logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect()->intended('/');
    }
}
