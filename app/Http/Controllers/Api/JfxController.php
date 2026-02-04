<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jfx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JfxController extends Controller
{
    private function imageUrl($image)
    {
        if (!$image) {
            return null;
        }

        if (preg_match('#^https?://#', $image)) {
            return $image;
        }

        return asset('img/produk/' . $image);
    }

    // GET /api/jfx
    public function index()
    {
        $jfxes = Cache::remember('api:jfx:index', 300, function () {
            return Jfx::orderBy('order', 'desc')
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->image_url = $this->imageUrl($item->image);
                    // Backward compatibility: ensure image is a full URL for clients still using `image`
                    $item->image = $item->image_url;
                    return $item;
                });
        });

        return response()->json($jfxes, 200);
    }

    // GET /api/jfx/{slug}
    public function show($slug)
    {
        $cacheKey = 'api:jfx:slug:' . $slug;
        $jfx = Cache::remember($cacheKey, 300, function () use ($slug) {
            return Jfx::where('slug', $slug)->first();
        });

        if (!$jfx) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $jfx->image_url = $this->imageUrl($jfx->image);
        // Backward compatibility: ensure image is a full URL for clients still using `image`
        $jfx->image = $jfx->image_url;
        return response()->json($jfx, 200);
    }
}
