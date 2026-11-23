<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::latest('blog_id');

        // Filter Pencarian (Judul atau Isi Blog)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate(10)->withQueryString();

        return view('blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:200',
            'isi'         => 'required|string',
            'thumbnail'   => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status_blog' => 'required|in:1,0',
        ], [
            'judul.required'       => 'Judul blog wajib diisi.',
            'isi.required'         => 'Isi blog wajib diisi.',
            'thumbnail.required'   => 'Thumbnail gambar blog wajib diunggah.',
            'thumbnail.image'      => 'File thumbnail harus berupa gambar.',
            'thumbnail.max'        => 'Ukuran thumbnail maksimal 2MB.',
            'status_blog.required' => 'Status publikasi wajib dipilih.',
        ]);

        $baseSlug = Str::slug($request->judul);
        $slug = $baseSlug;
        $counter = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $destinationPath = public_path('assets/image/blog');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file = $request->file('thumbnail');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '_blog_' . uniqid() . '.' . $ext;
        $file->move($destinationPath, $filename);

        Blog::create([
            'judul'       => $request->judul,
            'slug'        => $slug,
            'isi'         => $request->isi,
            'thumbnail'   => $filename,
            'status_blog' => (bool) $request->status_blog,
        ]);

        return redirect()->route('blog.index')
                         ->with('success', 'Artikel blog baru berhasil diterbitkan!');
    }

    public function show(Blog $blog)
    {
        $blogs = Blog::where('status_blog', true)->latest('blog_id')->paginate(9);
        return view('blog', compact('blogs', 'blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'judul'       => 'required|string|max:200',
            'isi'         => 'required|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status_blog' => 'required|in:1,0',
        ], [
            'judul.required'       => 'Judul blog wajib diisi.',
            'isi.required'         => 'Isi blog wajib diisi.',
            'thumbnail.image'      => 'File thumbnail harus berupa gambar.',
            'thumbnail.max'        => 'Ukuran thumbnail maksimal 2MB.',
            'status_blog.required' => 'Status publikasi wajib dipilih.',
        ]);

        $baseSlug = Str::slug($request->judul);
        if ($baseSlug !== $blog->slug) {
            $slug = $baseSlug;
            $counter = 1;
            while (Blog::where('slug', $slug)->where('blog_id', '!=', $blog->blog_id)->exists()) {
                $slug = $baseSlug . '-' . $counter++;
            }
            $blog->slug = $slug;
        }

        if ($request->hasFile('thumbnail')) {
            $destinationPath = public_path('assets/image/blog');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            if ($blog->thumbnail) {
                $oldPath = $destinationPath . '/' . $blog->thumbnail;
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $file = $request->file('thumbnail');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '_blog_' . uniqid() . '.' . $ext;
            $file->move($destinationPath, $filename);
            $blog->thumbnail = $filename;
        }

        $blog->judul       = $request->judul;
        $blog->isi         = $request->isi;
        $blog->status_blog = (bool) $request->status_blog;
        $blog->save();

        return redirect()->route('blog.index')
                         ->with('success', 'Artikel blog berhasil diperbarui!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail) {
            $path = public_path('assets/image/blog/' . $blog->thumbnail);
            if (file_exists($path) && is_file($path)) {
                @unlink($path);
            }
        }

        $blog->delete();

        return redirect()->route('blog.index')
                         ->with('success', 'Artikel blog berhasil dihapus!');
    }
}
