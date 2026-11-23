<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Motif;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'motif'])->withCount('motif')->latest('produk_id');

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $produk = $query->paginate(10)->withQueryString();
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
            'nama_produk'      => 'required|string|max:150',
            'kategori_id'      => 'required|exists:tb_kategori,kategori_id',
            'material'         => 'required|string|max:100',
            'harga'            => 'required|integer|min:0',
            'ukuran'           => 'required|string|max:50',
            'berat_gram'       => 'required|integer|min:0',
            'deskripsi_produk' => 'required|string',
            'nama_motif'       => 'required|string|max:100',
            'stok'             => 'required|integer|min:0',
            'status'           => 'required|in:aktif,sold_out,arsip',
            'gambar_depan'     => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kiri'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kanan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_dalam'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required'      => 'Nama produk wajib diisi.',
            'kategori_id.required'      => 'Kategori wajib dipilih.',
            'material.required'         => 'Material wajib diisi.',
            'harga.required'            => 'Harga wajib diisi.',
            'ukuran.required'           => 'Ukuran wajib diisi.',
            'berat_gram.required'       => 'Berat wajib diisi.',
            'deskripsi_produk.required' => 'Deskripsi produk wajib diisi.',
            'nama_motif.required'       => 'Nama motif wajib diisi.',
            'stok.required'             => 'Stok wajib diisi.',
            'gambar_depan.required'     => 'Foto depan motif wajib diupload.',
            'gambar_depan.image'        => 'File foto depan harus berupa gambar.',
        ]);

        // 1. Simpan Produk ke tb_produk
        $produk = Produk::create([
            'kategori_id'      => $request->kategori_id,
            'nama_produk'      => $request->nama_produk,
            'slug'             => Str::slug($request->nama_produk) . '-' . uniqid(),
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga'            => $request->harga,
            'berat_gram'       => $request->berat_gram,
            'ukuran'           => $request->ukuran,
            'material'         => $request->material,
            'status'           => $request->status,
        ]);

        // 2. Upload Foto Motif ke public/assets/image/produk
        $destinationPath = public_path('assets/image/produk');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fotoNames = [
            'gambar_depan' => null,
            'gambar_kiri'  => null,
            'gambar_kanan' => null,
            'gambar_dalam' => null,
        ];

        foreach (array_keys($fotoNames) as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . $field . '_' . uniqid() . '.' . $ext;
                $file->move($destinationPath, $filename);
                $fotoNames[$field] = $filename;
            }
        }

        // 3. Simpan Motif ke tb_motif
        Motif::create([
            'produk_id'    => $produk->produk_id,
            'nama_motif'   => $request->nama_motif,
            'stok'         => $request->stok,
            'gambar_depan' => $fotoNames['gambar_depan'],
            'gambar_kiri'  => $fotoNames['gambar_kiri'],
            'gambar_kanan' => $fotoNames['gambar_kanan'],
            'gambar_dalam' => $fotoNames['gambar_dalam'],
            'status_motif' => ($request->status === 'aktif'),
        ]);

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        $produk->load('motif');
        $kategori = Kategori::all();
        $motifPertama = $produk->motif->first();

        return view('produk.edit', compact('produk', 'kategori', 'motifPertama'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk'      => 'required|string|max:150',
            'kategori_id'      => 'required|exists:tb_kategori,kategori_id',
            'material'         => 'required|string|max:100',
            'harga'            => 'required|integer|min:0',
            'ukuran'           => 'required|string|max:50',
            'berat_gram'       => 'required|integer|min:0',
            'deskripsi_produk' => 'required|string',
            'nama_motif'       => 'required|string|max:100',
            'stok'             => 'required|integer|min:0',
            'status'           => 'required|in:aktif,sold_out,arsip',
            'gambar_depan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kiri'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_kanan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gambar_dalam'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required'      => 'Nama produk wajib diisi.',
            'kategori_id.required'      => 'Kategori wajib dipilih.',
            'material.required'         => 'Material wajib diisi.',
            'harga.required'            => 'Harga wajib diisi.',
            'ukuran.required'           => 'Ukuran wajib diisi.',
            'berat_gram.required'       => 'Berat wajib diisi.',
            'deskripsi_produk.required' => 'Deskripsi produk wajib diisi.',
            'nama_motif.required'       => 'Nama motif wajib diisi.',
            'stok.required'             => 'Stok wajib diisi.',
        ]);

        // 1. Update Produk di tb_produk
        $produk->update([
            'kategori_id'      => $request->kategori_id,
            'nama_produk'      => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga'            => $request->harga,
            'berat_gram'       => $request->berat_gram,
            'ukuran'           => $request->ukuran,
            'material'         => $request->material,
            'status'           => $request->status,
        ]);

        // 2. Ambil atau Buat Motif
        $motif = $produk->motif()->first();
        if (!$motif) {
            $motif = new Motif(['produk_id' => $produk->produk_id]);
        }

        $destinationPath = public_path('assets/image/produk');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $fotoFields = ['gambar_depan', 'gambar_kiri', 'gambar_kanan', 'gambar_dalam'];
        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                // Hapus foto lama jika ada
                if ($motif->$field) {
                    $oldPath = $destinationPath . '/' . $motif->$field;
                    if (file_exists($oldPath) && is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $file = $request->file($field);
                $ext = $file->getClientOriginalExtension();
                $filename = time() . '_' . $field . '_' . uniqid() . '.' . $ext;
                $file->move($destinationPath, $filename);
                $motif->$field = $filename;
            }
        }

        $motif->nama_motif = $request->nama_motif;
        $motif->stok = $request->stok;
        $motif->status_motif = ($request->status === 'aktif');
        $motif->save();

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        $destinationPath = public_path('assets/image/produk');

        // Hapus file foto dari semua motif produk ini
        foreach ($produk->motif as $motif) {
            foreach (['gambar_depan', 'gambar_kanan', 'gambar_kiri', 'gambar_dalam'] as $field) {
                if ($motif->$field) {
                    $filePath = $destinationPath . '/' . $motif->$field;
                    if (file_exists($filePath) && is_file($filePath)) {
                        @unlink($filePath);
                    }
                }
            }
            $motif->delete();
        }

        $produk->delete();

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil dihapus!');
    }
}
