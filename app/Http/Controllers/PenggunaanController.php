<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Penggunaan;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::where('status', 1)->get();

        return view('penggunaan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $p = Penggunaan::where('id_pelanggan', $id)->get();
        // $bulan = \Carbon\Carbon::now()->format('M');
        // foreach ($p as $item ) {
        //     $p = $item->bulan;
        // }
        
        // if($p ==  $bulan){
        //     return redirect('/penggunaan')->with(['failed' => 'Tagihan sudah dibuat!']);
        // }

        //     $penggunaan = new penggunaan();
        //     $penggunaan->id_pelanggan = $id;
        //     $penggunaan->bulan =  \Carbon\Carbon::now()->format('M');
        //     $penggunaan->tahun =  \Carbon\Carbon::now()->format('Y');
        //     $penggunaan->meter_awal = 0;
        //     $penggunaan->meter_akhir = 0;
        //     $penggunaan->save();
    
        //     session(['id_penggunaan' => $penggunaan->id_penggunaan]);
        //     session(['id_pelanggan' => $penggunaan->id_pelanggan]);
    
        //     return redirect()->route('tagihan-pelanggan.index');
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

    public function show($id)
    {
        $bulan = \Carbon\Carbon::now()->format('M');
        $penggunaan = Penggunaan::where([['id_pelanggan', $id], ['bulan',$bulan]])->first();

        if ($penggunaan) {
            return redirect('/penggunaan')->with(['failed' => 'Tagihan sudah dibuat!']);
        }
        
        $penggunaan = new penggunaan();
        $penggunaan->id_pelanggan = $id;
        $penggunaan->bulan =  \Carbon\Carbon::now()->format('M');
        $penggunaan->tahun =  \Carbon\Carbon::now()->format('Y');
        $penggunaan->meter_awal = 0;
        $penggunaan->meter_akhir = 0;
        $penggunaan->save();
        session(['id_penggunaan' =>$penggunaan->id_penggunaan]);
        session(['id_pelanggan' => $id]);
        return redirect()->route('tagihan.create');
    }

    // public function search(Request $request)
    // {
       
    //     if ($request->ajax()) {
    //        $result ='NULL';
    //         $pelanggan = Pelanggan::where('nama_pelanggan', 'LIKE','%'.$request->search.'%')->get();
    //         if($pelanggan){
    //             foreach ($pelanggan as $key => $item) {
    //                 $result.='<tr>'.
    //                         '<td>'.$item->nama_pelanggan.'</td>'.
    //                         '<td>'.$item->nomor_kwh.'</td>'.
    //                         '<td>'.$item->tarif->daya.'</td>'.
    //                         '<td>'.'<a href="'.route('penggunaan.create',$item->id_pelanggan ).'" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i></a>'.'</td>'.
    //                         '</tr>';
    //             }
    //             return Response($result);
    //         }
     
            
    //     }
    // }

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
        $penggunaan = Penggunaan::find($id);
        if($request->meter_akhir == null){
            $penggunaan->meter_awal = $request->meter_awal;
        }else {
            $penggunaan->meter_akhir = $request->meter_akhir;
        }
        
      
        $penggunaan->update();

        return response()->json(200);
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
