<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function show($id)
    {
        $produk = Produk::with([
            'kategori',
            'motif' => function ($query) {
                $query->orderBy('motif_id')->limit(5);
            },
        ])->findOrFail($id);

        $produkLainnya = Produk::with('motif')
            ->where('produk_id', '!=', $id)
            ->where('status', 'aktif')
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('user.detail', compact('produk', 'produkLainnya'));
    }
}
