<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layouts.partials.head')
</head>
<body>
    <div class="ui-layout">
        <div class="ui-layout-view">
            <div class="ui-layout-view-header">
                <a href="/" class="ml-0">
                    <img src="{{ asset('assets/img/logo-dark.svg') }}" alt="{{ config('app.name', 'Mach3Builders') }}" class="ui-logo-sm">
                </a>
            </div>

            <main class="ui-layout-view-main pt-5">
                <div class="ui-container">
                    @yield('content')

                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">
                        <span class="ui-icon-text">
                            <i class="far fa-angle-left"></i>
                            <span>{{ __('common.previous-page') }}</span>
                        </span>
                    </a>
                </div>
            </main>
        </div>
    </div>

    <script src="{{ mix('/assets/js/app.js') }}"></script>
</body>
</html>
