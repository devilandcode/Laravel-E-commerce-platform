@extends('layouts.app')

@section('content')
    @include('account.banners._nav')

    <div class="d-flex flex-row mb-3">

        @if ($banner->canBeChanged())
            <a href="{{ route('account.banners.edit', $banner) }}" class="btn btn-primary me-1">Edit</a>
            <a href="{{ route('account.banners.file', $banner) }}" class="btn btn-primary me-1">Change File</a>
        @endif

        @if ($banner->isDraft())
            <form method="POST" action="{{ route('account.banners.send', $banner) }}" class="me-1">
                @csrf
                <button class="btn btn-success">Send to Moderation</button>
            </form>
        @endif

        @if ($banner->isOnModeration())
            <form method="POST" action="{{ route('account.banners.cancel', $banner) }}" class="me-1">
                @csrf
                <button class="btn btn-secondary">Cancel Moderation</button>
            </form>
        @endif

        @if ($banner->isModerated())
            <form method="POST" action="{{ route('account.banners.order', $banner) }}" class="me-1">
                @csrf
                <button class="btn btn-success">Order for Payment</button>
            </form>
        @endif

        @if ($banner->canBeRemoved())
            <form method="POST" action="{{ route('account.banners.destroy', $banner) }}" class="mr-1">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        @endif
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th>
            <td>{{ $banner->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $banner->name }}</td>
        </tr>
        <tr>
            <th>Region</th>
            <td>
                @if ($banner->region)
                    {{ $banner->region->name }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Category</th>
            <td>{{ $banner->category->name }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if ($banner->isDraft())
                    <span class="badge text-bg-secondary">Draft</span>
                @elseif ($banner->isOnModeration())
                    <span class="badge text-bg-warning">Moderation</span>
                @elseif ($banner->isModerated())
                    <span class="badge text-bg-success">Ready to Payment</span>
                @elseif ($banner->isOrdered())
                    <span class="badge text-bg-warning">Waiting for Payment</span>
                @elseif ($banner->isActive())
                    <span class="badge text-bg-success">Active</span>
                @elseif ($banner->isClosed())
                    <span class="badge text-bg-danger">Closed</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Url</th>
            <td><a href="{{ $banner->url }}">{{ $banner->url }}</a></td>
        </tr>
        <tr>
            <th>Limit</th>
            <td>{{ $banner->limit }}</td>
        </tr>
        <tr>
            <th>Views</th>
            <td>{{ $banner->views }}</td>
        </tr>
        <tr>
            <th>Publish Date</th>
            <td>{{ $banner->published_at }}</td>
        </tr>
        </tbody>
    </table>

    <div class="card">
        <div class="card-body">

            <img src="{{ asset('storage/' . $banner->file ) }}" />
        </div>
    </div>
@endsection
