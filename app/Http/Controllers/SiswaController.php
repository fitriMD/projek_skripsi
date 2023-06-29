<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Periode;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->roles=='admin' || Auth::user()->roles=='kepala_sekolah'){
            $siswa = DB::table('data_siswa')
            ->select("data_siswa.*","data_kelas.*","periode.*")
            ->join('data_kelas','data_kelas.id_kelas','=','data_siswa.id_kelas_siswa')
            ->join('periode','periode.id_periode','=','data_siswa.id_periode')
            ->orderBy('nama','ASC')
            ->get();
        }
        else {
            $walikelas = User::where('id_user', Auth::user()->id_user)->first();
            $siswa = Siswa::where('id_kelas_siswa',$walikelas->kelas->id_kelas)
            ->orderBy('nama','ASC')
            ->get();


        }
        
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
            'nis' => 'required|string|max:10|unique:data_siswa',
            'nama' => 'required|string|max:75|',
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
            return redirect('daftarSiswa')->with('success', 'Data Siswa Berhasil Ditambahkan');
        } else {
            return redirect()->route('siswa.create')->with('toast_error', 'Data Siswa Gagal Ditambahkan');
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
        $request->validate([
            'id_periode' => 'required',
            'nis' => 'required|string|max:10|unique:data_siswa',
            'nama' => 'required|string|max:75|',
            'gender' => 'required',
            'id_kelas_siswa' => 'required',
        ]);
        
        $siswa = Siswa::find($id);
        $siswa->id_periode = $request->id_periode;
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->gender = $request->gender;
        $siswa->id_kelas_siswa = $request->id_kelas_siswa;

        $siswa->save();

        return redirect('daftarSiswa')->with('success', 'Data Siswa Berhasil Diupadate');
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
        return redirect('daftarSiswa')->with('success', 'Data Siswa Berhasil Dihapus');
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
