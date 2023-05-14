<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Periode;
use App\Models\Siswa;
use PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SiswaController extends Controller
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
        
        // $siswa = Siswa::with('kelas')->get();
        $siswa = DB::table('data_siswa')
                ->select("data_siswa.*","data_kelas.*","periode.*")
                ->join('data_kelas','data_kelas.id_kelas','=','data_siswa.id_kelas_siswa')
                ->join('periode','periode.id_periode','=','data_siswa.id_periode')
                ->get();
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        $periode = Periode::all();
        return view('siswa.create', compact('kelas', 'periode'));
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
            'id_periode' => 'required',
            'nis' => 'required',
            'nama' => 'required',
            'gender' => 'required',
            'id_kelas_siswa' => 'required',

        ]);

        $siswa = new Siswa();
        $siswa->id_periode = $request->get('id_periode');
        $siswa->nis = $request->get('nis');
        $siswa->nama = $request->get('nama');
        $siswa->gender = $request->get('gender');
        $siswa->id_kelas_siswa = $request->get('id_kelas_siswa');
        $siswa->save();
        
        // $kelas = new Kelas();
        
        // $siswa->kelas()->save($kelas);
        $siswa->save();

        if ($siswa) {
            Session::flash('success','Data Siswa Berhasil Ditambahkan');
            return redirect('daftarSiswa');
        } else {
            Session::flash('failed','Data kelas Gagal Ditambahkan');
            return redirect()->route('siswa.create');
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
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        $periode = Periode::all();
  
        return view('siswa.update', compact('siswa', 'kelas', 'periode'));
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
        $siswa = Siswa::find($id);
        $siswa->id_periode = $request->id_periode;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->gender = $request->gender;
        $siswa->id_kelas_siswa = $request->id_kelas_siswa;

        $siswa->save();

        return redirect('daftarSiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Siswa::find($id)->delete();
        return redirect('daftarSiswa');
    }

    public function cetak_pdf(){
        $siswa = DB::table('data_siswa')
                ->select("data_siswa.*","data_kelas.*")
                ->join('data_kelas','data_kelas.id_kelas','=','data_siswa.id_kelas_siswa')
                ->get();
        // $siswa = Siswa::all();
        $pdf = PDF::loadview('siswa.cetak_pdf',['siswa'=>$siswa]);
        return $pdf->stream();
    }
}
