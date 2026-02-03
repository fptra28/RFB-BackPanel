<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('order', 'asc')->get();
        
        return response()->json($banners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        try {
            // Upload gambar
            $imagePath = $request->file('image')->store('banners', 'public');
            
            // Buat banner baru
            $banner = Banner::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $imagePath,
                'order' => $validated['order'] ?? 0,
                'is_active' => $validated['is_active']
            ]);

        return response()->json([
            'success' => true,
            'data' => $banner,
            'message' => 'Banner berhasil ditambahkan'
        ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan banner: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $banner,
            'message' => 'Detail banner berhasil diambil'
        ]);
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
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:5120',
            'order' => 'sometimes|integer|min:1',
            'is_active' => 'sometimes|boolean',
        ]);

        try {
            // Jika ada file gambar baru, upload dan hapus yang lama
            if ($request->hasFile('image')) {
                // Hapus gambar lama
                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }
                
                // Upload gambar baru
                $validated['image'] = $request->file('image')->store('banners', 'public');
            }

            $banner->update($validated);

            return response()->json([
                'success' => true,
                'data' => $banner,
                'message' => 'Banner berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui banner: ' . $e->getMessage()
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
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan'
            ], 404);
        }

        try {
            // Hapus gambar dari storage
            if ($banner->image) {
                Storage::disk('public')->delete($banner->image);
            }

            $banner->delete();

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus banner: ' . $e->getMessage()
            ], 500);
        }
    }

}
