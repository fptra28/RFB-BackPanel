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
    }
}
