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
        'nama_penerima',
        'no_hp_penerima',
        'provinsi',
        'kota',
        'kecamatan',
        'alamat_lengkap',
        'kode_pos',
        'kurir',
        'layanan_kurir',
        'ongkir',
        'estimasi_tiba',
        'total_harga',
        'bukti_bayar',
        'waktu_bayar',
        'status_pesanan',
        'no_resi',
        'catatan',
    ];

    protected $casts = [
        'waktu_bayar' => 'datetime',
        'total_harga' => 'integer',
        'ongkir' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(PemesananDetail::class, 'pemesanan_id', 'pemesanan_id');
    }

    // Alias for compatibility
    public function pemesananDetail()
    {
        return $this->details();
    }
}
