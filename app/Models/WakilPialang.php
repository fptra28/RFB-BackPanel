<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WakilPialang extends Model
{
    use HasFactory;

    protected $table = 'wakil_pialangs';

    protected $fillable = [
        'nama',
        'nomor_izin',
        'status',
        'category_id',
    ];

    /**
     * Relasi ke model KategoriWakilPialang
     */
    public function kategoriWakilPialang()
    {
        return $this->belongsTo(KategoriWakilPialang::class, 'category_id');
    }
}
