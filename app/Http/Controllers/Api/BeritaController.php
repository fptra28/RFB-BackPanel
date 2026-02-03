<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    private function imageUrl($image)
    {
        if (!$image) {
            return null;
        }

        if (preg_match('#^https?://#', $image)) {
            return $image;
        }

        return asset('img/berita/' . $image);
    }

    // Menampilkan semua berita yang berstatus published
    public function index()
    {
        $berita = Berita::where('status', 'published')
            ->orderBy('order', 'desc')
            ->latest()
            ->get();

        $berita = $berita->map(function ($item) {
            $item->image_url = $this->imageUrl($item->image);
            return $item;
        });

        return response()->json($berita, 200);
    }

    // Menampilkan detail berita berdasarkan slug
    public function show($slug)
    {
        $berita = Berita::where('slug', $slug)->where('status', 'published')->first();

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $berita->image_url = $this->imageUrl($berita->image);
        return response()->json($berita, 200);
    }
}
