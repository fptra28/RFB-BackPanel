<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriWakilPialangController extends Controller
{
    public function index()
    {
        $categoriWakilPialang = \App\Models\KategoriWakilPialang::all();

        return response()->json($categoriWakilPialang);
    }
}
