<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Motif;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KeranjangController extends Controller
{
    /**
     * Tampilkan halaman keranjang belanja
     */
    public function index()
    {
        $items = [];
        $total = 0;

        if (Auth::check()) {
            $dbKeranjang = Keranjang::with(['motif.produk.kategori'])
                ->where('user_id', Auth::id())
                ->get();

            foreach ($dbKeranjang as $row) {
                if (!$row->motif || !$row->motif->produk) continue;
                $p = $row->motif->produk;
                $m = $row->motif;
                $subtotal = $p->harga * $row->jumlah;
                $items[] = [
                    'id'          => $row->keranjang_id,
                    'motif_id'    => $m->motif_id,
                    'produk_id'   => $p->produk_id,
                    'nama_produk' => $p->nama_produk,
                    'kategori'    => $p->kategori->nama_kategori ?? 'Sasirangan',
                    'nama_motif'  => $m->nama_motif,
                    'harga'       => $p->harga,
                    'qty'         => $row->jumlah,
                    'gambar'      => $m->gambar_depan ?? $p->gambar_produk,
                    'subtotal'    => $subtotal,
                    'selected'    => true,
                ];
                $total += $subtotal;
            }
        } else {
            $sessionCart = Session::get('cart', []);
            foreach ($sessionCart as $key => $row) {
                $motif = Motif::with('produk.kategori')->find($row['motif_id']);
                if (!$motif || !$motif->produk) continue;
                $p = $motif->produk;
                $subtotal = $p->harga * $row['qty'];
                $items[] = [
                    'id'          => $key,
                    'motif_id'    => $motif->motif_id,
                    'produk_id'   => $p->produk_id,
                    'nama_produk' => $p->nama_produk,
                    'kategori'    => $p->kategori->nama_kategori ?? 'Sasirangan',
                    'nama_motif'  => $motif->nama_motif,
                    'harga'       => $p->harga,
                    'qty'         => $row['qty'],
                    'gambar'      => $motif->gambar_depan ?? $p->gambar_produk,
                    'subtotal'    => $subtotal,
                    'selected'    => true,
                ];
                $total += $subtotal;
            }
        }

        return view('keranjang', compact('items', 'total'));
    }

    /**
     * Tambahkan produk & motif ke keranjang (dari tombol "Masukkan Keranjang")
     */
    public function add(Request $request, $id)
    {
        $produk = Produk::with('motif')->findOrFail($id);

        $request->validate([
            'motif_id' => 'nullable|exists:tb_motif,motif_id',
            'qty'      => 'nullable|integer|min:1',
        ]);

        $motifId = $request->input('motif_id');
        if (!$motifId) {
            $firstMotif = $produk->motif->first();
            $motifId = $firstMotif ? $firstMotif->motif_id : null;
        }

        if (!$motifId) {
            return back()->with('error', 'Produk belum memiliki motif yang tersedia.');
        }

        $qty = max(1, (int) $request->input('qty', 1));

        if (Auth::check()) {
            $existing = Keranjang::where('user_id', Auth::id())
                ->where('motif_id', $motifId)
                ->first();

            if ($existing) {
                $existing->jumlah += $qty;
                $existing->save();
            } else {
                Keranjang::create([
                    'user_id'  => Auth::id(),
                    'motif_id' => $motifId,
                    'jumlah'   => $qty,
                ]);
            }
        } else {
            $cart = Session::get('cart', []);
            $key = 'item_' . $motifId;
            if (isset($cart[$key])) {
                $cart[$key]['qty'] += $qty;
            } else {
                $cart[$key] = [
                    'motif_id'  => $motifId,
                    'produk_id' => $produk->produk_id,
                    'qty'       => $qty,
                ];
            }
            Session::put('cart', $cart);
        }

        return redirect()->route('keranjang')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    /**
     * Update jumlah produk di keranjang (via AJAX atau form)
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $action = $request->input('action'); // 'plus' atau 'minus'

        if (Auth::check()) {
            $item = Keranjang::where('user_id', Auth::id())->where('keranjang_id', $id)->first();
            if ($item) {
                if ($action === 'plus') {
                    $item->jumlah += 1;
                    $item->save();
                } elseif ($action === 'minus' && $item->jumlah > 1) {
                    $item->jumlah -= 1;
                    $item->save();
                }
            }
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$id])) {
                if ($action === 'plus') {
                    $cart[$id]['qty'] += 1;
                } elseif ($action === 'minus' && $cart[$id]['qty'] > 1) {
                    $cart[$id]['qty'] -= 1;
                }
                Session::put('cart', $cart);
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Hapus item dari keranjang
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            Keranjang::where('user_id', Auth::id())->where('keranjang_id', $id)->delete();
        } else {
            $cart = Session::get('cart', []);
            if (isset($cart[$id])) {
                unset($cart[$id]);
                Session::put('cart', $cart);
            }
        }

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('keranjang')->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
