<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SpaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produkSPA = Spa::all();
        $countProduk = $produkSPA->count();

        return view('spa.index', compact('produkSPA', 'countProduk'));
    }

    public function show($id)
    {
        $produk = Spa::find($id);

        if (!$produk) {
            return redirect()->route('spa.index')->with('error', 'Data tidak ditemukan');
        }

        return view('spa.show', compact('produk'));
    }

    public function create()
    {
        return view('spa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'specs' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imageName = now()->format('dmY_His') . '-' . uniqid() . '-' . $originalName;
            $targetPath = 'img/produk/spa';
            $image->move(public_path($targetPath), $imageName);

            // Simpan path ke database: hanya "spa/nama_file"
            $imagePath = 'spa/' . $imageName;
        }

        Spa::create([
            'name' => $validated['name'],
            'deskripsi' => $validated['deskripsi'],
            'specs' => $validated['specs'],
            'image' => $imagePath,
        ]);

        return redirect()->route('spa.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $produk = Spa::findOrFail($id);
        return view('spa.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'deskripsi' => 'required|string',
            'specs' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = Spa::findOrFail($id);
        $imagePath = $produk->image;

        if ($request->hasFile('image')) {
            if ($produk->image && File::exists(public_path('img/produk/' . $produk->image))) {
                File::delete(public_path('img/produk/' . $produk->image));
            }

            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $imageName = now()->format('dmY_His') . '-' . uniqid() . '-' . $originalName;
            $targetPath = 'img/produk/spa';
            $image->move(public_path($targetPath), $imageName);

            $imagePath = 'spa/' . $imageName;
        }

        $produk->update([
            'name' => $validated['name'],
            'deskripsi' => $validated['deskripsi'],
            'specs' => $validated['specs'],
            'image' => $imagePath,
        ]);

        return redirect()->route('spa.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $produk = Spa::findOrFail($id);

        if ($produk->image && File::exists(public_path('img/produk/' . $produk->image))) {
            File::delete(public_path('img/produk/' . $produk->image));
        }

        $produk->delete();

        return redirect()->route('spa.index')->with('success', 'Produk berhasil dihapus!');
    }
}
