<?php

use App\Http\Controllers\Api\BannerController as ApiBannerController;
use App\Http\Controllers\Api\BeritaController;
use App\Http\Controllers\Api\JfxController;
use App\Http\Controllers\Api\KategoriWakilPialangController;
use App\Http\Controllers\Api\SpaController;
use App\Http\Controllers\Api\WakilPialangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Berita API Routes
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);

// JFX API Routes
Route::get('/jfx', [JfxController::class, 'index']);
Route::get('/jfx/{slug}', [JfxController::class, 'show']);

// SPA API Routes
Route::get('/spa', [SpaController::class, 'index']);
Route::get('/spa/{slug}', [SpaController::class, 'show']);

// Kategori Wakil Pialang API
Route::prefix('kategori-wakil-pialang')->group(function () {
    Route::get('/', [KategoriWakilPialangController::class, 'index']);
    Route::get('/{slug}', [KategoriWakilPialangController::class, 'showBySlug']);
    Route::get('/{slug}/wakil', [KategoriWakilPialangController::class, 'getWakilByKategori']);
});

// Wakil Pialang API
Route::get('/wakil-pialang', [WakilPialangController::class, 'index']);

// Banner API
Route::get('/banners', [ApiBannerController::class, 'index']);
Route::get('/banners/{id}', [ApiBannerController::class, 'show']);
Route::post('/banners', [ApiBannerController::class, 'store']);
Route::put('/banners/{id}', [ApiBannerController::class, 'update']);
Route::delete('/banners/{id}', [ApiBannerController::class, 'destroy']);
