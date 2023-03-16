<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
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

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/login', function () {
    return view('login');
});

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

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
