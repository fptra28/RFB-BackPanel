<?php

namespace App\Http\Controllers;

use App\Models\Karier;
use Illuminate\Http\Request;

class KarierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kariers = Karier::orderBy('order', 'desc')->paginate(10);
        return view('karier.index', compact('kariers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_kota' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
        ]);

        // Generate slug dan cek duplikasi
        $slug = \Illuminate\Support\Str::slug($validatedData['nama_kota'] . ' ' . $validatedData['posisi']);
        
        if (Karier::where('slug', $slug)->exists()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['slug' => 'Data karier untuk kota "' . $validatedData['nama_kota'] . '" dengan posisi "' . $validatedData['posisi'] . '" sudah ada.']);
        }

        $validatedData['slug'] = $slug;
        Karier::create($validatedData);

        return redirect()->route('karier.index')
            ->with('success', 'Data karier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karier $karier)
    {
        return view('karier.show', compact('karier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karier $karier)
    {
        return view('karier.edit', compact('karier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karier $karier)
    {
        $validatedData = $request->validate([
            'nama_kota' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
        ]);

        // Generate slug dan cek duplikasi jika ada perubahan nama_kota atau posisi
        $slug = \Illuminate\Support\Str::slug($validatedData['nama_kota'] . ' ' . $validatedData['posisi']);
        
        // Cek apakah slug berubah dan sudah ada di record lain
        if ($karier->slug !== $slug && Karier::where('slug', $slug)->where('id', '!=', $karier->id)->exists()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['slug' => 'Data karier untuk kota "' . $validatedData['nama_kota'] . '" dengan posisi "' . $validatedData['posisi'] . '" sudah ada.']);
        }

        $validatedData['slug'] = $slug;
        $karier->update($validatedData);

        return redirect()->route('karier.index')
            ->with('success', 'Data karier berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karier $karier)
    {
        $order = $karier->order;
        $karier->delete();

        // Update order untuk karier yang memiliki order lebih besar dari yang dihapus
        Karier::where('order', '>', $order)->decrement('order');

        return redirect()->route('karier.index')
            ->with('success', 'Data karier berhasil dihapus! Urutan telah diperbarui.');
    }

    /**
     * Update the order of karier
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:kariers,id'
        ]);

        // Update order berdasarkan urutan ID yang diterima
        // Urutan pertama (indeks 0) akan menjadi yang teratas (order terbesar)
        $totalItems = count($request->order);
        
        foreach ($request->order as $index => $id) {
            // Hitung order dari yang terbesar (totalItems) ke terkecil (1)
            $order = $totalItems - $index;
            Karier::where('id', $id)->update(['order' => $order]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan berhasil diperbarui'
        ]);
    }
}
