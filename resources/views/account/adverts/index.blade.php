@php use Diglactic\Breadcrumbs\Breadcrumbs; @endphp
@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render() }}
    <ul class="nav nav-tabs mb-3">
        <li class="nav-item"><a class="nav-link" href="{{ route('account.home') }}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('account.adverts.index') }}">Adverts</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Favorites</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Banners</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('account.profile.home') }}">Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Tickets</a></li>
    </ul>

{{--    <div class="region-selector" data-selected="{{ json_encode((array)old('regions')) }}" data-source="{{ route('ajax.regions') }}"></div>--}}
@endsection
