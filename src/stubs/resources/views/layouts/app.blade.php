<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
@include('layouts.partials.head')
</head>
<body>
    <div id="app" class="ui-layout">
        <nav class="ui-layout-nav">
            <div class="ui-layout-nav-header">
                <a href="/" class="ui-layout-nav-logo">
                    <img src="{{ asset('assets/img/logo-light.svg') }}" alt="{{ config('app.name', 'Mach3Builder') }}" class="ui-logo-sm">
                </a>
                <a href="/" id="ui-layout-nav-hide-handler">
                    <i class="far fa-times"></i>
                </a>
            </div>

            <div class="ui-layout-nav-main">
                <ul class="nav nav-dark flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active">
                            <span class="ui-icon-text">
                                <i class="far fa-tachometer"></i>
                                <span>{{ __('dashboard.nav') }}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="ui-layout-view">
            <div class="ui-layout-view-header">
                @yield('breadcrumb')

                <div class="ui-btns">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle ui-flat" data-toggle="dropdown">
                            <span class="ui-icon-text">
                                <i class="far fa-user-alt"></i>
                                <span>{{ Auth::user()->name }}</span>
                            </span>
                        </button>

                        <div class="dropdown-menu">
                            <a href="/users/{{ Auth::user()->id }}/edit" class="dropdown-item">{{ __('common.account') }}</a>
                            <a href="{{ route('logout') }}" class="dropdown-item">
                                {{ __('common.logout') }}
                            </a>
                        </div>
                    </div>

                    <a href="/" id="ui-layout-nav-show-handler">
                        <i class="far fa-bars"></i>
                    </a>
                </div>
            </div>

            <main class="ui-layout-view-main">
                <div class="ui-container">
                    @include('ui::alert')
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('ui::notify')

    <script src="{{ mix('assets/js/app.js') }}"></script>
</body>
</html>
