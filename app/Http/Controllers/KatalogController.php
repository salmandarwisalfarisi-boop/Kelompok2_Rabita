<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = Kategori::all();
        $selectedKategori = null;

        $query = Produk::with(['kategori', 'motif'])
            ->where('status', 'aktif');

        // Filter Kategori jika ada
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
            $selectedKategori = Kategori::find($request->kategori);
        }

        // Pencarian jika ada
        if ($request->filled('q')) {
            $query->where('nama_produk', 'like', '%' . $request->q . '%');
        }

        // Pengurutan / Sort
        $sort = $request->get('sort', 'def');
        switch ($sort) {
            case 'asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'az':
                $query->orderBy('nama_produk', 'asc');
                break;
            default:
                $query->latest('produk_id');
                break;
        }

        $produk = $query->paginate(12)->withQueryString();
        $totalProduk = $produk->total();

        return view('produk', compact('produk', 'kategoriList', 'selectedKategori', 'totalProduk', 'sort'));
    }
}
