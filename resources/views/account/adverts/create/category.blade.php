@extends('layouts.app')

@section('content')
    @include('account.adverts._nav')

    <p>Choose category:</p>

    @include('account.adverts.create._categories', ['categories' => $categories])

@endsection
