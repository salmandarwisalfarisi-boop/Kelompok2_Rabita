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

        return view('admin.produk.index', compact('produk', 'kategoriList'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.produk.create', compact('kategori'));
    }

    public function show(Produk $produk)
    {
        $produk->load(['kategori', 'motif']);

        return response()->json([
            'status' => 'success',
            'data' => [
                'produk_id' => $produk->produk_id,
                'nama_produk' => $produk->nama_produk,
                'kategori' => $produk->kategori->nama_kategori ?? '-',
                'deskripsi_produk' => $produk->deskripsi_produk,
                'harga' => $produk->harga,
                'berat_gram' => $produk->berat_gram,
                'ukuran' => $produk->ukuran,
                'material' => $produk->material,
                'status' => $produk->status,
                'motif' => $produk->motif->map(function ($motif) {
                    return [
                        'nama_motif' => $motif->nama_motif,
                        'stok' => $motif->stok,
                        'status' => $motif->status_motif ? 'Aktif' : 'Tidak aktif',
                        'gambar' => collect(['gambar_depan', 'gambar_kiri', 'gambar_kanan', 'gambar_dalam'])
                            ->map(function ($field) use ($motif) {
                                return $motif->$field ? asset('assets/image/produk/' . $motif->$field) : null;
                            })
                            ->filter()
                            ->values(),
                    ];
                }),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk'      => 'required|string|max:150',
            'kategori_id'      => 'required|exists:tb_kategori,kategori_id',
            'material'         => 'required|string|max:100',
            'harga'            => 'required|integer|min:0',
            'ukuran'           => 'required|string|max:50',
            'berat_gram'       => 'required|integer|min:0',
            'deskripsi_produk' => 'required|string',
            'motif'                         => 'required|array|min:1|max:4',
            'motif.*.nama_motif'            => 'required|string|max:100',
            'motif.*.stok'                  => 'required|integer|min:0',
            'motif.*.status'                => 'required|in:aktif,sold_out,arsip',
            'motif.*.gambar_depan'          => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'motif.*.gambar_kiri'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'motif.*.gambar_kanan'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'motif.*.gambar_dalam'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_produk.required'      => 'Nama produk wajib diisi.',
            'kategori_id.required'      => 'Kategori wajib dipilih.',
            'material.required'         => 'Material wajib diisi.',
            'harga.required'            => 'Harga wajib diisi.',
            'ukuran.required'           => 'Ukuran wajib diisi.',
            'berat_gram.required'       => 'Berat wajib diisi.',
            'deskripsi_produk.required' => 'Deskripsi produk wajib diisi.',
            'motif.required'                         => 'Minimal satu motif wajib ditambahkan.',
            'motif.max'                              => 'Maksimal empat motif untuk setiap produk.',
            'motif.*.nama_motif.required'            => 'Nama motif wajib diisi.',
            'motif.*.stok.required'                  => 'Stok motif wajib diisi.',
            'motif.*.gambar_depan.required'          => 'Foto depan setiap motif wajib diunggah.',
            'motif.*.gambar_depan.image'             => 'File foto depan harus berupa gambar.',
        ]);
        $motifs = $validated['motif'];
        $firstMotif = reset($motifs);

        $produk = Produk::create([
            'kategori_id'      => $request->kategori_id,
            'nama_produk'      => $request->nama_produk,
            'slug'             => Str::slug($request->nama_produk) . '-' . uniqid(),
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga'            => $request->harga,
            'berat_gram'       => $request->berat_gram,
            'ukuran'           => $request->ukuran,
            'material'         => $request->material,
            'status'           => $firstMotif['status'],
        ]);

        $destinationPath = public_path('assets/image/produk');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        foreach ($motifs as $index => $data) {
            $fotoNames = [];

            foreach (['gambar_depan', 'gambar_kiri', 'gambar_kanan', 'gambar_dalam'] as $field) {
                $file = $request->file("motif.{$index}.{$field}");
                $fotoNames[$field] = null;
                if ($file) {
                    $filename = time() . '_' . $field . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $filename);
                    $fotoNames[$field] = $filename;
                }
            }

            Motif::create([
                'produk_id'    => $produk->produk_id,
                'nama_motif'   => $data['nama_motif'],
                'stok'         => $data['stok'],
                'gambar_depan' => $fotoNames['gambar_depan'],
                'gambar_kiri'  => $fotoNames['gambar_kiri'],
                'gambar_kanan' => $fotoNames['gambar_kanan'],
                'gambar_dalam' => $fotoNames['gambar_dalam'],
                'status_motif' => $data['status'] === 'aktif',
            ]);
        }

        return redirect()->route('produk.index')
                         ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        $produk->load('motif');
        $kategori = Kategori::all();
        $motifPertama = $produk->motif->first();

        return view('admin.produk.edit', compact('produk', 'kategori', 'motifPertama'));
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
