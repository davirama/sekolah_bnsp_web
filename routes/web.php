<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Middleware\admin;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Models\Kelas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');
Route::post('/daftar', [Controller::class, 'daftar'])->name('daftar');
Route::post('/login', [Controller::class, 'login'])->name('login');
Route::post('/logout', [Controller::class, 'logout'])->name('logout');
Route::get('/halamanregis', [Controller::class, 'halamanregis'])->name('halamanregis');
Route::post('/regispeserta', [Controller::class, 'regispeserta'])->name('regispeserta');
// Route::get('/registrasi', function () {
//     // Mengambil semua data dari model Kelas

//     // Mengirimkan data kelas ke view 'regis'
//     return view('regis');
// });

Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');
    // Route::post('/logout', [Controller::class, 'logout'])->name('logout');
    Route::get('/updatepage', [Controller::class, 'updatepage'])->name('updatepage');
    Route::post('/update', [Controller::class, 'update'])->name('update');
});

Route::middleware([admin::class])->group(function () {
    Route::get('/dashboardadmin', [AdminController::class, 'dashboardAdmin'])->name('admin.dashboard');
});
