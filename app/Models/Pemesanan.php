<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'tb_pemesanan';
    protected $primaryKey = 'pemesanan_id';

    protected $fillable = [
        'user_id',
        'alamat_id',
        'total_harga',
        'kurir',
        'layanan_kurir',
        'ongkir',
        'estimasi_tiba',
        'metode_bayar',
        'status_bayar',
        'status_pesanan',
        'tanggal_pesan',
        'waktu_bayar',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pesan' => 'datetime',
            'waktu_bayar' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'alamat_id', 'alamat_id');
    }

    public function pemesananDetail()
    {
        return $this->hasMany(PemesananDetail::class, 'pemesanan_id', 'pemesanan_id');
    }

    public function details()
    {
        return $this->hasMany(PemesananDetail::class, 'pemesanan_id', 'pemesanan_id');
    }
}
