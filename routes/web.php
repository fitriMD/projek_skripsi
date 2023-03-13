<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;

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

Route::get('/daftarSiswa', function () {
    return view('siswa.index');
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

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
