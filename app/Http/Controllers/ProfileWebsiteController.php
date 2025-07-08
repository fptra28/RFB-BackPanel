<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileWebsiteController extends Controller
{
    public function index()
    {
        $profile = Profile::first(); // hanya satu data yang diambil
        return view('profile-website.index', compact('profile'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $profile = Profile::first();

        if ($profile) {
            $profile->update(['content' => $request->content]);
            $message = 'Profil berhasil diperbarui.';
        } else {
            Profile::create(['content' => $request->content]);
            $message = 'Profil berhasil ditambahkan.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->back()->with('success', 'Konten profil berhasil dihapus.');
    }
}
