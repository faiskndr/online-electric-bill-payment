<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tarif;
use DataTables;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarif = Tarif::all();
        $pelanggan = Pelanggan::where('status', 1)->get();
        return view('pelanggan.index', compact('pelanggan', 'tarif'));
    }

    public function konfirmasi()
    {
        $tarif = Tarif::all();
        $pelanggan = Pelanggan::where('status', 0)->get();
        return view('pelanggan.index', compact('pelanggan', 'tarif'));
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

    public function search(Request $request)
    {
       
        if ($request->ajax()) {
           $result ='NULL';
            $pelanggan = Pelanggan::where([['nama_pelanggan', 'LIKE','%'.$request->search.'%'],['status',1]])->get();
            if($pelanggan){
                foreach ($pelanggan as $key => $item) {
                    $result.='<tr>'.
                            '<td>'.$item->nama_pelanggan.'</td>'.
                            '<td>'.$item->nomor_kwh.'</td>'.
                            '<td>'.$item->tarif->daya.'</td>'.
                            '<td>'.'<a href="'.route('tagihan.show',$item->id_pelanggan ).'" class="btn btn-primary btn-sm"><i class="fas fa-check-circle"></i></a>'.'</td>'.
                            '</tr>';
                }
                return Response($result);
            }
     
        }
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
        $pelanggan = Pelanggan::find($id);
        
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
   
        $pelanggan = Pelanggan::find($id);
       
        if ($pelanggan->status == 0) {
           $pelanggan->update([
            'status' => 1,
           ]);
           return redirect('pelanggan');
        }
     
        $pelanggan->update($request->except('_token'));
        return redirect('pelanggan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        return redirect('pelanggan');
    }
}
