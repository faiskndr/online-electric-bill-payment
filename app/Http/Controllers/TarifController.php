<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarif;


class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarif = Tarif::all();
        return view('tarif.index', compact('tarif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarif = Tarif::create([
            'daya' => $request->daya,
            'tarifperkwh' => $request->tarif
        ]);
        return redirect('tarif');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Tarif::insert($request->except('_token', '_method'));
        return redirect('tarif');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarif = Tarif::find($id);

        return response()->json($tarif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarif = Tarif::find($id);

        return response()->json($tarif);
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
        $tarif = Tarif::find($id);
        $tarif->daya = $request->daya;
        $tarif->tarifperkwh = $request->tarifperkwh;
        $tarif->update();
        return redirect('/tarif');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tarif = Tarif::find($id);
        $tarif->delete();
        return response(null, 204);
    }
}
