@extends('layouts.app')

@section('content')
    @include('account.banners._nav')

    <p>Choose category:</p>

    @include('account.banners.create._categories', ['categories' => $categories])

@endsection
