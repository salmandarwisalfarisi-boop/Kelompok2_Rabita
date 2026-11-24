<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('produk')->latest('kategori_id');

        if ($request->filled('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->paginate(10)->withQueryString();

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:tb_kategori,nama_kategori',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah digunakan.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpg, jpeg, png, webp, atau svg.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $baseSlug = Str::slug($request->nama_kategori);
        $slug = $baseSlug;
        $counter = 1;
        while (Kategori::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $gambarFilename = null;
        if ($request->hasFile('gambar')) {
            $destinationPath = public_path('assets/image/kategori');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $gambarFilename = time() . '_kategori_' . uniqid() . '.' . $ext;
            $file->move($destinationPath, $gambarFilename);
        }

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => $slug,
            'gambar'        => $gambarFilename,
        ]);

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:tb_kategori,nama_kategori,' . $kategori->kategori_id . ',kategori_id',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique'   => 'Nama kategori sudah digunakan.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus jpg, jpeg, png, webp, atau svg.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        $baseSlug = Str::slug($request->nama_kategori);
        if ($baseSlug !== $kategori->slug) {
            $slug = $baseSlug;
            $counter = 1;
            while (Kategori::where('slug', $slug)->where('kategori_id', '!=', $kategori->kategori_id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $kategori->slug = $slug;
        }

        if ($request->hasFile('gambar')) {
            $destinationPath = public_path('assets/image/kategori');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($kategori->gambar) {
                $oldPath = $destinationPath . '/' . $kategori->gambar;
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '_kategori_' . uniqid() . '.' . $ext;
            $file->move($destinationPath, $filename);
            $kategori->gambar = $filename;
        }

        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->produk()->count() > 0) {
            return redirect()->route('kategori.index')
                             ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        if ($kategori->gambar) {
            $path = public_path('assets/image/kategori/' . $kategori->gambar);
            if (file_exists($path) && is_file($path)) {
                @unlink($path);
            }
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}
