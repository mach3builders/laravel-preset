@extends('layouts.auth')

@section('content')
    @include('ui::alert')

    <div class="card ui-radius-lg ui-shadow-xxl">
        <div class="card-body ui-spacer-xl">

            <form method="POST" action="{{ route('forgot-password') }}">
                @csrf

                <div class="form-group">
                    <label for="email">{{ __('passwords.email') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        {{ __('passwords.request-password') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="card-footer d-flex justify-content-between ui-spacer-xl">
            <a href="{{ route('login') }}" class="text-decoration-none"><strong>{{ __('passwords.login') }}</strong></a>
        </div>
    </div>
</div>
@endsection
