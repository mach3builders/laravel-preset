@extends('layouts.app')

@section('content')
<div class="ui-container-xs">
    <div class="d-flex justify-content-center mb-5">
        <h1>{{ config('app.name', 'Mach3builders') }}</h1>
    </div>

    <div class="card ui-radius-lg ui-shadow-xxl">
        <div class="card-body ui-spacer-xl">
            <form method="POST" action="{{ route('password.update') }}" novalidate>
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" autofocus>

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
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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
