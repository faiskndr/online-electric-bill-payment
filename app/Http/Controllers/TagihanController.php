<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::where('status', 1)->get();
        $tagihan = DB::table('tagihan')
                      ->join('pelanggan', 'tagihan.id_pelanggan','=','pelanggan.id_pelanggan')
                      ->join('tarif', 'pelanggan.id_tarif','=','tarif.id_tarif')
                      ->select('tagihan.*','pelanggan.nama_pelanggan',DB::raw('(tagihan.jumlah_meter * tarif.tarifperkwh) as total'))
                      ->orderBy('id_tagihan','desc')
                      ->get();
                    
        // $tagihan = Tagihan::all();
        // dd($tagihan);
        return view('penggunaan.index', compact('pelanggan','tagihan'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $id_penggunaan = session('id_penggunaan');
        $pelanggan = Pelanggan::find(session('id_pelanggan'));
        $penggunaan = Penggunaan::find($id_penggunaan);
        if(!$pelanggan || !$penggunaan ){
            abort(404);
        }
        return view('tagihan.index', compact('id_penggunaan','pelanggan','penggunaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $request->validate([
            'meterAwal' => ['required','integer', 'min:1'],
            'meterAkhir' => ['required','integer', 'min:1']
        ]);
       
        $id_penggunaan = session('id_penggunaan');
        $id_pelanggan = session('id_pelanggan');
       
        $penggunaan = Penggunaan::find($id_penggunaan);
        $penggunaan->meter_awal = $request->meterAwal;
        $penggunaan->meter_akhir = $request->meterAkhir;
        $penggunaan->update();

        $tagihan = new Tagihan();
        $tagihan->id_penggunaan = $id_penggunaan;
        $tagihan->id_pelanggan = $id_pelanggan;
        $tagihan->bulan =  \Carbon\Carbon::now()->format('M');
        $tagihan->tahun =  \Carbon\Carbon::now()->format('Y');
        $tagihan->jumlah_meter = $request->meterAwal - $request->meterAkhir;
        $tagihan->status = 'Belum Bayar';
        $tagihan->save();

        return redirect('/tagihan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bulan = now()->format('M');
        $penggunaan = Penggunaan::where([['id_pelanggan', $id]])->get()->last();

        $date1 = now();
        if ($penggunaan) {
            $date2 = $penggunaan->created_at->addMonth(1);
            if ($date1->lt($date2)) {
           
                return redirect('/tagihan')->with(['failed' => "Tagihan berikutnya pada $date2"]);
            }
        }
       
     
      
        
            $penggunaan = new penggunaan();
            $penggunaan->id_pelanggan = $id;
            $penggunaan->bulan =  $bulan;
            $penggunaan->tahun = now()->format('Y');
            $penggunaan->meter_awal = 0;
            $penggunaan->meter_akhir = 0;
            $penggunaan->save();

            $pelanggan = Pelanggan::find($id);
            session(['id_pelanggan' => $id]);
            session(['id_penggunaan' => $penggunaan->id_penggunaan]);
            return redirect()->route('tagihan.create');
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
       
        $penggunaan = Penggunaan::find($id);
        $penggunaan->delete();

        return redirect('/tagihan');
    }
}
