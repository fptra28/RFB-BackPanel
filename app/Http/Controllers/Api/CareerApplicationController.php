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
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'experience' => 'required|string',
            'noticePeriod' => 'required|string',
            'position' => 'required|string|max:255',
            'vacancySource' => 'nullable|string',
            'motivation' => 'required|string',
            'karier_id' => 'required|exists:kariers,id',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Dapatkan data karier berdasarkan ID
            $karier = \App\Models\Karier::findOrFail($request->karier_id);
            
            // Simpan file CV
            $cvPath = $request->file('cv')->store('cv_applications', 'public');
            
            // Data untuk email
            $data = $request->all();
            $data['cv_path'] = $cvPath;
            $data['kota'] = $karier->nama_kota;
            $data['posisi'] = $karier->posisi;
            
            // Pastikan email karier tersedia
            if (!$karier->email) {
                return response()->json([
                    'error' => 'Email untuk karier ini belum diatur',
                    'karier_id' => $karier->id,
                    'karier' => $karier->nama_kota . ' - ' . $karier->posisi
                ], 400);
            }
            
            Mail::to($karier->email)
                ->send(new CareerApplication($data));
                
            return response()->json([
                'message' => 'Lamaran berhasil dikirim',
                'data' => [
                    'name' => $data['name'],
                    'position' => $data['posisi'],
                    'kota' => $data['kota'],
                    'email_tujuan' => $karier->email
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