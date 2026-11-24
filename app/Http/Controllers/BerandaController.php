<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::all();

        $produkTerbaru = Produk::with(['motif' => function ($query) {
            $query->orderBy('motif_id')->limit(2);
        }])
            ->where('status', 'aktif')
            ->latest('produk_id')
            ->take(4)
            ->get();

        $produkTerlaris = Produk::with(['motif' => function ($query) {
            $query->orderBy('motif_id')->limit(2);
        }])
            ->where('status', 'aktif')
            ->withCount('motif')
            ->orderBy('motif_count', 'desc')
            ->latest('produk_id')
            ->take(4)
            ->get();

        $produk = $produkTerbaru;

        $blog = Blog::where('status_blog', true)
            ->latest('blog_id')
            ->take(3)
            ->get();

        return view('user.beranda', compact('kategori', 'produk', 'produkTerbaru', 'produkTerlaris', 'blog'));
    }
}
