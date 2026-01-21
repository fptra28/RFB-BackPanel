<?php

namespace App\Http\Controllers;

use App\Models\KategoriWakilPialang;
use App\Models\WakilPialang;
use Illuminate\Http\Request;

class WakilPialangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Update the order of wakil pialang
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        if ($request->ajax()) {
            $order = $request->input('order');
            
            if (is_array($order)) {
                // Hitung total item
                $totalItems = count($order);
                
                // Update order dari yang terbesar ke terkecil
                foreach ($order as $position => $id) {
                    // Urutan teratas (indeks 0) akan dapat nilai order tertinggi
                    // Dimulai dari totalItems (terbesar) sampai 1 (terkecil)
                    $newOrder = $totalItems - $position;
                    WakilPialang::where('id', $id)->update(['order' => $newOrder]);
                }
                
                return response()->json(['success' => true]);
            }
        }
        
        return response()->json(['success' => false], 400);
    }

    public function index($slug)
    {
        try {
            // Mendapatkan kategori berdasarkan slug atau akan gagal jika tidak ditemukan
            $kategori = KategoriWakilPialang::where('slug', $slug)->firstOrFail();

            // Mengambil data Wakil Pialang berdasarkan kategori dan mengurutkan berdasarkan order (descending) dan nama
            $wakilPialang = WakilPialang::where('category_id', $kategori->id)
                ->orderBy('order', 'desc')
                ->orderBy('nama', 'asc')
                ->get();

            // Mengirimkan data ke view
            return view('wakil.index', compact('wakilPialang', 'kategori'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika kategori tidak ditemukan, arahkan ke halaman kategori dengan pesan error
            return redirect()->route('kategori-wakil.index')->with('error', 'Kategori tidak ditemukan');
        }
    }

    public function create($slug)
    {
        try {
            // Menemukan kategori berdasarkan slug
            $kategori = KategoriWakilPialang::where('slug', $slug)->firstOrFail();
            return view('wakil.create', compact('kategori'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika kategori tidak ditemukan, arahkan ke halaman kategori dengan pesan error
            return redirect()->route('kategori-wakil.index')->with('error', 'Kategori tidak ditemukan');
        }
    }

    public function store(Request $request, $slug)
    {
        try {
            // Menemukan kategori berdasarkan slug
            $kategori = KategoriWakilPialang::where('slug', $slug)->firstOrFail();

            // Validasi data yang diterima
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'nomor_izin' => 'required|string|max:100',
                'status' => 'required|in:aktif,non-aktif',
            ]);

            // Get the maximum order value for this category
            $maxOrder = WakilPialang::where('category_id', $kategori->id)->max('order');
            
            // Jika belum ada data, mulai dari 1, jika ada tambahkan 1
            $newOrder = $maxOrder !== null ? $maxOrder + 1 : 1;
            
            // Menyimpan data Wakil Pialang
            WakilPialang::create([
                'nama' => $validated['nama'],
                'nomor_izin' => $validated['nomor_izin'],
                'status' => $validated['status'],
                'category_id' => $kategori->id,
                'order' => $newOrder,
            ]);

            return redirect()->route('wakil.index', $slug)->with('success', 'Wakil Pialang berhasil ditambahkan.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika kategori tidak ditemukan, arahkan ke halaman kategori dengan pesan error
            return redirect()->route('kategori-wakil.index')->with('error', 'Kategori tidak ditemukan');
        }
    }

    public function edit($slug, $id)
    {
        try {
            // Menemukan kategori dan wakil pialang berdasarkan slug dan ID
            $kategori = KategoriWakilPialang::where('slug', $slug)->firstOrFail();
            $wakil = WakilPialang::findOrFail($id);

            return view('wakil.edit', compact('wakil', 'kategori'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika kategori atau wakil pialang tidak ditemukan, arahkan ke halaman kategori dengan pesan error
            return redirect()->route('wakil.index', $slug)->with('error', 'Data tidak ditemukan.');
        }
    }

    public function update(Request $request, $slug, $id)
    {
        try {
            // Menemukan kategori dan wakil pialang berdasarkan slug dan ID
            $kategori = KategoriWakilPialang::where('slug', $slug)->firstOrFail();
            $wakil = WakilPialang::findOrFail($id);

            // Validasi data yang diterima
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'nomor_izin' => 'required|string|max:100',
                'status' => 'required|in:aktif,non-aktif',
            ]);

            // Memperbarui data Wakil Pialang
            $wakil->update([
                'nama' => $validated['nama'],
                'nomor_izin' => $validated['nomor_izin'],
                'status' => $validated['status'],
            ]);

            return redirect()->route('wakil.index', $slug)->with('success', 'Wakil Pialang berhasil diperbarui.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika kategori atau wakil pialang tidak ditemukan, arahkan ke halaman kategori dengan pesan error
            return redirect()->route('wakil.index', $slug)->with('error', 'Data tidak ditemukan.');
        }
    }

    public function destroy($slug, $id)
    {
        try {
            // Mulai database transaction
            \DB::beginTransaction();

            // Temukan kategori untuk memastikan slug valid
            $kategori = KategoriWakilPialang::where('slug', $slug)->firstOrFail();
            
            // Dapatkan data yang akan dihapus beserta order-nya
            $wakil = WakilPialang::where('id', $id)
                ->where('category_id', $kategori->id)
                ->firstOrFail();
            
            $deletedOrder = $wakil->order;
            
            // Hapus data
            $wakil->delete();
            
            // Update order untuk data yang order-nya lebih besar dari yang dihapus
            WakilPialang::where('category_id', $kategori->id)
                ->where('order', '>', $deletedOrder)
                ->decrement('order');
            
            // Commit transaction
            \DB::commit();
            
            return redirect()
                ->route('wakil.index', ['slug' => $slug])
                ->with('success', 'Wakil Pialang berhasil dihapus dan urutan telah diperbarui.');
                
        } catch (\Exception $e) {
            // Rollback transaction jika terjadi error
            \DB::rollBack();
            \Log::error('Error saat menghapus wakil pialang: ' . $e->getMessage());
            
            return redirect()
                ->route('wakil.index', ['slug' => $slug])
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
