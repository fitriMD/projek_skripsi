<?php

use App\Http\Controllers\AhpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard2');
// });

Route::get('/', function () {
    return redirect('login');
});

Route::get('/template', function () {
    return view('layouts2.template');
});

// metode
Route::get('/ahp', [AhpController::class, 'index']);
Route::get('/ahp/proses', [AhpController::class, 'main']);
Route::get('/ahp/reset', [AhpController::class, 'reset']);

Route::get('/topsis', [TopsisController::class, 'index']);
Route::get('/topsis/detail/{id_topsis}', [TopsisController::class, 'detail']);
Route::post('/topsis/proses', [TopsisController::class, 'main']);
Route::get('/topsis/reset', [TopsisController::class, 'reset']);
Route::get('topsis/hapus/{id}', [TopsisController::class, 'destroy']);
Route::get('/topsis/cetak_pdf/{id_topsis}',[TopsisController::class, 'cetak_pdf'])->name('cetak_pdf');
Route::get('/hasilPerhitungan', [TopsisController::class, 'hasil']);
Route::get('/topsis/perangkingan/{id_topsis}', [TopsisController::class, 'perangkingan']);



/** User */
Route::resource('daftarUser', UserController::class);
Route::get('/createUser', [UserController::class, 'create']);
Route::post('/user-update/{id}', [UserController::class, 'update']);
Route::post('createuser', [UserController::class, 'store'])->name('users.create');
Route::get('users/hapus/{id}', [UserController::class, 'destroy']);
Route::get('users/update/{id}', [UserController::class, 'edit']);
/** End : User */

/** Kelas */
Route::resource('daftarKelas', KelasController::class);
Route::get('/createKelas', [KelasController::class, 'create']);
Route::post('/kelas-update/{id}', [KelasController::class, 'update']);
Route::post('createkelas', [KelasController::class, 'store'])->name('kelas.create');
Route::get('kelas/hapus/{id}', [KelasController::class, 'destroy']);
Route::get('kelas/update/{id}', [KelasController::class, 'edit']);
/** End : Kelas */


/** Siswa */
Route::resource('daftarSiswa', SiswaController::class);
Route::get('/createSiswa', [SiswaController::class, 'create']);
Route::post('/siswa-update/{id}', [SiswaController::class, 'update']);
Route::post('createsiswa', [SiswaController::class, 'store'])->name('siswa.create');
Route::get('siswa/hapus/{id}', [SiswaController::class, 'destroy']);
Route::get('siswa/update/{id}', [SiswaController::class, 'edit']);
/** End : Siswa */

/** Kriteria */
Route::resource('daftarKriteria', KriteriaController::class);
Route::get('/createKriteria', [KriteriaController::class, 'create']);
Route::post('/kriteria-update/{id}', [KriteriaController::class, 'update']);
Route::post('createkriteria', [KriteriaController::class, 'store'])->name('kriteria.create');
Route::get('kriteria/hapus/{id}', [KriteriaController::class, 'destroy']);
Route::get('kriteria/update/{id}', [KriteriaController::class, 'edit']);
/** End : Kriteria */

/** Alternatif */
Route::resource('daftarAlternatif', AlternatifController::class);
Route::get('/createAlternatif', [AlternatifController::class, 'create']);
Route::post('/alternatif-update/{id}', [AlternatifController::class, 'update']);
Route::post('createalternatif', [AlternatifController::class, 'store'])->name('alternatif.create');
Route::get('alternatif/hapus/{id}', [AlternatifController::class, 'destroy']);
Route::get('alternatif/update/{id}', [AlternatifController::class, 'edit']);
/** End : Alternatif */


/** Periode */
Route::resource('daftarPeriode', PeriodeController::class);
Route::get('/createPeriode', [PeriodeController::class, 'create']);
Route::post('/periode-update/{id}', [PeriodeController::class, 'update']);
Route::post('createperiode', [PeriodeController::class, 'store'])->name('periode.create');
Route::get('periode/hapus/{id}', [PeriodeController::class, 'destroy']);
Route::get('periode/update/{id}', [PeriodeController::class, 'edit']);
/** End : User */

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dataSiswa/cetak_pdf',[SiswaController::class, 'cetak_pdf']);

Auth::routes();
