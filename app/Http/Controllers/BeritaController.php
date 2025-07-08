<?php

namespace App\Http\Controllers;

use App\Models\berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BeritaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $kategori = $request->query('kategori');
        $status = $request->query('status');

        $query = Berita::query();

        if ($status === 'draft') {
            // Tampilkan hanya berita dengan status draft
            $query->where('status', 'draft');
        } elseif ($kategori) {
            // Jika kategori dipilih, dan status bukan draft, tampilkan berdasarkan kategori dan status published
            $query->where('kategori', $kategori)
                ->where('status', 'published');
        } else {
            // Default: tampilkan semua berita yang published
            $query->where('status', 'published');
        }

        $beritaFiltered = $query->latest()->get();
        $countBerita = $beritaFiltered->count();

        return view('berita.index', compact('beritaFiltered', 'countBerita'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        // Menambahkan validasi untuk kategori
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'kategori' => 'required|in:Info & Kegiatan,Pengumuman',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menambahkan kategori ke dalam data
        $data = $request->only(['judul', 'isi', 'kategori', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $tanggal = date('Y-m-d-H-i-s');
            $judulSlug = str_replace(' ', '-', strtolower($request->judul));
            $imageName = $tanggal . '-' . $judulSlug . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/berita'), $imageName);

            $data['image'] = $imageName;
        }

        berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        try {
            // Mencari berita berdasarkan ID atau akan gagal jika tidak ditemukan
            $berita = berita::findOrFail($id);

            // Mengembalikan view dengan data berita yang ditemukan
            return view('berita.show', compact('berita'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika berita tidak ditemukan, arahkan ke halaman berita.index dengan pesan error
            return redirect()->route('berita.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function edit(string $id)
    {
        try {
            // Mencari berita berdasarkan ID atau akan gagal jika tidak ditemukan
            $berita = berita::findOrFail($id);

            // Mengembalikan view dengan data berita yang ditemukan
            return view('berita.edit', compact('berita'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika berita tidak ditemukan, arahkan ke halaman berita.index dengan pesan error
            return redirect()->route('berita.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, string $id)
    {
        $berita = berita::findOrFail($id);

        // Menambahkan validasi untuk kategori
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'kategori' => 'required|in:Info & Kegiatan,Pengumuman',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menambahkan kategori ke dalam data
        $data = $request->only(['judul', 'isi', 'kategori', 'status']);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($berita->image && File::exists(public_path($berita->image))) {
                File::delete(public_path($berita->image));
            }

            $image = $request->file('image');
            $tanggal = date('Y-m-d-H-i-s');
            $judulSlug = str_replace(' ', '-', strtolower($request->judul));
            $imageName = $tanggal . '-' . $judulSlug . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('img/berita'), $imageName);

            $data['image'] = $imageName;
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $berita = berita::findOrFail($id);

        // Hapus gambar jika ada
        if ($berita->image && File::exists(public_path($berita->image))) {
            File::delete(public_path($berita->image));
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
