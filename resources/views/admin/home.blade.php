@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render() }}
        @include ('admin._nav', ['page' => ''])
    </div>
@endsection
