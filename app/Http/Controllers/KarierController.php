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
        $kariers = Karier::orderBy('created_at', 'desc')->paginate(10);
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
        $karier->delete();

        return redirect()->route('karier.index')
            ->with('success', 'Data karier berhasil dihapus');
    }

    /**
     * Update the order of karier
     */
    public function updateOrder(Request $request)
    {
        try {
            \Log::info('Menerima permintaan update order:', $request->all());
            
            $request->validate([
                'order' => 'required|array',
                'order.*' => 'integer|exists:kariers,id'
            ]);

            \DB::beginTransaction();
            
            foreach ($request->order as $index => $id) {
                \Log::info("Mengupdate karier ID: $id dengan order: " . ($index + 1));
                Karier::where('id', $id)->update(['order' => $index + 1]);
            }
            
            \DB::commit();
            
            \Log::info('Update order selesai');
            return response()->json(['success' => true]);
            
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Gagal update order karier: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui urutan karier: ' . $e->getMessage()
            ], 500);
        }
    }
}
