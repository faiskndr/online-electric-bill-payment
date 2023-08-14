<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class TagihanPelangganController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->user()->id_pelanggan;
        $tagihan = Tagihan::where([['id_pelanggan',$id],['status', 'Belum Bayar']])->get();
        $belumBayar = Tagihan::where([['id_pelanggan', $id],['status', 'Belum Bayar']])->get();
        foreach ($tagihan as $item) {
            $pembayaran = new Pembayaran();
            $pembayaran->id_tagihan = $item->id_tagihan;
            $pembayaran->id_pelanggan = $item->id_pelanggan;
            $pembayaran->tanggal_pembayaran =  \Carbon\Carbon::now()->format('Y-m-d');
            // $pembayaran->bulan_bayar =  \Carbon\Carbon::now()->format('M');
            $pembayaran->biaya_admin = 2500;
            $pembayaran->tarif = $pembayaran->pelanggan->tarif->tarifperkwh;
            $pembayaran->total_bayar = $item->jumlah_meter * $pembayaran->pelanggan->tarif->tarifperkwh + 2500;
        }
           

        return view('user.tagihan.index', compact('tagihan','belumBayar'),[
            'title' => 'Tagihan'
        ]);
    }
}
