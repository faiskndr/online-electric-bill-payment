<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use PDF;   

class LaporanController extends Controller
{
    public function index()
    {
        $penggunaan = DB::table('penggunaan')->select('penggunaan.*',DB::raw('DATE_FORMAT(penggunaan.created_at, "%Y-%m-%d") as date'), 'pelanggan.username')->join('pelanggan', function($join){
            $join->on('penggunaan.id_pelanggan','=', 'pelanggan.id_pelanggan' );
        })
        ->where('pelanggan.status',1)
        ->paginate(10);

        $pembayaran = DB::table('pembayaran')
                        ->join('tagihan','pembayaran.id_tagihan','=','tagihan.id_tagihan')
                        ->join('pelanggan','pembayaran.id_pelanggan','=','pelanggan.id_pelanggan')
                        ->select('pembayaran.*','tagihan.*','pelanggan.username')
                        ->get();

        $tagihan = Tagihan::orderBy('id_tagihan','desc')->paginate(10);
                        
        return view('laporan.index',compact('penggunaan','pembayaran','tagihan'));
    }

    public function search(Request $request)
    {
        
        if ($request->ajax()) {
            $result ='';
        
            //  $pelanggan = Pelanggan::with('penggunaan')->where('bulan', 'LIKE','%'.$request->search.'%')->get();
            if ($request->from != '' && $request->to != '') {
                $penggunaan = DB::table('penggunaan')->select('penggunaan.*',DB::raw('DATE_FORMAT(penggunaan.created_at, "%Y-%m-%d") as date'), 'pelanggan.username')->join('pelanggan', function ($join){
                    $join->on('penggunaan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                        ->where('pelanggan.status', 1);  
                })
                ->whereBetween(DB::raw('DATE_FORMAT(penggunaan.created_at, "%Y-%m-%d")'), array($request->from, $request->to))
                ->get();
            }else{
                $penggunaan = DB::table('penggunaan')->select('penggunaan.*',DB::raw('DATE_FORMAT(penggunaan.created_at, "%Y-%m-%d") as date'), 'pelanggan.username')->join('pelanggan', function ($join){
                $join->on('penggunaan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                    ->where('pelanggan.status', 1);  
                })
                ->where('penggunaan.bulan', 'LIKE', '%'.$request->search.'%')
                ->orWhere('pelanggan.username', 'LIKE','%'.$request->search.'%')
                ->paginate(10);
            }
         
           
            // foreach ($pelanggan as $item) {  
            //     foreach ($item->penggunaan as $key => $value) {
            //         $result.='<tr>'.
            //         '<td>'.$key + 1 .'</td>'.
            //         '<td>'.$item->username.'</td>'.
            //         '<td>'.$value->id_penggunaan.'</td>'.
            //         '<td>'.$value->bulan.'</td>'.
            //         '<td>'.$value->tahun.'</td>'.
            //         '<td>'.$value->meter_awal.'</td>'.
            //         '<td>'.$value->meter_akhir.'</td>'.
            //         '</tr>';
            //     }
                
            // }
           
            // if (!$pelanggan) {
            //     return $result;
            // }
            
             
             if($penggunaan){

                 foreach ($penggunaan as $key => $item) {
                     $result.='<tr>'.
                             '<td>'.$key + 1 .'</td>'.
                             '<td>'.$item->username.'</td>'.
                             '<td>'.$item->id_penggunaan.'</td>'.
                             '<td>'.$item->bulan.'</td>'.
                             '<td>'.$item->tahun.'</td>'.
                             '<td>'.$item->meter_awal.'</td>'.
                             '<td>'.$item->meter_akhir.'</td>'.
                             '<td>'.$item->date.'</td>'.
                             '</tr>';
                 }
                 return Response($result);
                 
             }
             
         }
    }

    public function SearchTagihan(Request $request)
    {
        if ($request->ajax()) {
            $result = '';

            $tagihan = DB::table('tagihan')->select('tagihan.*','pelanggan.nama_pelanggan',DB::raw('tarif.tarifperkwh * tagihan.jumlah_meter as total'))->join('pelanggan','tagihan.id_pelanggan','=','pelanggan.id_pelanggan')
            ->join('tarif','pelanggan.id_tarif','=','tarif.id_tarif')
            ->where('pelanggan.nama_pelanggan','LIKE','%'.$request->search.'%')
            ->get();

            if($tagihan){

                foreach ($tagihan as $key => $item) {
                    $result.='<tr>'.
                            '<td>'.$key + 1 .'</td>'.
                            '<td>'.$item->id_tagihan.'</td>'.
                            '<td>'.$item->id_pelanggan.'</td>'.
                            '<td>'.$item->nama_pelanggan.'</td>'.
                            '<td>'.$item->jumlah_meter.'</td>'.
                            '<td>'.$item->total.'</td>'.
                            '<td>'.$item->status.'</td>'.
                            '</tr>';
                }
                return Response($result);
                
            }
        }
    }

    public function TagihanPrint(Request $request)
    {
        
        if ($request) {
            $tagihan = DB::table('tagihan')->select('tagihan.*','pelanggan.nama_pelanggan',DB::raw('tarif.tarifperkwh * tagihan.jumlah_meter as total'))->join('pelanggan','tagihan.id_pelanggan','=','pelanggan.id_pelanggan')
            ->join('tarif','pelanggan.id_tarif','=','tarif.id_tarif')
            ->where('pelanggan.nama_pelanggan','LIKE','%'.$request->name.'%')
            ->get();
        }
        $pdf = PDF::loadview('laporan.tagihanPrint',compact('tagihan'))->setOptions(['defaultFont' => 'sans-serif']);
    	return $pdf->stream();
    }


    public function print(Request $request)
    {
        if ($request) {
            $result = DB::table('penggunaan')->select('penggunaan.*',DB::raw('DATE_FORMAT(penggunaan.created_at, "%Y-%m-%d") as date'), 'pelanggan.username')->join('pelanggan', function ($join){
                $join->on('penggunaan.id_pelanggan', '=', 'pelanggan.id_pelanggan')
                    ->where('pelanggan.status', 1);  
                })
                ->where('penggunaan.bulan', 'LIKE', '%'.$request->username.'%')
                ->orWhere('pelanggan.username', 'LIKE','%'.$request->username.'%')
                ->get();
        }else{
            $result = DB::table('penggunaan')->select('penggunaan.*',DB::raw('DATE_FORMAT(penggunaan.created_at, "%Y-%m-%d") as date'), 'pelanggan.username')->join('pelanggan', function($join){
                $join->on('penggunaan.id_pelanggan','=', 'pelanggan.id_pelanggan' );
            })
            ->where('pelanggan.status',1)
            ->get();
        }
       
           
        $pdf = PDF::loadview('laporan.print',compact('result'))->setOptions(['defaultFont' => 'sans-serif']);
    	return $pdf->stream();
        // return view('laporan.print',compact('penggunaan'));
    }
}
