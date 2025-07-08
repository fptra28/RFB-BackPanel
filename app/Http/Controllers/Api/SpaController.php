<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use Illuminate\Http\Request;

class SpaController extends Controller
{
    // GET /api/spa
    public function index()
    {
        $spas = Spa::latest()->get();

        return response()->json($spas, 200);
    }

    // GET /api/spa/{slug}
    public function show($slug)
    {
        $spa = Spa::where('slug', $slug)->first();

        if (!$spa) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($spa, 200);
    }
}
