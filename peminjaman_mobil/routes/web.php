<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, "logout"])->name('logout');
Route::get('/register', [LoginController::class, "register"])->name('register');

Route::post('/doregister', [LoginController::class, "doRegister"])->name('do.register');
Route::post('/login', [LoginController::class, "doLogin"])->name('do.login');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/mobil', [MobilController::class, 'index']);
    Route::group(['as' => 'mobil.', 'prefix' => 'mobil'], function () {
        Route::get('/search', [MobilController::class, 'search']);
        Route::put('/store', [MobilController::class, 'store']);
        Route::get('/create', [MobilController::class, 'create']);

        Route::get('/form', [PeminjamanController::class, 'form']);
        Route::put('/check', [PeminjamanController::class, 'index']);
        Route::put('/pinjam/{id}', [PeminjamanController::class, 'store'])->name('pinjam');

        Route::get('/pengembalian', [PeminjamanController::class, 'pengembalian']);
        Route::put('/kembali', [PeminjamanController::class, 'kembali']);
        });
    // Route::get('/kategori', [KategoriController::class, 'index']);

    
});