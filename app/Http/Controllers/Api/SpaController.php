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
        return response()->json($spa, 200);
    }
}
