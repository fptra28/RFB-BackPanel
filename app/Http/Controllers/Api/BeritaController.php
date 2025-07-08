<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    // Menampilkan semua berita yang berstatus published
    public function index()
    {
        $berita = Berita::where('status', 'published')->latest()->get();

        return response()->json($berita, 200);
    }

    // Menampilkan detail berita berdasarkan slug
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->where('status', 'published')->first();

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        return response()->json($berita, 200);
    }
}
