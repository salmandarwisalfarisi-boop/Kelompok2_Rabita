<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk       = Produk::with('kategori')->latest()->get();
        $kategoriList = Kategori::orderBy('nama_kategori')->get();
        return view('produk.index', compact('produk', 'kategoriList'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'      => 'required|exists:tb_kategori,kategori_id',
            'nama_produk'      => 'required|string|max:100',
            'gambar_produk'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kanan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kiri'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_dalam'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi_produk' => 'required|string',
            'harga'            => 'required|integer|min:0',
            'stok'             => 'required|integer|min:0',
            'berat_gram'       => 'required|integer|min:0',
            'status'           => 'required|in:aktif,sold_out,arsip',
        ], [
            'kategori_id.required'      => 'Kategori wajib dipilih.',
            'nama_produk.required'      => 'Nama produk wajib diisi.',
            'deskripsi_produk.required' => 'Deskripsi produk wajib diisi.',
            'harga.required'            => 'Harga wajib diisi.',
            'stok.required'             => 'Stok wajib diisi.',
            'berat_gram.required'       => 'Berat wajib diisi.',
            'gambar_produk.image'       => 'File harus berupa gambar.',
            'gambar_produk.max'         => 'Ukuran gambar maksimal 2MB.',
            'gambar_kanan.image'        => 'File harus berupa gambar.',
            'gambar_kiri.image'         => 'File harus berupa gambar.',
            'gambar_dalam.image'        => 'File harus berupa gambar.',
        ]);

        $data = $request->except(['gambar_produk', 'gambar_kanan', 'gambar_kiri', 'gambar_dalam']);
        $destinationPath = public_path('assets/image/produk');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        foreach (['gambar_produk', 'gambar_kanan', 'gambar_kiri', 'gambar_dalam'] as $field) {
            if ($request->hasFile($field)) {
                $file     = $request->file($field);
                $ext      = $file->getClientOriginalExtension();
                $filename = time() . '_' . $field . '_' . uniqid() . '.' . $ext;
                $file->move($destinationPath, $filename);
                $data[$field] = $filename;
            } else {
                $data[$field] = null;
            }
        }

        Produk::create($data);

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        $kategori = Kategori::all();
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'kategori_id'      => 'required|exists:tb_kategori,kategori_id',
            'nama_produk'      => 'required|string|max:100',
            'gambar_produk'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kanan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kiri'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_dalam'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi_produk' => 'required|string',
            'harga'            => 'required|integer|min:0',
            'stok'             => 'required|integer|min:0',
            'berat_gram'       => 'required|integer|min:0',
            'status'           => 'required|in:aktif,sold_out,arsip',
        ], [
            'kategori_id.required'      => 'Kategori wajib dipilih.',
            'nama_produk.required'      => 'Nama produk wajib diisi.',
            'deskripsi_produk.required' => 'Deskripsi produk wajib diisi.',
            'harga.required'            => 'Harga wajib diisi.',
            'stok.required'             => 'Stok wajib diisi.',
            'berat_gram.required'       => 'Berat wajib diisi.',
            'gambar_produk.image'       => 'File harus berupa gambar.',
            'gambar_kanan.image'        => 'File harus berupa gambar.',
            'gambar_kiri.image'         => 'File harus berupa gambar.',
            'gambar_dalam.image'        => 'File harus berupa gambar.',
        ]);

        $data = $request->except(['gambar_produk', 'gambar_kanan', 'gambar_kiri', 'gambar_dalam']);
        $destinationPath = public_path('assets/image/produk');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        foreach (['gambar_produk', 'gambar_kanan', 'gambar_kiri', 'gambar_dalam'] as $field) {
            if ($request->hasFile($field)) {
                // Hapus file lama jika ada
                if ($produk->$field) {
                    $oldPath = $destinationPath . '/' . $produk->$field;
                    if (file_exists($oldPath) && is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $file     = $request->file($field);
                $ext      = $file->getClientOriginalExtension();
                $filename = time() . '_' . $field . '_' . uniqid() . '.' . $ext;
                $file->move($destinationPath, $filename);
                $data[$field] = $filename;
            }
        }

        $produk->update($data);

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        foreach (['gambar_produk', 'gambar_kanan', 'gambar_kiri', 'gambar_dalam'] as $field) {
            $path = public_path('assets/image/produk/' . $produk->$field);
            if ($produk->$field && file_exists($path)) {
                unlink($path);
            }
        }

        $produk->delete();

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}
