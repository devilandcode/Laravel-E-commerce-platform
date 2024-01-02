@php use Diglactic\Breadcrumbs\Breadcrumbs; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Breadcrumbs::render('home') }}
        <div class="card card-default mb-3">
            <div class="card-header">
                All Categories
            </div>
            <div class="card-body pb-0" style="color: #aaa">
            </div>
        </div>

        <div class="card card-default mb-3">
            <div class="card-header">
                All Regions
            </div>
            <div class="card-body pb-0" style="color: #aaa">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
@endsection
