<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\KategoriController;
// use App\Http\Controllers\BukuController;
// use App\Http\Controllers\AnggotaController;
// use App\Http\Controllers\PeminjamController;
// use App\Http\Controllers\DashboardController;
// use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\HomeController;
// use App\Http\Middleware\IsAdmin;
// use App\Http\Controllers\ProfileController;




    // route::get('/', function () {
    //     return view('layouts.app');
    // });
// // Halaman umum
// Route::get('/', function () { return view('home'); })->name('home');
// Route::get('/home', function () { return view('home'); })->name('home');
// Route::get('/about', function () { return view('about'); })->name('about');
// //dashboard
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// //akses admin
// Route::middleware(['auth', IsAdmin::class])->group(function () 
// {
//     Route::resource('buku', BukuController::class);
//     Route::resource('kategori', KategoriController::class);
//     Route::resource('anggota', AnggotaController::class);
//     Route::resource('peminjam', PeminjamController::class)->except(['create']);
    
// });
// //kategori
// route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
// route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
// route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
// route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
// route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
// route::delete('/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// //CRUD buku
// route::get('buku', [BukuController::class, 'index'])->name('buku.index');
// route::get('buku/create', [BukuController::class, 'create'])->name('buku.create');
// route::post('buku/store', [BukuController::class, 'store'])->name('buku.store');
// route::get('buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
// route::put('buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
// route::delete('buku/destroy/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

// //CRUD anggota
// route::get('anggota', [AnggotaController::class, 'index'])->name('anggota.index');
// route::get('anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
// route::post('anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
// route::get('anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
// route::put('anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
// route::delete('anggota/destroy/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

//peminjam buku
// route::get('peminjam', [PeminjamController::class, 'index'])->name('peminjam.index');
// route::get('peminjam/create', [PeminjamController::class, 'create'])->name('peminjam.create');
// route::post('peminjam/store', [PeminjamController::class, 'store'])->name('peminjam.store');
// route::get('peminjam/edit/{id}', [PeminjamController::class, 'edit'])->name('peminjam.edit');
// route::put('peminjam/update/{id}', [PeminjamController::class, 'update'])->name('peminjam.update');
// route::delete('peminjam/destroy/{id}', [PeminjamController::class, 'destroy'])->name('peminjam.destroy');

// route::get('/peminjam/create/{buku}', [PeminjamController::class, 'createSingle'])->name('peminjam.create.single');
// Route::post('/peminjam/store-single/{buku}', [PeminjamController::class, 'storeSingle'])->name('peminjam.store.single');

//pengembalian buku
// Route::get('/peminjam/return/{id}', [PeminjamController::class, 'showreturnform'])->name('peminjam.return.form');
// Route::post('/peminjam/return/{id}', [PeminjamController::class, 'processreturn'])->name('peminjam.processreturn');

// Auth::routes();

// Route::get('/peminjam/create/{buku}', [PeminjamController::class, 'createSingle'])->name('peminjam.create.single');
// Route::post('/peminjam/store-single/{buku}', [PeminjamController::class, 'storeSingle'])->name('peminjam.store.single');

// Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');



use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;

// Halaman umum (tanpa login)
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/home', function () { return view('home'); });
Route::get('/about', function () { return view('about'); })->name('about');

// Auth (login, register, dll.)
Auth::routes();

// Dashboard (butuh login)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Profil anggota (butuh login)
Route::get('/profil', [ProfileController::class, 'index'])
    ->middleware('auth')
    ->name('profil.index');

// LIST & DETAIL BUKU (semua user login)
Route::middleware('auth')->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{buku}', [BukuController::class, 'show'])->name('buku.show');
});

// AKSES ADMIN SAJA
Route::middleware(['auth', IsAdmin::class])->group(function () {

    // CRUD Kategori
    Route::resource('kategori', KategoriController::class);

    // CRUD Buku (kecuali index & show)
    Route::resource('buku', BukuController::class)->except(['index', 'show']);

    // CRUD Anggota
    Route::resource('anggota', AnggotaController::class);

    // CRUD Peminjam (admin mengelola data peminjaman)
    Route::resource('peminjam', PeminjamController::class)->except(['create']);

    // Pengembalian buku
    Route::get('/peminjam/return/{id}', [PeminjamController::class, 'showreturnform'])
        ->name('peminjam.return.form');
    Route::post('/peminjam/return/{id}', [PeminjamController::class, 'processreturn'])
        ->name('peminjam.processreturn');
});

// PINJAM SINGLE (semua user login, admin & anggota)
Route::middleware('auth')->group(function () {
    Route::get('/peminjam/create/{buku}', [PeminjamController::class, 'createSingle'])
        ->name('peminjam.create.single');
    Route::post('/peminjam/store-single/{buku}', [PeminjamController::class, 'storeSingle'])
        ->name('peminjam.store.single');
});
