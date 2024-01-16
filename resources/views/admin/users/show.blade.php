@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render() }}

    @include('admin.users._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary me-3">Edit</a>

        @if ($user->isWait())
            <form method="POST" action="{{ route('admin.users.verify') }}" class="me-3">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button class="btn btn-success">Verify</button>
            </form>
        @endif

        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="me-3">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Name</th><td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th><td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if ($user->isWait())
                    <span class="badge text-bg-warning">Waiting</span>
                @endif
                @if ($user->isActive())
                    <span class="badge text-bg-success">Active</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Role</th>
            <td>
                @if ($user->isAdmin())
                    <span class="badge text-bg-danger">Admin</span>
                @else
                    <span class="badge text-dark">User</span>
                @endif
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
