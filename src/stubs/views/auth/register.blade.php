@extends('layouts.auth')

@section('content')
<div class="card ui-radius-lg ui-shadow-xxl">
    <div class="card-body ui-spacer-xl">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="company_name">{{ trans('register.company-name') }}</label>
                <input id="company_name" name="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" value="{{ old('company_name') }}" autofocus>
            </div>

            <div class="form-group ui-required">
                <label for="name">{{ __('register.name') }}</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="form-group ui-required">
                <label for="email">{{ __('register.email') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group ui-required">
                <label for="password">{{ __('register.password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off">
                @if ($errors->has('password'))
                    <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group ui-required">
                <label for="password-confirm">{{ __('register.confirm-password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="off">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block btn-lg">
                    {{ __('register.create-account') }}
                </button>
            </div>
        </form>
    </div>

    <div class="card-footer d-flex justify-content-between ui-spacer-xl">
        <a href="{{ route('login') }}" class="text-decoration-none"><strong>{{ __('register.login') }}</strong></a>
    </div>
</div>
@endsection
