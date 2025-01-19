@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Search Form -->
                <form action="{{ route('blogs.index') }}" method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control" placeholder="Search by Title"
                                value="{{ request('title') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>In-Active
                                </option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-2">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            <a href="{{ route('blogs.index') }}" class="btn btn-secondary btn-sm">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="card-header">{{ __('Blogs') }}</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary">Add blog</a>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Created by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($blogs as $key => $blog)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            @if ($blog->image)
                                                <img src="{{ asset('storage/images/blogs/' . $blog->image) }}"
                                                    alt="{{ $blog->title }}" class="img-fluid" style="max-width: 75px;">
                                            @else
                                                <p>No Image</p>
                                            @endif
                                        </td>
                                        <td>{{ $blog->title }}</td>
                                        <td>{{ $blog->category?->title }}</td>
                                        <td>{{ $blog->user?->name }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $blog->status ? 'primary' : 'warning' }}">{{ $blog->status ? 'Active' : 'In-Active' }}</span>
                                        </td>
                                        <td style="display: flex; gap: 0.5rem;">
                                            <a href="{{ route('blogs.show', $blog->id) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            <a href="{{ route('blogs.edit', $blog->id) }}"
                                                class="btn btn-sm btn-secondary">Edit</a>

                                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No blogs available!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $blogs->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
