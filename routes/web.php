<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\JfxController;
use App\Http\Controllers\KategoriWakilPialangController;
use App\Http\Controllers\ProfileWebsiteController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\WakilPialangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Autentikasi tanpa register, reset, dan verify
Auth::routes([
    'register' => false,
    'reset'    => false,
    'verify'   => false,
]);

// Home dan Profile
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Produk JFX
Route::prefix('produk/jfx')->name('jfx.')->group(function () {
    Route::get('/', [JfxController::class, 'index'])->name('index');
    Route::post('/store', [JfxController::class, 'store'])->name('store');
    Route::get('/tambah', [JfxController::class, 'create'])->name('create');
    Route::put('/{id}/update', [JfxController::class, 'update'])->name('update');
    Route::get('/{id}/edit', [JfxController::class, 'edit'])->name('edit');
    Route::get('/{id}/show', [JfxController::class, 'show'])->name('show');
    Route::delete('/{id}/delete', [JfxController::class, 'destroy'])->name('destroy');
});

// Produk SPA
Route::prefix('produk/spa')->name('spa.')->group(function () {
    Route::get('/', [SpaController::class, 'index'])->name('index');
    Route::post('/store', [SpaController::class, 'store'])->name('store');
    Route::get('/tambah', [SpaController::class, 'create'])->name('create');
    Route::put('/{id}/update', [SpaController::class, 'update'])->name('update');
    Route::get('/{id}/edit', [SpaController::class, 'edit'])->name('edit');
    Route::get('/{id}/show', [SpaController::class, 'show'])->name('show');
    Route::delete('/{id}/delete', [SpaController::class, 'destroy'])->name('destroy');
});

// Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::post('/store', [BeritaController::class, 'store'])->name('store');
    Route::get('/tambah', [BeritaController::class, 'create'])->name('create');
    Route::put('/{id}/update', [BeritaController::class, 'update'])->name('update');
    Route::get('/{id}/edit', [BeritaController::class, 'edit'])->name('edit');
    Route::get('/{id}/show', [BeritaController::class, 'show'])->name('show');
    Route::delete('/{id}/delete', [BeritaController::class, 'destroy'])->name('destroy');
});

// Wakil Pialang & Kategori
Route::prefix('wakil-pialang')->group(function () {
    // Kategori Wakil Pialang
    Route::name('kategori-wakil.')->group(function () {
        Route::get('/', [KategoriWakilPialangController::class, 'index'])->name('index');
        Route::post('/store', [KategoriWakilPialangController::class, 'store'])->name('store');
        Route::get('/tambah', [KategoriWakilPialangController::class, 'create'])->name('create');
        Route::put('/{id}/update', [KategoriWakilPialangController::class, 'update'])->name('update');
        Route::get('/{id}/edit', [KategoriWakilPialangController::class, 'edit'])->name('edit');
        Route::delete('/{id}/delete', [KategoriWakilPialangController::class, 'destroy'])->name('destroy');
    });

    // Wakil Pialang berdasarkan kategori (slug)
    Route::name('wakil.')->group(function () {
        Route::get('/{slug}', [WakilPialangController::class, 'index'])->name('index');
        Route::post('/{slug}/store', [WakilPialangController::class, 'store'])->name('store');
        Route::get('/{slug}/tambah', [WakilPialangController::class, 'create'])->name('create');
        Route::put('/{slug}/{id}/update', [WakilPialangController::class, 'update'])->name('update');
        Route::get('/{slug}/{id}/edit', [WakilPialangController::class, 'edit'])->name('edit');
        Route::delete('/{slug}/{id}/destroy', [WakilPialangController::class, 'destroy'])->name('destroy');
    });
});

// Profile Website
Route::prefix('website')->name('profileWeb.')->group(function () {
    Route::get('/profile', [ProfileWebsiteController::class, 'index'])->name('index');
    Route::put('/update', [ProfileWebsiteController::class, 'storeOrUpdate'])->name('storeOrUpdate');
    Route::delete('/delete/{id}', [ProfileWebsiteController::class, 'destroy'])->name('destroy');
});

// Banner
Route::prefix('banner')->name('banner.')->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('index');
});



// Fallback untuk halaman tidak ditemukan
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
