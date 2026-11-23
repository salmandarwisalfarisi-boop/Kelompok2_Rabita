<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogPublicController extends Controller
{
    /**
     * Tampilkan semua artikel blog publik
     */
    public function index()
    {
        $blogs = Blog::where('status_blog', true)
            ->latest('blog_id')
            ->paginate(9);

        return view('blog', compact('blogs'));
    }

    /**
     * Tampilkan detail artikel blog dan rekomendasi artikel lainnya
     */
    public function show($id)
    {
        $blog = Blog::where('status_blog', true)->findOrFail($id);

        // Rekomendasi "Baca blog seru lainnya" (maksimal 3 artikel selain artikel ini)
        $blogLainnya = Blog::where('status_blog', true)
            ->where('blog_id', '!=', $id)
            ->latest('blog_id')
            ->take(3)
            ->get();

        return view('blog-detail', compact('blog', 'blogLainnya'));
    }
}
