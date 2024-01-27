@php use Diglactic\Breadcrumbs\Breadcrumbs; @endphp
@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render() }}
    @include('account.adverts._nav')

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Updated</th>
            <th>Title</th>
            <th>Region</th>
            <th>Category</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($adverts as $advert)
            <tr>
                <td>{{ $advert->id }}</td>
                <td>{{ $advert->updated_at }}</td>
                <td><a href="{{ route('adverts.show', $advert) }}" target="_blank">{{ $advert->title }}</a></td>
                <td>
                    @if ($advert->region)
                        {{ $advert->region->name }}
                    @endif
                </td>
                <td>{{ $advert->category->name }}</td>
                <td>
                    @if ($advert->isDraft())
                        <span class="badge text-bg-secondary">Draft</span>
                    @elseif ($advert->isOnModeration())
                        <span class="badge text-bg-warning">Moderation</span>
                    @elseif ($advert->isActive())
                        <span class="badge text-bg-success">Active</span>
                    @elseif ($advert->isClosed())
                        <span class="badge text-bg-danger">Closed</span>
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $adverts->links() }}
@endsection
