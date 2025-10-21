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
        $kariers = Karier::orderBy('created_at', 'asc')->paginate(10);
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
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
        ]);

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
            'responsibilities' => 'required|string',
            'qualifications' => 'required|string',
        ]);

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
}
