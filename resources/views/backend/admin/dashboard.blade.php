@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Welcome !') }}

                        @if (auth()->user()->role == 'admin')
                            <div class="row mt-3">
                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('users.index') }}" class="card-link" style="text-decoration: none;">
                                        <div class="card text-white bg-primary">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Users</h5>
                                                <p class="card-text">{{ $totalUsers }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('users.index', ['status' => 'active']) }}" class="card-link"
                                        style="text-decoration: none;">
                                        <div class="card text-white" style="background-color: #4CAF50;">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Active Users</h5>
                                                <p class="card-text">{{ $totalActiveUsers }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('users.index', ['status' => 'banned']) }}" class="card-link"
                                        style="text-decoration: none;">
                                        <div class="card text-white" style="background-color: #063307;">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Banned Users</h5>
                                                <p class="card-text">{{ $totalBannedUsers }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('blogs.index') }}" class="card-link" style="text-decoration: none;">
                                        <div class="card text-white bg-success">
                                            <div class="card-body">
                                                <h5 class="card-title">Total Blogs</h5>
                                                <p class="card-text">{{ $totalBlogs }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('blogs.index', ['status' => 'active']) }}" class="card-link"
                                        style="text-decoration: none;">
                                        <div class="card text-white bg-info">
                                            <div class="card-body">
                                                <h5 class="card-title">Active Blogs</h5>
                                                <p class="card-text">{{ $activeBlogs }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('blogs.index', ['status' => 'inactive']) }}" class="card-link"
                                        style="text-decoration: none;">
                                        <div class="card text-white bg-warning">
                                            <div class="card-body">
                                                <h5 class="card-title">Inactive Blogs</h5>
                                                <p class="card-text">{{ $inactiveBlogs }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
