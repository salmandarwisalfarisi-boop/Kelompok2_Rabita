<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->query('q', '');
        $query = is_string($input) ? trim($input) : '';
        $produkQuery = Produk::with(['kategori', 'motif'])
            ->where('status', 'aktif');

        if ($query !== '') {
            $produkQuery->where(function ($builder) use ($query) {
                $term = '%' . $query . '%';

                $builder->where('nama_produk', 'like', $term)
                    ->orWhereHas('kategori', function ($kategoriQuery) use ($term) {
                        $kategoriQuery->where('nama_kategori', 'like', $term);
                    })
                    ->orWhereHas('motif', function ($motifQuery) use ($term) {
                        $motifQuery->where('nama_motif', 'like', $term);
                    });
            });
        } else {
            $produkQuery->whereRaw('1 = 0');
        }

        $produk = $produkQuery->latest('produk_id')->paginate(12)->withQueryString();

        return view('user.pencarian', compact('produk', 'query'));
    }
}
