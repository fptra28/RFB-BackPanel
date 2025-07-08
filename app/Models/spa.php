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
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($spa) {
            $spa->slug = Str::slug($spa->name);
        });

        static::updating(function ($spa) {
            $spa->slug = Str::slug($spa->name);
        });
    }
}
