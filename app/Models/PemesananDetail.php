<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_pemesanan_detail';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;

    protected $fillable = [
        'pemesanan_id',
        'motif_id',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'pemesanan_id');
    }

    public function motif()
    {
        return $this->belongsTo(Motif::class, 'motif_id', 'motif_id');
    }

    // Helper: Mengakses produk langsung melalui motif
    public function getProdukAttribute()
    {
        return $this->motif?->produk;
    }
}
