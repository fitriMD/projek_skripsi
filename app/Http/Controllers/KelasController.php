<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with('waliKelas')->get();

        // $kelas = Kelas::with('waliKelas')->get();
        // $kelas = Kelas::orderBy('id_kelas','ASC')
        // ->get();
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
        
        $waliKelas = new User;
        // $waliKelas->id_user = $request->get('id_user_walikelas');
        
        $kelas->waliKelas()->save($waliKelas);
        $kelas->save();

        if ($kelas) {
            Session::flash('success','Data kelas Berhasil Ditambahkan');
            return redirect('daftarKelas');
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
        $kelas = Kelas::find($id);
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->id_user_walikelas = $request->id_user_walikelas;
        $kelas->save();

        return redirect('daftarKelas');
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
        return redirect('daftarKelas');
    }
}
