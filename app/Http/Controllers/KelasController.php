<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
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
        // $kelas = Kelas::with('waliKelas')->get();
        $kelas = DB::table('data_kelas')
        ->select('data_kelas.*','data_user.*')
        ->join('data_user','data_user.id_user','=','data_kelas.id_user_walikelas')
        ->get();
        return view('kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $waliKelas=User::all()
                 ->where('roles', 'wali_kelas');
        return view('kelas.create', ['waliKelas' => $waliKelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $waliKelas=User::all();
        $request->validate([
            'nama_kelas' => 'required',
            'id_user_walikelas' => 'required',
            
        ]);

        $kelas = new Kelas();
        $kelas->nama_kelas = $request->get('nama_kelas');
        $kelas->id_user_walikelas = $request->get('id_user_walikelas');
        $kelas->save();
        
        // $waliKelas = new User;
        
        // $kelas->waliKelas()->save($waliKelas);
        $kelas->save();

        if ($kelas) {
            return redirect('daftarKelas')->with('success', 'Data kelas Berhasil Ditambahkan');
        } else {
            return redirect()->route('kelas.create')->with('toast_error', 'Data kelas Gagal Ditambahkan');
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
        $kelas = Kelas::find($id);
        $waliKelas = User::all()
        ->where('roles', 'wali_kelas');
        return view('kelas.update', ['kelas' => $kelas, 'waliKelas' => $waliKelas]);

        // return view('kelas.update', ['kelas' => $kelas]);
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
        $request->validate(
            [
                'nama_kelas' => 'required|string|max:7',
                'id_user_walikelas' => 'required',

            ],
            [
                'C1.string'    => "Nama kelas tidak boleh lebih dari 7 huruf",

            ]
        );
        $kelas = Kelas::find($id);
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->id_user_walikelas = $request->id_user_walikelas;
        $kelas->save();

        return redirect('daftarKelas')->with('success', 'Data Kelas Berhasil Diupadate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::find($id)->delete();
        return redirect('daftarKelas')->with('success', 'Data Kelas Berhasil Dihapus');
    }
}
