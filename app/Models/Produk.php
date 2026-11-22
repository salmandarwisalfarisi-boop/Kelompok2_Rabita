<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';
    protected $primaryKey = 'produk_id';
    public $timestamps = false;

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'slug',
        'deskripsi_produk',
        'harga',
        'berat_gram',
        'ukuran',
        'material',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function motif()
    {
        return $this->hasMany(Motif::class, 'produk_id', 'produk_id');
    }

    // Accessor: Gambar produk utama dari motif pertama
    public function getGambarProdukAttribute()
    {
        return $this->motif->first()?->gambar_depan;
    }

    // Accessor: Total stok dari semua motif
    public function getStokAttribute()
    {
        return $this->motif->sum('stok');
    }

    // Accessor: Total motif yang dimiliki
    public function getTotalMotifAttribute()
    {
        return $this->motif->count();
    }
}
