<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'tb_alamat';
    protected $primaryKey = 'alamat_id';

    protected $fillable = [
        'user_id',
        'label_alamat',
        'nama_penerima',
        'no_hp_penerima',
        'alamat_lengkap',
        'catatan_kurir',
        'area_wilayah',
        'latitude',
        'longitude',
        'alamat_utama',
    ];

    protected function casts(): array
    {
        return [
            'alamat_utama' => 'boolean',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'alamat_id', 'alamat_id');
    }
}
