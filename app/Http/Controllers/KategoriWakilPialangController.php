<?php

namespace App\Http\Controllers;

use App\Models\KategoriWakilPialang;
use Illuminate\Http\Request;

class KategoriWakilPialangController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kategori = KategoriWakilPialang::withCount('wakilPialang')->get();
        return view('kategori-wakil.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori-wakil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:50',
        ]);

        KategoriWakilPialang::create($request->only('nama_kategori'));

        return redirect()->route('kategori-wakil.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            // Mencari kategori berdasarkan ID atau akan gagal jika tidak ditemukan
            $kategori = KategoriWakilPialang::findOrFail($id);

            // Mengembalikan view dengan kategori yang ditemukan
            return view('kategori-wakil.edit', compact('kategori'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika kategori tidak ditemukan, arahkan ke halaman kategori-wakil.index dengan pesan error
            return redirect()->route('kategori-wakil.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriWakilPialang::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:50',
        ]);

        $kategori->update($request->only('nama_kategori'));

        return redirect()->route('kategori-wakil.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = KategoriWakilPialang::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-wakil.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
