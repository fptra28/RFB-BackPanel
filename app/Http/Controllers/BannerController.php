<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['apiIndex', 'apiActive']);
    }

    public function create()
    {
        $totalBanners = Banner::count();
        $defaultOrder = $totalBanners + 1;
        return view('banner.create', compact('totalBanners', 'defaultOrder'));
    }

    /**
     * Store a newly created resource in storage.
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
            // Validasi urutan
            $totalBanners = Banner::count();
            $requestedOrder = $validated['order'] ?? ($totalBanners + 1);
            
            if ($requestedOrder < 1 || $requestedOrder > ($totalBanners + 1)) {
                return redirect()->back()
                    ->with('error', 'Urutan tidak valid. Harus antara 1 dan ' . ($totalBanners + 1))
                    ->withInput();
            }

            // Upload gambar
            $imagePath = $request->file('image')->store('banners', 'public');
            
            // Geser urutan banner yang ada jika diperlukan
            Banner::where('order', '>=', $requestedOrder)
                ->increment('order');
            
            // Simpan data banner
            Banner::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'image' => $imagePath,
                'order' => $requestedOrder,
                'is_active' => $validated['is_active']
            ]);

            return redirect()->route('banner.index')
                ->with('success', 'Banner berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menambahkan banner: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('banner.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        $totalBanners = Banner::count();
        return view('banner.edit', compact('banner', 'totalBanners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'order' => 'nullable|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        try {
            // Validasi urutan
            $totalBanners = Banner::count();
            $requestedOrder = $validated['order'] ?? $banner->order;
            
            if ($requestedOrder < 1 || $requestedOrder > $totalBanners) {
                return redirect()->back()
                    ->with('error', 'Urutan tidak valid. Harus antara 1 dan ' . $totalBanners)
                    ->withInput();
            }

            $data = [
                'title' => $validated['title'],
                'description' => $validated['description'],
                'order' => $validated['order'] ?? 0,
                'is_active' => $validated['is_active']
            ];

            // Simpan urutan lama untuk perbandingan
            $oldOrder = $banner->order;
            $newOrder = $validated['order'] ?? $oldOrder;

            // Jika ada file gambar baru diupload
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($banner->image) {
                    Storage::disk('public')->delete($banner->image);
                }
                $data['image'] = $request->file('image')->store('banners', 'public');
            }

            // Update urutan jika berubah
            if ($oldOrder != $newOrder) {
                // Jika urutan baru lebih kecil dari urutan lama
                if ($newOrder < $oldOrder) {
                    Banner::where('order', '>=', $newOrder)
                        ->where('order', '<', $oldOrder)
                        ->increment('order');
                } 
                // Jika urutan baru lebih besar dari urutan lama
                else if ($newOrder > $oldOrder) {
                    Banner::where('order', '>', $oldOrder)
                        ->where('order', '<=', $newOrder)
                        ->decrement('order');
                }
                
                $data['order'] = $newOrder;
            }

            $banner->update($data);

            return redirect()->route('banner.index')
                ->with('success', 'Banner berhasil diperbarui');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui banner: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Mulai database transaction
        \DB::beginTransaction();
        
        try {
            $banner = Banner::findOrFail($id);
            $deletedOrder = $banner->order;
            
            // Hapus file gambar jika ada
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            
            // Hapus banner
            $banner->delete();
            
            // Dapatkan semua banner dengan urutan lebih besar dari yang dihapus
            $bannersToUpdate = Banner::where('order', '>', $deletedOrder)
                ->orderBy('order', 'asc')
                ->get();
            
            // Update urutan satu per satu untuk menghindari konflik
            foreach ($bannersToUpdate as $bannerToUpdate) {
                $bannerToUpdate->decrement('order');
            }
            
            // Commit transaction jika semua berhasil
            \DB::commit();
            
            return redirect()->route('banner.index')
                ->with('success', 'Banner berhasil dihapus dan urutan telah disesuaikan');
                
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            \DB::rollBack();
            \Log::error('Error saat menghapus banner: ' . $e->getMessage());
            
            return redirect()->route('banner.index')
                ->with('error', 'Gagal menghapus banner: ' . $e->getMessage());
        }
    }
}
