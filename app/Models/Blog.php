<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'tb_blog';
    protected $primaryKey = 'blog_id';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'thumbnail',
        'status_blog',
    ];

    protected $casts = [
        'status_blog' => 'boolean',
    ];
}
