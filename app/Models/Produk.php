<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';
    protected $primaryKey = 'produk_id';

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'gambar_produk',
        'deskripsi_produk',
        'harga',
        'stok',
        'berat_gram',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id', 'produk_id');
    }

    public function pemesananDetail()
    {
        return $this->hasMany(PemesananDetail::class, 'produk_id', 'produk_id');
    }
}
