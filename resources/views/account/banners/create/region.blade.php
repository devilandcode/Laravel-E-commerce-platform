@extends('layouts.app')

@section('content')
    @include('account.banners._nav')

    @if ($region)
        <p>
            <a href="{{ route('account.banners.create.banner', [$category, $region]) }}" class="btn btn-success">Add Advert for {{ $region->name }}</a>
        </p>
    @else
        <p>
            <a href="{{ route('account.banners.create.banner', [$category]) }}" class="btn btn-success">Add Advert for all regions</a>
        </p>
    @endif

    <p>Or choose nested region:</p>

    <ul>
        @foreach ($regions as $current)
            <li>
                <a href="{{ route('account.banners.create.region', [$category, $current]) }}">{{ $current->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection
