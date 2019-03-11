@extends('layouts.app')

@section('content')
<div class="ui-container-xs">
    <div class="d-flex justify-content-center mb-5">
        <h1>{{ config('app.name', 'Mach3builders') }}</h1>
    </div>
    
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="card ui-radius-lg ui-shadow-xxl">
        <div class="card-body ui-spacer-xl">

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
        
        <div class="card-footer d-flex justify-content-between ui-spacer-xl">
            <a href="{{ route('login') }}" class="text-decoration-none"><strong>{{ __('Login') }}</strong></a>
        </div>
    </div>
</div>
@endsection
