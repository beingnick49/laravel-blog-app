@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Our Blog</h1>
            <p class="text-muted">Discover the latest stories, insights, and updates from our community.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($blogs->count() > 0)
            <div class="row gy-4">
                @foreach ($blogs as $blog)
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="row g-0">
                                <!-- Blog Image -->
                                <div class="col-md-4">
                                    <img src="{{ 'https://placehold.co/600x400/EEE/31343C' }}"
                                        class="img-fluid rounded-start h-100 object-cover" alt="{{ $blog->title }}">
                                </div>

                                <!-- Blog Content -->
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <!-- Blog Category -->
                                        <div class="mb-2">
                                            <span class="badge bg-primary text-uppercase">
                                                {{ $blog->category->name ?? 'Uncategorized' }}
                                            </span>
                                        </div>

                                        <!-- Blog Title -->
                                        <h5 class="card-title fw-bold">
                                            <a href="{{ route('blog.detail', $blog->slug) }}"
                                                class="text-decoration-none text-dark">
                                                {{ $blog->title }}
                                            </a>
                                        </h5>

                                        <!-- Blog Snippet -->
                                        <p class="card-text text-muted mt-3">
                                            {{ Str::limit($blog->content, 150, '...') }}
                                        </p>

                                        <!-- Meta Info -->
                                        <div class="mt-4">
                                            <small class="text-muted">
                                                By <strong>{{ $blog->user->name }}</strong> on
                                                {{ $blog->created_at->format('M d, Y') }}
                                            </small>
                                        </div>

                                        <!-- Read More Button -->
                                        <div class="mt-3">
                                            <a href="{{ route('blogs.show', $blog->id) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                Read More →
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        @else
            <p class="text-center text-muted fs-5">No blogs available at the moment. Check back later!</p>
        @endif
    </div>
@endsection
