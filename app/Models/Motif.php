<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motif extends Model
{
    use HasFactory;

    protected $table = 'tb_motif';
    protected $primaryKey = 'motif_id';
    public $timestamps = false;

    protected $fillable = [
        'produk_id',
        'nama_motif',
        'stok',
        'gambar_depan',
        'gambar_kanan',
        'gambar_kiri',
        'gambar_dalam',
        'status_motif',
    ];

    protected $casts = [
        'status_motif' => 'boolean',
        'stok' => 'integer',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'motif_id', 'motif_id');
    }

    public function pemesananDetail()
    {
        return $this->hasMany(PemesananDetail::class, 'motif_id', 'motif_id');
    }
}
