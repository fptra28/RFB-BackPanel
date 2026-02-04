<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriWakilPialang;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class KategoriWakilPialangController extends Controller
{
    public function index(): JsonResponse
    {
        $kategoriWakilPialang = Cache::remember('api:kategori-wakil-pialang:index', 300, function () {
            return KategoriWakilPialang::query()
                ->select(['id', 'nama_kategori', 'slug'])
                ->withCount('wakilPialang')
                ->orderBy('nama_kategori')
                ->get();
        });

        return response()->json($kategoriWakilPialang);
    }

    public function showBySlug(string $slug): JsonResponse
    {
        $cacheKey = 'api:kategori-wakil-pialang:slug:' . $slug;
        $kategori = Cache::remember($cacheKey, 300, function () use ($slug) {
            return KategoriWakilPialang::query()
                ->select(['id', 'nama_kategori', 'slug'])
                ->withCount('wakilPialang')
                ->where('slug', $slug)
                ->first();
        });

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        return response()->json($kategori);
    }

    public function getWakilByKategori(string $slug): JsonResponse
    {
        $kategoriCacheKey = 'api:kategori-wakil-pialang:slug:' . $slug;
        $kategori = Cache::remember($kategoriCacheKey, 300, function () use ($slug) {
            return KategoriWakilPialang::query()
                ->select(['id', 'nama_kategori', 'slug'])
                ->where('slug', $slug)
                ->first();
        });

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        $wakilCacheKey = 'api:kategori-wakil-pialang:wakil:' . $slug;
        $wakil = Cache::remember($wakilCacheKey, 300, function () use ($kategori) {
            return $kategori->wakilPialang()
                ->select(['id', 'nama', 'nomor_izin', 'status', 'category_id'])
                ->orderBy('nama')
                ->get();
        });

        return response()->json([
            'kategori' => $kategori,
            'wakil' => $wakil,
        ]);
    }
}
