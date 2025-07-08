<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jfx extends Model
{
    use HasFactory;

    protected $table = 'jfxes';

    protected $fillable = [
        'name',
        'deskripsi',
        'specs',
        'image',
        'slug',
    ];

    // Buat slug otomatis saat membuat atau mengupdate
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($jfx) {
            $jfx->slug = Str::slug($jfx->name);
        });

        static::updating(function ($jfx) {
            $jfx->slug = Str::slug($jfx->name);
        });
    }
}
