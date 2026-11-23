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

        // 4 Produk Terbaru
        $produkTerbaru = Produk::with('motif')
            ->where('status', 'aktif')
            ->latest('produk_id')
            ->take(4)
            ->get();

        // 4 Produk Terlaris (atau urutan teratas berdasarkan motif terbanyak / ID)
        $produkTerlaris = Produk::with('motif')
            ->where('status', 'aktif')
            ->withCount('motif')
            ->orderBy('motif_count', 'desc')
            ->latest('produk_id')
            ->take(4)
            ->get();

        // Default list produk untuk beranda (terbaru)
        $produk = $produkTerbaru;

        // 3 Blog Terbaru
        $blog = Blog::where('status_blog', true)
            ->latest('blog_id')
            ->take(3)
            ->get();

        return view('beranda', compact('kategori', 'produk', 'produkTerbaru', 'produkTerlaris', 'blog'));
    }
}
