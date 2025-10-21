<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karier extends Model
{
    protected $fillable = [
        'nama_kota',
        'posisi',
        'slug',
        'responsibilities',
        'qualifications',
    ];
    
    protected $casts = [
        'responsibilities' => 'string',
        'qualifications' => 'string',
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($karier) {
            $karier->slug = \Illuminate\Support\Str::slug($karier->nama_kota . ' ' . $karier->posisi);
        });
        
        static::updating(function ($karier) {
            if ($karier->isDirty(['nama_kota', 'posisi'])) {
                $karier->slug = \Illuminate\Support\Str::slug($karier->nama_kota . ' ' . $karier->posisi);
            }
        });
    }
}
