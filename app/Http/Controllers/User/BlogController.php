<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\StoreRequest;
use App\Http\Requests\Blog\UpdateRequest;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()
            ->when(auth()->user()->role !== 'admin', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->when(request('status'), function ($query) {
                if (request('status') == 'inactive') $query->where('status', 0);
                if (request('status') == 'active')  $query->where('status', 1);
            })
            ->paginate(10);

        return view('backend.user.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('backend.user.blog.create');
    }

    public function store(StoreRequest $request)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/blogs';
            Storage::disk('public')->putFileAs($folderPath, $image, $imageName);
        }

        Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'image' => $imageName,
            'status' => $request->status,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('backend.user.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        $this->authorize('edit', $blog);

        return view('backend.user.blog.edit', compact('blog'));
    }

    public function update(UpdateRequest $request, Blog $blog)
    {
        $this->authorize('update', $blog);

        $imageName = null;

        if ($request->hasFile('image')) {
            if ($blog->image) {
                $oldImagePath = 'images/blogs/' . $blog->image;
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $folderPath = 'images/blogs';
            Storage::disk('public')->putFileAs(
                $folderPath,
                $image,
                $imageName
            );

            $blog->image = $imageName;
        }

        $slug = Str::slug($request->title);

        $blog->update($request->only('title', 'content', 'status') + ['slug' => $slug]);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $this->authorize('delete', $blog);

        if ($blog->image) {
            $imagePath = 'images/blogs/' . $blog->image;
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
