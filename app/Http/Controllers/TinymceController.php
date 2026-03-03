<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TinymceController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'image', 'max:5120'],
        ]);

        $file = $request->file('file');
        $filename = (string) Str::uuid() . '.' . $file->getClientOriginalExtension();
        $directory = public_path('img/tinymce');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file->move($directory, $filename);

        $baseUrl = rtrim(config('app.url'), '/');

        return response()->json([
            'location' => $baseUrl . '/img/tinymce/' . $filename,
        ]);
    }
}
