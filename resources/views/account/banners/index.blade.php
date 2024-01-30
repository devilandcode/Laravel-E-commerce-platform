@extends('layouts.app')

@section('content')
    @include('account.banners._nav')

    <p><a href="{{ route('account.banners.create') }}" class="btn btn-success">Add Banner</a></p>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Region</th>
            <th>Category</th>
            <th>Published</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($banners as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td><a href="{{ route('account.banners.show', $banner) }}" target="_blank">{{ $banner->name }}</a></td>
                <td>
                    @if ($banner->region)
                        {{ $banner->region->name }}
                    @endif
                </td>
                <td>{{ $banner->category->name }}</td>
                <td>{{ $banner->published_at }}</td>
                <td>
                    @if ($banner->isDraft())
                        <span class="badge text-bg-secondary">Draft</span>
                    @elseif ($banner->isOnModeration())
                        <span class="badge text-bg-warning">Moderation</span>
                    @elseif ($banner->isModerated())
                        <span class="badge text-bg-success">Ready to Payment</span>
                    @elseif ($banner->isOrdered())
                        <span class="badge badge-warning">Waiting for Payment</span>
                    @elseif ($banner->isActive())
                        <span class="badge text-bg-success">Active</span>
                    @elseif ($banner->isClosed())
                        <span class="badge text-bg-danger">Closed</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $banners->links() }}
@endsection
