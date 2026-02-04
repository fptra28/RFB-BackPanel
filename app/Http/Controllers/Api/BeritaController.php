<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $berita = Cache::remember('api:berita:index', 300, function () {
            return Berita::where('status', 'published')
                ->orderBy('order', 'desc')
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->image_url = $this->imageUrl($item->image);
                    // Backward compatibility: ensure image is a full URL for clients still using `image`
                    $item->image = $item->image_url;
                    return $item;
                });
        });

        return response()->json($berita, 200);
    }

    // Menampilkan detail berita berdasarkan slug
    public function show($slug)
    {
        $cacheKey = 'api:berita:slug:' . $slug;
        $berita = Cache::remember($cacheKey, 300, function () use ($slug) {
            return Berita::where('slug', $slug)->where('status', 'published')->first();
        });

        if (!$berita) {
            return response()->json(['message' => 'Berita tidak ditemukan'], 404);
        }

        $berita->image_url = $this->imageUrl($berita->image);
        // Backward compatibility: ensure image is a full URL for clients still using `image`
        $berita->image = $berita->image_url;
        return response()->json($berita, 200);
    }
}
