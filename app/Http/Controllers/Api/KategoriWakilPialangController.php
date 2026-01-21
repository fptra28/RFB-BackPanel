<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriWakilPialang;
use Illuminate\Http\JsonResponse;

class KategoriWakilPialangController extends Controller
{
    public function index(): JsonResponse
    {
        $kategoriWakilPialang = KategoriWakilPialang::query()
            ->select(['id', 'nama_kategori', 'slug'])
            ->withCount('wakilPialang')
            ->orderBy('nama_kategori')
            ->get();

        return response()->json($kategoriWakilPialang);
    }

    public function showBySlug(string $slug): JsonResponse
    {
        $kategori = KategoriWakilPialang::query()
            ->select(['id', 'nama_kategori', 'slug'])
            ->withCount('wakilPialang')
            ->where('slug', $slug)
            ->first();

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        return response()->json($kategori);
    }

    public function getWakilByKategori(string $slug): JsonResponse
    {
        $kategori = KategoriWakilPialang::query()
            ->select(['id', 'nama_kategori', 'slug'])
            ->where('slug', $slug)
            ->first();

        if (!$kategori) {
            return response()->json(['message' => 'Kategori tidak ditemukan.'], 404);
        }

        $wakil = $kategori->wakilPialang()
            ->select(['id', 'nama', 'nomor_izin', 'status', 'category_id'])
            ->orderBy('nama')
            ->get();

        return response()->json([
            'kategori' => $kategori,
            'wakil' => $wakil,
        ]);
    }
}
