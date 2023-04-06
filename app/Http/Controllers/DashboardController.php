<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::count();
        $siswa = Siswa::count();
        $kelas = kelas::count();
        $kriteria = Kriteria::count();

        return view('dashboard', compact('users','siswa','kelas','kriteria'));
    }
}
