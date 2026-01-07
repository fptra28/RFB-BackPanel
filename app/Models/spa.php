<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Spa extends Model
{
    use HasFactory;

    protected $table = 'spas';

    protected $fillable = [
        'name',
        'deskripsi',
        'specs',
        'image',
        'slug',
        'order',
    ];
    
    protected $attributes = [
        'order' => 0,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($spa) {
            $spa->slug = Str::slug($spa->name);
            // Set order to max order + 1
            $maxOrder = static::max('order') ?? 0;
            $spa->order = $maxOrder + 1;
        });

        static::updating(function ($spa) {
            $spa->slug = Str::slug($spa->name);
        });
    }
}
