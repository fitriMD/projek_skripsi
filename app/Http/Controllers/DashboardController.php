<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $topsis = DB::table("topsis");
        
        $users = User::count();
        $siswa = Siswa::count();
        $kelas = kelas::count();
        $kriteria = Kriteria::count();

        return view('dashboard2', compact('users','siswa','kelas','kriteria', 'topsis'));
    }


}
