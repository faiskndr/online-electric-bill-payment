<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->user()->id_pelanggan;
        $tagihan = Tagihan::where([['id_pelanggan', $id],['status','Lunas']])->orderBy('id_penggunaan','desc')->get();
        $pembayaran = DB::table('pembayaran')->where('pembayaran.id_pelanggan', $id)
                            ->join('pelanggan','pembayaran.id_pelanggan','=','pelanggan.id_pelanggan')
                            ->select('pembayaran.*','pelanggan.nama_pelanggan')
                            ->get();
                         
        $belumBayar = Tagihan::where([['id_pelanggan', $id],['status', 'Belum Bayar']])->get();
        return view('user.index', compact('tagihan', 'belumBayar','pembayaran'),[
            'title' => 'Beranda'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
