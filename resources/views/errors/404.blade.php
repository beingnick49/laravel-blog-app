@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">404 | Page Not Found</h1>
        </div>
        <div class="text-center text-muted fs-5">
            <a href="{{ route('frontend.blogs.index') }}">Go back to homepage</a>
        </div>
    </div>
@endsection
