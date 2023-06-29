<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Session;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::orderBy('created_at','ASC')
        ->get();
        return view('periode.index', compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode=Periode::all();
        return view('periode.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = new Periode();
        $periode->nama_periode = $request->input('nama_periode');
        $periode->status = $request->input('status');

        

        // cek apakah user memilih status aktif ? 
        if ( $request->status == "aktif" ) {

            // cek apakah sebelumnya mmeiliki data yg berstatus = aktif ?
            $cek = Periode::where('status', "aktif");

            if ( $cek->count() > 0 ) { // di database ada yg berstatus "aktif"

                $id_periode = $cek->first()->id_periode;
                $updateData = Periode::find( $id_periode );
                $updateData->status = "tidak_aktif";

                $updateData->save();
            }
        }
        // echo $cek;

        $periode->save();
        if ($periode) {
            return redirect('daftarPeriode')->with('success', 'Data Periode Berhasil Ditambahkan');
        } else {
            return redirect()->route('periode.create')->with('toast_error', 'Data Periode Gagal Ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $periode = Periode::find($id);

        return view('periode.update', ['periode' => $periode]);
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
        $periode = Periode::find($id);
        $periode->nama_periode = $request->nama_periode;
        $periode->status = $request->status;



        // cek apakah user memilih status aktif ? 
        if ( $request->status == "aktif" ) {

            // cek apakah sebelumnya mmeiliki data yg berstatus = aktif ?
            $cek = Periode::where('status', "aktif");

            if ( $cek->count() > 0 ) { // di database ada yg berstatus "aktif"

                $id_periode = $cek->first()->id_periode;
                $updateData = Periode::find( $id_periode );
                $updateData->status = "tidak_aktif";

                $updateData->save();
            }
        }
        
        $periode->save();

        return redirect('daftarPeriode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Periode::find($id)->delete();
        return redirect('daftarPeriode');
    }
}
