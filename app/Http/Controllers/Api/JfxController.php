<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jfx;
use Illuminate\Http\Request;

class JfxController extends Controller
{
    // GET /api/jfx
    public function index()
    {
        $jfxes = Jfx::latest()->get();

        return response()->json($jfxes, 200);
    }

    // GET /api/jfx/{slug}
    public function show($slug)
    {
        $jfx = Jfx::where('slug', $slug)->first();

        if (!$jfx) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($jfx, 200);
    }
}
