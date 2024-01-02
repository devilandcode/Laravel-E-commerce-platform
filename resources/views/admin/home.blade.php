@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('admin.home') }}
        @include ('admin._nav', ['page' => ''])
    </div>
@endsection
