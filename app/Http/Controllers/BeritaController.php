<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
            $query->where('status', 'draft');
        } elseif ($kategori) {
            $query->where('kategori', $kategori)
                ->where('status', 'published');
        } else {
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
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'kategori' => 'required|in:Info & Kegiatan,Pengumuman',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'kategori', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // bikin nama file aman + unik
            $tanggal = now()->format('Y-m-d-H-i-s');
            $judulSlug = Str::slug($request->judul);
            $ext = strtolower($image->getClientOriginalExtension());

            $imageName = $tanggal . '-' . $judulSlug . '.' . $ext;

            // pastiin folder ada
            $dir = public_path('img/berita');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            // simpan ke public/img/berita
            $image->move($dir, $imageName);

            // simpan di DB hanya filename
            $data['image'] = $imageName;
        }

        Berita::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        try {
            $berita = Berita::findOrFail($id);
            return view('berita.show', compact('berita'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('berita.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function edit(string $id)
    {
        try {
            $berita = Berita::findOrFail($id);
            return view('berita.edit', compact('berita'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('berita.index')->with('error', 'Data tidak ditemukan');
        }
    }

    public function update(Request $request, string $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'kategori' => 'required|in:Info & Kegiatan,Pengumuman',
            'status' => 'required|in:draft,published',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'kategori', 'status']);

        if ($request->hasFile('image')) {
            // hapus gambar lama (karena DB simpen filename aja)
            if ($berita->image) {
                $oldPath = public_path('img/berita/' . $berita->image);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $image = $request->file('image');

            $tanggal = now()->format('Y-m-d-H-i-s');
            $judulSlug = Str::slug($request->judul);
            $ext = strtolower($image->getClientOriginalExtension());

            $imageName = $tanggal . '-' . $judulSlug . '.' . $ext;

            $dir = public_path('img/berita');
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $image->move($dir, $imageName);

            $data['image'] = $imageName;
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->image) {
            $path = public_path('img/berita/' . $berita->image);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
