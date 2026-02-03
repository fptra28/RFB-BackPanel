<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use Illuminate\Http\Request;

class SpaController extends Controller
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

    // GET /api/spa
    public function index()
    {
        $spas = Spa::orderBy('order', 'desc')
            ->latest()
            ->get();

        $spas = $spas->map(function ($item) {
            $item->image_url = $this->imageUrl($item->image);
            // Backward compatibility: ensure image is a full URL for clients still using `image`
            $item->image = $item->image_url;
            return $item;
        });

        return response()->json($spas, 200);
    }

    // GET /api/spa/{slug}
    public function show($slug)
    {
        $spa = Spa::where('slug', $slug)->first();

        if (!$spa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $spa->image_url = $this->imageUrl($spa->image);
        // Backward compatibility: ensure image is a full URL for clients still using `image`
        $spa->image = $spa->image_url;
        return response()->json($spa, 200);
    }
}
