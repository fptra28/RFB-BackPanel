<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WakilPialang;
use Illuminate\Support\Facades\Cache;

class WakilPialangController extends Controller
{
    public function index()
    {
        $wakilpialang = Cache::remember('api:wakil-pialang:index', 300, function () {
            return WakilPialang::query()
                ->orderByDesc('order')
                ->orderBy('nama', 'asc')
                ->with(['kategoriWakilPialang:id,slug,nama_kategori']) // ambil hanya field yang dibutuhkan
                ->get();
        });

        return response()->json($wakilpialang, 200);
    }
}
