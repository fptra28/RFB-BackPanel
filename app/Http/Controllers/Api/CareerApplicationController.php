<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CareerApplicationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'experience' => 'required|string',
            'noticePeriod' => 'required|string',
            'position' => 'required|string',
            'vacancySource' => 'nullable|string',
            'motivation' => 'required|string',
            'cv' => 'required|file|mimes:pdf|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Simpan file CV
            $cvPath = $request->file('cv')->store('cv_applications', 'public');
            
            // Data untuk email
            $data = $request->all();
            $data['cv_path'] = $cvPath;
            
            // Kirim email
            Mail::to('rancagp19@gmail.com')
                ->send(new CareerApplication($data));
                
            return response()->json([
                'message' => 'Lamaran berhasil dikirim',
                'data' => [
                    'name' => $data['name'],
                    'position' => $data['position']
                ]
            ], 200);
            
        } catch (\Exception $e) {
            \Log::error('Error sending application: ' . $e->getMessage());
            return response()->json([
                'error' => 'Terjadi kesalahan saat mengirim lamaran',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}