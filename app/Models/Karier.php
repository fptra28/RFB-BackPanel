<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Karier extends Model
{
    protected $fillable = [
        'nama_kota',
        'posisi',
        'slug',
        'responsibilities',
        'qualifications',
        'email',
        'order',
    ];
    
    protected $casts = [
        'responsibilities' => 'string',
        'qualifications' => 'string',
    ];
    
    protected $attributes = [
        'order' => 0,
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($karier) {
            $karier->slug = Str::slug($karier->posisi . ' ' . $karier->nama_kota);
            // Set order to max order + 1
            $maxOrder = static::max('order') ?? 0;
            $karier->order = $maxOrder + 1;
        });
    }
}
