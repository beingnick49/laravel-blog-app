@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Search Form -->
                <form action="{{ route('users.index') }}" method="GET" class="mb-3">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <input type="text" name="query" class="form-control" placeholder="Enter query..."
                                value="{{ request('query') }}">
                        </div>
                        <div class="col-md-6">
                            <select name="status" class="form-select">
                                <option value="">All Users</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                            </select>
                        </div>
                        <div class="col-12 text-end mt-2">
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">Reset</a>
                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Number of blogs</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->blogs->count() }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $user->status === 'active' ? 'primary' : 'danger' }}">{{ Str::ucfirst($user->status) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('users.status', $user->id) }}">
                                                @if ($user->status == 'active')
                                                    Ban user
                                                @endif
                                                @if ($user->status == 'banned')
                                                    Unban user
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            No users available !
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $users->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
