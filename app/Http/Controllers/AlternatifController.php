<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Alternatif;
use App\Models\Periode;
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
            ->select("data_alternatif.*", "data_siswa.*", "periode.*")
            ->join("data_siswa", "data_siswa.id_siswa", "=", "data_alternatif.id_siswa")
            ->join("periode", "periode.id_periode", "=", "data_alternatif.id_periode")
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
        $periode = Periode::all();
        return view('alternatif.create', compact('siswa', 'periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'id_siswa' => 'required',
                'id_periode' => 'required',
                'C1' => 'required|numeric',
                'C2' => 'required|string|max:1',
                'C3' => 'required|integer',
                'C4' => 'required|string|max:1',
                'C5' => 'required|string|max:1',
                'C6' => 'required|numeric',

            ],
            [
                'C1.numeric'    => "Harap masukkan bilangan desimal",
                'C6.numeric'    => "Harap masukkan bilangan desimal"

            ]
        );

        $alternatif = new Alternatif();
        $alternatif->id_siswa = $request->get('id_siswa');
        $alternatif->id_periode = $request->get('id_periode');
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
            Session::flash('success', 'Data kelas Berhasil Ditambahkan');
            return redirect('daftarAlternatif');
        } else {
            Session::flash('failed', 'Data kelas Gagal Ditambahkan');
            return redirect()->route('alternatif.create');
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
