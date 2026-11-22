<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'tb_keranjang';
    protected $primaryKey = 'keranjang_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'motif_id',
        'jumlah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function motif()
    {
        return $this->belongsTo(Motif::class, 'motif_id', 'motif_id');
    }
}
