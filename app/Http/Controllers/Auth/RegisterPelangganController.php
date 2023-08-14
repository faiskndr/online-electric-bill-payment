<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Admin;
use App\Models\Tarif;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterPelangganController extends Controller
{
    public function create(): View
    {
        $tarif = Tarif::all();
        return view('auth.register', compact('tarif'));
    }

     /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       
        $request->validate([
            'nama_pelanggan' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:8', 'unique:'.Pelanggan::class,'unique:'.Admin::class],
            'nomor_kwh' => ['required', 'max:11'],
            'daya' => ['required'],  
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = Pelanggan::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->daya,
            'status' => 0,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        return redirect('/login');
    }
}
