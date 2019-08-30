<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layouts.partials.head')
</head>
<body class="ui-overflow-auto">
    <div class="ui-layout">
        <div class="ui-layout-view">
            <div class="ui-layout-view-header ui-transparent">
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle ui-flat" data-toggle="dropdown">
                        <span class="ui-icon-text">
                            <i class="far fa-globe"></i>
                            <span>{{ __('common.locale-'. app()->getLocale()) }}</span>
                        </span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="/change-locale/nl" class="dropdown-item">{{ __('common.locale-nl') }}</a>
                        <a href="/change-locale/en" class="dropdown-item">{{ __('common.locale-en') }}</a>
                    </div>
                </div>
            </div>

            <main class="ui-layout-view-main">
                <div class="ui-container-xs">
                    <div class="d-flex justify-content-center mb-5">
                        <a href="/">
                            <img src="{{ asset('assets/img/logo-dark.svg') }}" alt="{{ config('app.name', 'Mach3Builders') }}" class="ui-logo">
                        </a>
                    </div>

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="{{ mix('/assets/js/app.js') }}"></script>
</body>
</html>
