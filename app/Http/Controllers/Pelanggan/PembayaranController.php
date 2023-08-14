<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = session('id_pembayaran');
        $token = session('token');
        $id_pelanggan = $request->user()->id_pelanggan;
        $pembayaran = Pembayaran::where([['id_pembayaran',$id], ['id_pelanggan', $id_pelanggan]])->first();
        $belumBayar = Tagihan::where([['id_pelanggan', $id],['status', 'Belum Bayar']])->get();
        return view('user.pembayaran.index', compact('pembayaran','belumBayar','token'),[
            'title' => 'Pembayaran'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tagihan = Tagihan::where('id_tagihan', $id)->first();
        if(!$tagihan){
            abort(404);
        }

        $idBayar = session('id_pembayaran');
        
        if($idBayar){   
            return redirect()->route('pembayaran.index');
        }

        $validate = $tagihan->validate([

        ]);

        $biayaAdmin = 2500;

        // foreach ($tagihan as $item) {
        //     $pembayaran = new Pembayaran();
        //     $pembayaran->id_tagihan = $id;
        //     $pembayaran->id_pelanggan = $item->id_pelanggan;
        //     $pembayaran->tanggal_pembayaran =  \Carbon\Carbon::now();
        //     $pembayaran->bulan_bayar =  \Carbon\Carbon::now()->format('M');
        //     $pembayaran->biaya_admin = $biayaAdmin;
        //     $pembayaran->total_bayar = $item->jumlah_meter * $item->pelanggan->tarif->tarifperkwh + $biayaAdmin;
        //     $pembayaran->id_admin = 0;
        //     $pembayaran->save();

        // }
        session(['id_pembayaran' => $pembayaran->id_pembayaran]);
     
        return redirect()->route('pembayaran.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
       $validate = Validator::make($request->all(),[
        'id_tagihan' => 'required',
        'nama_pelanggan' => 'required',
        'jumlah_meter' => 'required',
        'tanggal_pembayaran' => 'required',
        'total' => 'required',
        'status' => 'required',
        'bank' => 'required'
       ]);

       if ($validate->fails()) {
         return response()->json(['message' => 'invalid', 'data' => $validate->errors()]);
       }
      
       try {
        DB::beginTransaction();
        $serverKey = config('app.server_key');
        $tagihan = Tagihan::find($request->id_tagihan);

        $pembayaran = Pembayaran::create([
            'id_tagihan' => $request->id_tagihan,
            'id_pelanggan' => $tagihan->id_pelanggan,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'bulan_bayar' =>  \Carbon\Carbon::now()->format('M'),
            'biaya_admin' => 2500,
            'total_bayar' => $request->total,
            'id_admin' => 0
        ]);
        $pembayaran->save();
    
        

       $response = Http::withBasicAuth($serverKey,'')
            ->post('https://api.sandbox.midtrans.com/v2/charge',[
                'payment_type' => 'bank_transfer',
                'transaction_details'=>[
                    'order_id' => $pembayaran->id_pembayaran,
                    'gross_amount' => $request->total,
                ],
                'bank_transfer' => [
                    'bank' => $request->bank
                ],
                'customer_details'=>[
                    'first_name' => $request->nama_pelanggan
                ]
            ]);

        DB::commit();
        return response()->json($response->json());
       } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['massage'=> $e->getMessage()],500);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $idBayar = session('id_pembayaran');
        
        if($idBayar){   
            return redirect()->route('pembayaran.index');
        }

        $tagihan = Tagihan::find($id);

            $pembayaran = new Pembayaran();
            $pembayaran->id_tagihan = $id;
            $pembayaran->id_pelanggan = $tagihan->id_pelanggan;
            $pembayaran->tanggal_pembayaran =  \Carbon\Carbon::now()->format('Y-m-d');
            $pembayaran->bulan_bayar =  \Carbon\Carbon::now()->format('M');
            $pembayaran->biaya_admin = 2500;
            // $pembayaran->jumlah_meter = $tagihan->jumlah_meter;
            // $pembayaran->tarif = $pembayaran->pelanggan->tarif->tarifperkwh;
            $pembayaran->total_bayar = $tagihan->jumlah_meter * $pembayaran->pelanggan->tarif->tarifperkwh + 2500;
            $pembayaran->id_admin = 0;
            $pembayaran->virtual_account = 'NULL';
            $pembayaran->save();

            session(['id_pembayaran' => $pembayaran->id_pembayaran]);

            $belumBayar = Tagihan::where([['id_pelanggan', $id],['status', 'Belum Bayar']])->get();

         // Set your Merchant Server Key
         \Midtrans\Config::$serverKey = config('app.server_key');
         // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
         \Midtrans\Config::$isProduction = false;
         // Set sanitization on (default)
         \Midtrans\Config::$isSanitized = true;
         // Set 3DS transaction for credit card to true
         \Midtrans\Config::$is3ds = true;
                $params = array(
                    'transaction_details' => array(
                        'order_id' => $pembayaran->id_pembayaran,
                        'gross_amount' => $pembayaran->total_bayar,
                    ),
                    'customer_details' => array(
                        'first_name' => $tagihan->pelanggan->nama_pelanggan,
                        
                    ),
                );
 
         $token = \Midtrans\Snap::getSnapToken($params);
        
         session(['token' => $token]);
        return view('user.pembayaran.index', compact('pembayaran','belumBayar','token'));
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
        $status = "Menunggu Konfirmasi";
        $tagihan = Tagihan::find($id);
        $tagihan->status = $status;
        $tagihan->update();
        return redirect('/beranda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::find($id);
        $pembayaran->delete();
        session()->forget('id_pembayaran');
        return redirect()->route('tagihan');
    }
}
