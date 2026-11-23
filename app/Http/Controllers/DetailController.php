<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        $produk = Produk::with(['kategori', 'motif'])->findOrFail($id);

        // Section "Check Produk Lainnya" - maksimal 4 produk acak
        $produkLainnya = Produk::with('motif')
            ->where('produk_id', '!=', $id)
            ->where('status', 'aktif')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('detail', compact('produk', 'produkLainnya'));
    }
}
