@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Blog Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">{{ $blog->title }}</h1>
            <p class="text-muted">
                By <strong>{{ $blog->user->name }}</strong> on {{ $blog->created_at->format('M d, Y') }} |
                <span class="badge bg-primary">{{ $blog->category->name ?? 'Uncategorized' }}</span>
            </p>
        </div>

        <!-- Blog Image -->
        @if ($blog->image_url)
            <div class="mb-4 text-center">
                <img src="{{ $blog->image_url }}" class="img-fluid rounded" alt="{{ $blog->title }}">
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

        <!-- Tags Section -->
        @if ($blog->tags->count())
            <div class="mb-4">
                <h5 class="fw-bold">Tags:</h5>
                @foreach ($blog->tags as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}" class="badge bg-secondary me-2">{{ $tag->name }}</a>
                @endforeach
            </div>
        @endif

        <!-- Comments Section -->
        <div class="mt-5">
            <h3 class="fw-bold">Comments</h3>
            <hr>
            @if ($blog->comments->count())
                <div class="list-group">
                    @foreach ($blog->comments as $comment)
                        <div class="list-group-item">
                            <p class="mb-1"><strong>{{ $comment->user->name }}</strong> commented:</p>
                            <p class="mb-0">{{ $comment->content }}</p>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No comments yet. Be the first to comment!</p>
            @endif
        </div>

        <!-- Add Comment Section -->
        <div class="mt-4">
            <h4 class="fw-bold">Add a Comment</h4>
            <form action="{{ route('comments.store', $blog->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" name="content" rows="4" placeholder="Write your comment here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>

        <!-- Back to Blogs Button -->
        <div class="mt-5 text-center">
            <a href="{{ route('blogs.index') }}" class="btn btn-outline-secondary">← Back to Blogs</a>
        </div>
    </div>
@endsection
