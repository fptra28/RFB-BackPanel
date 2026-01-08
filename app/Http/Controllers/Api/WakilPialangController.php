<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WakilPialang;

class WakilPialangController extends Controller
{
    public function index()
    {
        $wakilpialang = WakilPialang::orderBy('order')
            ->orderBy('created_at', 'desc')
            ->with(['kategoriWakilPialang:id,slug,nama_kategori']) // ambil hanya field yang dibutuhkan
            ->get();

        return response()->json($wakilpialang, 200);
    }
}
