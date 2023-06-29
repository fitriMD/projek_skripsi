<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Alternatif;
use App\Models\Periode;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->roles=='admin' || Auth::user()->roles=='kepala_sekolah'){
            $alternatif = DB::table("data_alternatif")
            ->select("data_alternatif.*", "data_siswa.*", "periode.*")
            ->join("data_siswa", "data_siswa.id_siswa", "=", "data_alternatif.id_siswa")
            ->join("periode", "periode.id_periode", "=", "data_alternatif.id_periode")
            ->get();
        }
        else {
            $walikelas = User::where('id_user', Auth::user()->id_user)->first();
            $siswa = Siswa::where('id_kelas_siswa',$walikelas->kelas->id_kelas)
            ->pluck('id_siswa')
            ->toArray();
            $alternatif = Alternatif::whereIn('id_siswa',$siswa)
            ->get();
        }
        
        return view('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->roles=='admin' || Auth::user()->roles=='kepala_sekolah'){
            $siswa = Siswa::all();
        }
        else {
            $walikelas = User::where('id_user', Auth::user()->id_user)->first();
            $siswa = Siswa::where('id_kelas_siswa',$walikelas->kelas->id_kelas)
            ->orderBy('nama','ASC')
            ->get();
        }
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
            return redirect('daftarAlternatif')->with('success', 'Data Alternatif Berhasil Ditambahkan');
        } else {
            return redirect()->route('alternatif.create')->with('toast_error', 'Data Alternatif Gagal Ditambahkan');
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
        if (Auth::user()->roles=='admin' || Auth::user()->roles=='kepala_sekolah'){
            $siswa = Siswa::all();
        }
        else {
            $walikelas = User::where('id_user', Auth::user()->id_user)->first();
            $siswa = Siswa::where('id_kelas_siswa',$walikelas->kelas->id_kelas)
            ->orderBy('nama','ASC')
            ->get();
        }
        
        $alternatif = Alternatif::find($id);
        // $siswa = Siswa::all();
        // return view('alternatif.update', ['alternatif' => $alternatif, 'siswa' => $siswa]);
        $periode = Periode::all();
        return view('alternatif.update', compact('alternatif','siswa', 'periode'));
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

        return redirect('daftarAlternatif')->with('success', 'Data Alternatif Berhasil Diupadate');
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
        return redirect('daftarAlternatif')->with('success', 'Data Alternatif Berhasil Dihapus');
    }
}
