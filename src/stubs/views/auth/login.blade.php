@extends('layouts.app')

@section('content')
<div class="ui-container-xs">
    <div class="d-flex justify-content-center mb-5">
        <h1>{{ config('app.name', 'Mach3builders') }}</h1>
    </div>

    <div class="card ui-radius-lg ui-shadow-xxl">
        <div class="card-body ui-spacer-xl">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>

                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox mr-sm-2">
                        <input type="checkbox" name="remember" class="custom-control-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="card-footer d-flex justify-content-between ui-spacer-xl">
            <a href="{{ route('register') }}" class="text-decoration-none"><strong>{{ __('Register') }}</strong></a>
            <a href="{{ route('password.request') }}" class="text-decoration-none text-secondary">{{ __('Forgot Your Password?') }}</a>
        </div>
    </div>
</div>
@endsection
