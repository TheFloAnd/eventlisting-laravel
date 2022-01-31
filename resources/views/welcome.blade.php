<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
    <!-- Styles -->

</head>

<body class="container-fluid">
    {{-- <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
            @endauth
        </div>
        @endif --}}

        <button class="btn btn-lg btn_hidden btn_menu" type="button" href="?b=events" data-bs-toggle="offcanvas"
            data-bs-target="#home-offcanvasTop" aria-controls="home-offcanvasTop">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start home-offcanvas" tabindex="-1" id="home-offcanvasTop"
            aria-labelledby="home-offcanvasTopLabel">
            <div class="offcanvas-header">
                <h4 id="home-offcanvasTopLabel">
                    nav
                </h4>
                <button type="button" class="btn-close text-reset home-offcanvas-close" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body home-offcanvas-body">
                @if (Route::has('login'))
                @auth<div class="btn-group-vertical w-100">
                    <a href="{{ url('/home') }}" class="btn btn-outline-secondary home-offcanvas-body-link">
                        Home
                    </a>
                    <a href="?b=events" type="button" class="btn btn-outline-secondary home-offcanvas-body-link">
                        events
                    </a>
                    <a href="?b=groups" type="button" class="btn btn-outline-secondary home-offcanvas-body-link">
                        groups
                    </a>
                    <a href="{{ route('settings') }}" type="button" class="btn btn-outline-secondary home-offcanvas-body-link">
                        settings
                    </a>
                </div>
                <div class="mt-3">
                <a type="button" class="btn btn-outline-danger w-100" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form></div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success w-100 mb-1">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">
                        Register
                    </a>
                    @endif
                @endauth
                @endif
            </div>
        </div>
        <article class="row g-3 home article-home">
            <section class="col-12 home-section-today">
                <div class="card home-card-today">
                    <div class="card-header home-card-header home-card-today-header">
                        <nav class="navbar home-card-today-header-nav">
                            <div class="row home-card-today-header-row">
                                <div class="col-auto home-card-today-header-col">
                                    <div class="refresh" id="refresh-title">
                                        <h1 class="header-primary home-card-today-header-title">
                                            <title>{{ config('app.name', 'Laravel') }}</title>
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-auto home-card-today-header-col">
                                    <div class="refresh-icon invisible">
                                        <div class="spinner-grow" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <h1 class="header-primary home-card-today-header-title">
                                <span id="display_time"></span>
                            </h1>
                        </nav>
                    </div>
                    <div class="card-body home-card-body home-card-today-body refresh" id="refresh-home-card">
                        <div class="table-responsive">
                            <table class="table table-striped home-card-today-body-table">
                                <thead class="home-card-today-table-head">
                                    <tr>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            project
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            group
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            room
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            from
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            till
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="home-card-today-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="col-12 home-section-preview">
                <div class="card home-card-preview">
                    <div class="card-header home-card-preview-header">
                        <nav class="navbar navbar-dark home-card-preview-header-nav">

                            <div class="row home-card-preview-header-row">
                                <div class="col-auto home-card-preview-header-col">
                                    <h2 class="header-secondary home-card-preview-header-title">
                                        event preview
                                    </h2>
                                </div>
                                <div class="col-auto home-card-preview-header-col">
                                    <div class="refresh-icon invisible">
                                        <div class="spinner-grow" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="refresh" id="refresh-title-preview">
                                <h2 class="header-secondary home-card-preview-header-title">
                                </h2>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body refresh home-card-preview-body" id="refresh-card-preview">
                        <div class="table-responsive">
                            <table class="table table-striped home-card-preview-table">
                                <thead class="home-card-preview-table-head">
                                    <tr>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            project
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            group
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            room
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            from
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            till
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            remaining_days
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="home-card-preview-table-body">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </article>
        <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
        <!-- Jquery -->
        <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>
        <script>
            setInterval(function() {
            refresh_loop();
          }, 15 * 1000);
          function refresh_loop() {
            $('.refresh-icon').each(function(index, element) {
              $(element).removeClass("invisible");
              $(element).addClass("visible");
            });
            $('.refresh').each(function(index, element) {
              $(element).load(window.location.href + " #" + this.id + " > *");
            });
            setTimeout(function() {
              $('.refresh-icon').each(function(index, element) {
                $(element).removeClass("visible");
                $(element).addClass("invisible");
              });
            }, 1 * 1000);
            console.log(Date.now() + ' Content  Refreshed!');
          }
        </script>
        <?php
        echo '<script>
        show_clock();
        function show_clock(){
        const days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
        display_time = document.getElementById("display_time");
          const today = new Date();
          let y = today.getFullYear();
          let M = today.getMonth() + 1;
          let d= today.getDate();
          let D = today.getDay();
          D = days[D];
          let h = today.getHours();
          let m = today.getMinutes();
          let s = today.getSeconds();
          M = checkTime(M);
          d = checkTime(d);
          h = checkTime(h);
          m = checkTime(m);
          s = checkTime(s);
          // display_time.innerHTML = h + ":" + m + ":" + s;
          date = D + " " + d + "." + M + "." + y;
          time = h + ":" + m;
          display_time.innerHTML = date + " - " + time;
          setTimeout(show_clock, 1000)
        }
        function checkTime(i) {
          if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
        }
        </script>';
        ?>

</body>

</html>
