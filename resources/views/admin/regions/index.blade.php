@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render() }}

    @include('admin.regions._nav')

    <p><a href="{{ route('admin.regions.create') }}" class="btn btn-success">Add Region</a></p>

    @include('admin.regions._list', ['regions' => $regions])

    {{ $regions->links() }}
@endsection
