<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{--
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}"> --}}

    <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/dataTables/dataTables.bootstrap5.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a href="{{ url('/events') }}" class="nav-link">
                                <span class="btn-label pe-1"><i class="bi bi-calendar"></i></span>
                                {{ __('Termine') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/groups') }}" class="nav-link">
                                <span class="btn-label pe-1"><i class="bi bi-people"></i></span>
                                {{ __('Gruppen') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/settings') }}" class="nav-link">
                                <span class="btn-label pe-1"><i class="bi bi-gear"></i></span>
                                {{ __('Einstellungen') }}
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container mt-3">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/init/bootstrap/bootstrap.validation.init.js') }}"></script>
    <!-- Jquery -->
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>

    <!-- Jquery Datatable -->
    <script src="{{ asset('js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Select 2 -->
    <script src="{{ asset('js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/init/select2/select2.init.js') }}"></script>
    <script>
        $(document).ready(function() {
                $('.multiple-select').select2();
            });
    </script>

    <script src="{{ asset('js/input_disable.js') }}"></script>
    <script src="{{ asset('js/input_length.js') }}"></script>


    <script src="{{ asset('js/init/dataTables/default.init.js') }}" defer></script>
    <script src="{{ asset('js/init/dataTables/groups_active.init.js') }}" defer></script>
    <script src="{{ asset('js/init/dataTables/groups_inactive.init.js') }}" defer></script>
</body>

</html>
