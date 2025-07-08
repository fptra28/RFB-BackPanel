<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriWakilPialang extends Model
{
    use HasFactory;

    protected $table = 'kategori_wakil_pialang';

    protected $fillable = [
        'nama_kategori',
        'slug',
    ];

    public function wakilPialang()
    {
        return $this->hasMany(WakilPialang::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_kategori);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama_kategori')) {
                $model->slug = Str::slug($model->nama_kategori);
            }
        });
    }
}
