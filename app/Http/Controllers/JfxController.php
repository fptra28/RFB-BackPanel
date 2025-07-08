<?php

namespace App\Http\Controllers;

use App\Models\Jfx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JfxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ProdukJFX = Jfx::all();
        $countProduk = Jfx::count();

        return view('jfx.index', compact('ProdukJFX', 'countProduk'));
    }

    public function show($id)
    {
        $produk = Jfx::find($id);

        if (!$produk) {
            return redirect()->route('jfx.index')->with('error', 'Data tidak ditemukan');
        }

        return view('jfx.show', compact('produk'));
    }

    public function create()
    {
        return view('jfx.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'specs' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imageName = now()->format('dmY') . '-' . $originalName;
            $targetPath = 'img/produk/jfx';
            $image->move(public_path($targetPath), $imageName);

            // Simpan path relatif
            $imagePath = 'jfx/' . $imageName;
        }

        Jfx::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'specs' => $request->specs,
            'image' => $imagePath,  // path: jfx/namafile.jpg
        ]);

        return redirect()->route('jfx.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $produk = Jfx::findOrFail($id);
        return view('jfx.edit', compact('produk'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'specs' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = Jfx::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($produk->image && File::exists(public_path('img/produk/' . $produk->image))) {
                File::delete(public_path('img/produk/' . $produk->image));
            }

            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imageName = now()->format('dmY') . '-' . $originalName;
            $targetPath = 'img/produk/jfx';
            $image->move(public_path($targetPath), $imageName);

            $imagePath = 'jfx/' . $imageName;
        } else {
            $imagePath = $produk->image;
        }

        $produk->update([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'specs' => $request->specs,
            'image' => $imagePath,
        ]);

        return redirect()->route('jfx.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = Jfx::findOrFail($id);

        if ($produk->image && File::exists(public_path('img/produk/' . $produk->image))) {
            File::delete(public_path('img/produk/' . $produk->image));
        }

        $produk->delete();

        return redirect()->route('jfx.index')->with('success', 'Produk berhasil dihapus!');
    }
}
