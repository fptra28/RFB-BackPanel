<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'image',
        'judul',
        'isi',
        'kategori',
        'status',
        'slug',
        'order',
    ];
    
    protected $attributes = [
        'order' => 0,
    ];

    protected $appends = [
        'image_url',
    ];

    // Buat slug otomatis saat membuat atau mengupdate
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
            // Set order to max order + 1
            $maxOrder = static::max('order') ?? 0;
            $berita->order = $maxOrder + 1;
        });

        static::updating(function ($berita) {
            $berita->slug = Str::slug($berita->judul);
        });
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        if (preg_match('#^https?://#', $this->image)) {
            return $this->image;
        }

        return asset('img/berita/' . $this->image);
    }
}
