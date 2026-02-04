<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class KarierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $kariers = Cache::remember('api:karier:index', 300, function () {
                return Karier::orderBy('order', 'desc')
                    ->latest()
                    ->get();
            });
                
            return response()->json([
                'success' => true,
                'message' => 'Daftar data karier berhasil diambil',
                'data' => $kariers
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data karier',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kota' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $karier = Karier::create($request->all());
            Cache::forget('api:karier:index');
            return response()->json([
                'success' => true,
                'message' => 'Data karier berhasil ditambahkan',
                'data' => $karier
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data karier',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $karier = Cache::remember('api:karier:' . $id, 300, function () use ($id) {
                return Karier::findOrFail($id);
            });
            return response()->json([
                'success' => true,
                'message' => 'Detail data karier berhasil diambil',
                'data' => $karier
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data karier tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource by slug.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function showBySlug($slug)
    {
        try {
            $karier = Cache::remember('api:karier:slug:' . $slug, 300, function () use ($slug) {
                return Karier::where('slug', $slug)->firstOrFail();
            });
            return response()->json([
                'success' => true,
                'message' => 'Detail data karier berhasil diambil',
                'data' => $karier
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data karier tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kota' => 'sometimes|required|string|max:255',
            'posisi' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $karier = Karier::findOrFail($id);
            $oldSlug = $karier->slug;
            $karier->update($request->all());

            Cache::forget('api:karier:index');
            Cache::forget('api:karier:' . $karier->id);
            if (!empty($oldSlug)) {
                Cache::forget('api:karier:slug:' . $oldSlug);
            }
            if (!empty($karier->slug)) {
                Cache::forget('api:karier:slug:' . $karier->slug);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Data karier berhasil diperbarui',
                'data' => $karier
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data karier',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $karier = Karier::findOrFail($id);
            Cache::forget('api:karier:' . $karier->id);
            if (!empty($karier->slug)) {
                Cache::forget('api:karier:slug:' . $karier->slug);
            }
            $karier->delete();
            
            Cache::forget('api:karier:index');
            return response()->json([
                'success' => true,
                'message' => 'Data karier berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data karier',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
