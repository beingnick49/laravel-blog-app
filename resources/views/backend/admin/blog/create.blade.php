@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add New Blog') }}</div>

                    <div class="card-body">

                        <div class="container">
                            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-3">
                                    <label for="image">Image (optional)</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label>Status</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status_active"
                                                value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_active">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="status_inactive" value="0"
                                                {{ old('status') == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="status_inactive">Inactive</label>
                                        </div>
                                    </div>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
