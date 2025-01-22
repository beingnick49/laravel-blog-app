@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $blog->title }} detail</div>

                    <div class="card-body">

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('blogs.index') }}" class="btn btn-sm btn-secondary">Back to Blogs</a>
                        </div>

                        <div class="mb-3">
                            @if ($blog->image)
                                <img src="{{ asset('storage/images/blogs/' . $blog->image) }}" alt="{{ $blog->title }}"
                                    width="75px" class="img-fluid">
                            @else
                                <p>No Image</p>
                            @endif
                        </div>

                        <div class="mb-3">
                            <strong>Title :</strong>{!! $blog->title !!}
                        </div>

                        <div class="mb-3">
                            <strong>Content:</strong>
                            <p>{{ $blog->content }}</p>
                        </div>

                        <div class="mb-3">
                            <strong>Status:</strong>
                            <span class="badge bg-{{ $blog->status ? 'primary' : 'warning' }}">
                                {{ $blog->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
