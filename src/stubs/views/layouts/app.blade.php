<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mach3Builders') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="ui-layout">
        @if (Auth::check())
            <!-- Sidebar nav -->
            <nav class="ui-layout-nav">
                <div class="ui-layout-nav-header">
                    <a href="/" class="ui-layout-nav-logo">
                        {{ config('app.name', 'Mach3builders') }}
                    </a>

                    <a href="/" id="ui-layout-nav-hide-handler">
                        <i class="far fa-times"></i>
                    </a>
                </div>
                <div class="ui-layout-nav-main">
                    <ul class="nav nav-dark flex-column">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link active">
                                <span class="ui-icon-text">
                                    <i class="far fa-home"></i>
                                    <span>{{ _('Home') }}</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endif

        <div class="ui-layout-view">
            @if (Auth::check())
                <!-- Header -->
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
                                <a href="#" class="dropdown-item">Account</a>

                                <a href="{{ route('logout') }}"
                                    class="dropdown-item"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ _('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>

                        <a href="/" id="ui-layout-nav-show-handler">
                            <i class="far fa-bars"></i>
                        </a>
                    </div>
                </div>
            @endif

            <!-- Main view -->
            <main class="ui-layout-view-main">
                <div class="ui-container">
                    @include('ui::alert')
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @include('ui::notify')
</body>
</html>
