<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::where('status', 1)->get();
        $tamu = Pelanggan::where('status', 0)->get();
        $tagihanLunas = Tagihan::where('status', 'Lunas')->get();
        $tagihan = Tagihan::where('status', 'Belum Bayar')->paginate(10);
        $tagihanTotal = Tagihan::get();
        $pembayaran = Pembayaran::all();

        return view('dashboard.index', compact('pelanggan','tamu','tagihan','tagihanLunas','tagihanTotal', 'pembayaran'));
    }
}
