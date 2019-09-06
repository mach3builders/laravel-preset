@extends('layouts.auth')

@section('content')
    @include('ui::alert')

    <div class="card ui-radius-lg ui-shadow-xxl">
        <div class="card-body ui-spacer-xl">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">{{ trans('register.name') }}</label>
                    <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" autofocus>
                </div>

                <div class="form-group ui-required">
                    <label for="contact">{{ __('register.contact') }}</label>
                    <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : '' }}" name="contact" value="{{ old('contact') }}">
                    @if ($errors->has('contact'))
                        <span class="invalid-feedback">{{ $errors->first('contact') }}</span>
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
