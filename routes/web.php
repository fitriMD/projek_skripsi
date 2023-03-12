<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
// Route::delete('deleteuser/{id}', [UserController::class, 'destroy'])->name('users.destroy');    
Route::get('users/hapus/{id}', [UserController::class, 'destroy']);
Route::get('users/update/{id}', [UserController::class, 'edit']);


/** End : User */

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
