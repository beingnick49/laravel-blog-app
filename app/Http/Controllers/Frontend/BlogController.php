<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->latest('id')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })
            ->whereHas('user', function ($query) {
                $query->user()->whereNot('status', 'banned');
            })
            ->active()
            ->paginate(10);

        return view('frontend.blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        if ($blog->status != 1) abort(404);

        return view('frontend.blogs.show', compact('blog'));
    }
}