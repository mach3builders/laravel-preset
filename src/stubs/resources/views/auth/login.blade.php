@extends('layouts.auth')

@section('content')
<div class="card ui-radius-lg ui-shadow-xxl">
    <div class="card-body ui-spacer-xl">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">{{ __('login.email') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="password">{{ __('login.password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off">
                @if ($errors->has('password'))
                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">{{ __('login.remember-me') }}</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">
                    {{ __('login.login') }}
                </button>
            </div>
        </form>
    </div>

    <div class="card-footer d-flex justify-content-between ui-spacer-xl">
        <a href="{{ route('register') }}" class="text-decoration-none"><strong>{{ __('login.create-account') }}</strong></a>
        <a href="{{ route('forgot-password') }}" class="text-decoration-none text-secondary">{{ __('login.forgot-password') }}</a>
    </div>
</div>
@endsection
