<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Blog::latest()->paginate(10);
        return view('blog.index', compact('posts'));
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(StoreRequest $request)
    {
        $imagePath = $request->file('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => auth()->id,
        ]);

        return redirect()->route('blog.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('update', $blog);
        return view('blog.edit', compact('blog'));
    }

    public function update(UpdateRequest $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        if ($request->hasFile('image')) {
            if ($blog->image) Storage::disk('public')->delete($blog->image);
            $blog->image = $request->file('image')->store('images', 'public');
        }

        $blog->update($request->only('title', 'content', 'image'));

        return redirect()->route('blog.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        if ($blog->image) Storage::disk('public')->delete($blog->image);

        $blog->delete();

        return redirect()->route('blog.index')->with('success', 'Blog deleted successfully.');
    }

    public function status(Blog $blog)
    {
        $this->authorize('update', $blog);

        $blog->update(["status" => !$blog->status]);

        return redirect()->route('blog.index')->with('success', 'Blog status changed successfully.');
    }
}
