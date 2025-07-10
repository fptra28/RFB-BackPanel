<?php

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

Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/berita/{slug}', [BeritaController::class, 'show']);

Route::get('/jfx', [JfxController::class, 'index']);
Route::get('/jfx/{slug}', [JfxController::class, 'show']);

Route::get('/spa', [SpaController::class, 'index']);
Route::get('/spa/{slug}', [SpaController::class, 'show']);

Route::get('/kategori-wakil-pialang', [KategoriWakilPialangController::class, 'index']);

Route::get('/wakil-pialang', [WakilPialangController::class, 'index']);
