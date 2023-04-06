<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Alternatif;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //$alternatif = Alternatif::with('siswa')->get();
        $alternatif = DB::table("data_alternatif")
                        ->select("data_alternatif.*", "data_siswa.*")
                        ->join("data_siswa", "data_siswa.id_siswa", "=", "data_alternatif.id_siswa")
                        ->get();

        return view('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = Siswa::all();
        return view('alternatif.create', ['siswa' => $siswa]);
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
            'id_siswa' => 'required',
            'C1' => 'required',
            'C2' => 'required',
            'C3' => 'required',
            'C4' => 'required',
            'C5' => 'required',
            'C6' => 'required',

        ]);

        $alternatif = new Alternatif();
        $alternatif->id_siswa = $request->get('id_siswa');
        $alternatif->C1 = $request->get('C1');
        $alternatif->C2 = $request->get('C2');
        $alternatif->C3 = $request->get('C3');
        $alternatif->C4 = $request->get('C4');
        $alternatif->C5 = $request->get('C5');
        $alternatif->C6 = $request->get('C6');
        $alternatif->save();
        
        // $siswa = new Siswa();
        
        // $alternatif->siswa()->save($siswa);
        $alternatif->save();

        if ($alternatif) {
            Session::flash('success','Data kelas Berhasil Ditambahkan');
            return redirect('daftarAlternatif');
        } else {
            Session::flash('failed','Data kelas Gagal Ditambahkan');
            return redirect()->route('kelas.create');
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
        $alternatif = Alternatif::find($id);
        $siswa = Siswa::all();
        return view('alternatif.update', ['alternatif' => $alternatif, 'siswa' => $siswa]);
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
        $alternatif = Alternatif::find($id);
        $alternatif->id_siswa = $request->id_siswa;
        $alternatif->C1 = $request->C1;
        $alternatif->C2 = $request->C2;
        $alternatif->C3 = $request->C3;
        $alternatif->C4 = $request->C4;
        $alternatif->C5 = $request->C5;
        $alternatif->C6 = $request->C6;
        $alternatif->save();

        return redirect('daftarAlternatif');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Alternatif::find($id)->delete();
        return redirect('daftarAlternatif');
    }
}
