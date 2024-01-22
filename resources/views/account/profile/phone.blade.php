@extends('layouts.app')

@section('content')
    {{ Breadcrumbs::render()  }}
    @include('account.profile._nav')

    @if (session('error'))
        <div class="alert alert-danger mb-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('account.profile.phone.verify') }}">
        @csrf
        @method('PUT')
        <div class="form-group mb-4">
            <label for="token" class="col-form-label">SMS Code</label>
            <input id="token" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" name="token"
                   value="{{ old('token') }}" required>
            @if ($errors->has('token'))
                <span class="invalid-feedback"><strong>{{ $errors->first('token') }}</strong></span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Verify</button>
        </div>
    </form>

@endsection
