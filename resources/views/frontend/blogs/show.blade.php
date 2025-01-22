@extends('layouts.app')

@section('content')
    <div class="container-lg py-5" style="max-width: 960px;">
        <!-- Blog Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">{{ $blog->title }}</h1>
            <p class="text-muted">
                By <strong>{{ $blog->user?->name }}</strong> on {{ $blog->created_at->format('M d, Y') }} |
                <span class="badge bg-primary">{{ $blog->category?->title ?? 'Blog' }}</span>
            </p>
        </div>

        <!-- Blog Image -->
        @if (isset($blog->image))
            <div class="mb-4 text-center">
                <img src="{{ asset('storage/images/blogs/' . $blog->image) }}" class="img-fluid rounded"
                    alt="{{ $blog->title }}">
            </div>
        @else
            <div class="mb-4 text-center">
                <img src="https://placehold.co/1200x600/EEE/31343C" class="img-fluid rounded" alt="Placeholder Image">
            </div>
        @endif

        <!-- Blog Content -->
        <div class="mb-5">
            <p class="fs-5 text-muted">{!! nl2br(e($blog->content)) !!}</p>
        </div>

        <!-- Back Button -->
        <div class="mt-5 text-center">
            <a href="{{ route('frontend.blogs.index') }}" class="btn btn-outline-secondary">← Back to Blogs</a>
        </div>
    </div>
@endsection
