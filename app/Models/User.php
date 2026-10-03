<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'no_hp',
        'level',
        'remmber_token',
        'reset_token',
        'reset_token_expired',
    ];

    protected $hidden = [
        'password',
        'remmber_token',
        'reset_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'reset_token_expired' => 'datetime',
        ];
    }

    public function getRememberTokenName()
    {
        return 'remmber_token';
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'user_id', 'user_id');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'user_id', 'user_id');
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'user_id', 'user_id');
    }
}
