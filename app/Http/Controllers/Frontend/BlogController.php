<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()
            ->latest('id')
            ->whereHas('user', function ($query) {
                $query->whereNot('status', 'banned');
            })
            ->active()
            ->paginate(10);

        return view('blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        if ($blog->status != 1) abort(404);

        return view('blog.show', compact('blog'));
    }
}
