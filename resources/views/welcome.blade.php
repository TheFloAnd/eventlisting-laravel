<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/svg/calendar-event-fill.svg') }}">
    <title>{{ $title->value ?? 'Termine' }}</title>

    <!-- Fonts -->
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dark.css') }}">
    <!-- Styles -->

</head>

<body class="container-fluid">

        <x-home_nav />

        <article class="row g-3 home article-home">
            <section class="col-12 home-section-today">
                <div class="card home-card-today">
                    <div class="card-header home-card-header home-card-today-header">
                        <nav class="navbar home-card-today-header-nav">
                            <div class="row home-card-today-header-row">
                                <div class="col-auto home-card-today-header-col">
                                    <div id="refresh-title" data-refresh>
                                        <h1 class="header-primary">
                                            {{ $title->value ?? 'Termine' }}
                                        </h1>
                                    </div>
                                </div>
                                <div class="col-auto home-card-today-header-col">
                                    <div class="invisible" data-refresh-icon>
                                        <div class="spinner-grow" role="status">
                                            <span class="visually-hidden">{{ __('Laden...') }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <h1 class="header-primary home-card-today-header-title">
                                <span id="display_time"></span>
                            </h1>
                        </nav>
                    </div>
                    <div class="card-body home-card-body home-card-today-body" id="refresh-home-card" data-refresh>
                        <div class="table-responsive">
                            <table class="table table-striped home-card-today-body-table">
                                <thead class="home-card-today-table-head">
                                    <tr>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            {{ __('Termin') }}
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            {{ __('Gruppe') }}
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            {{ __('Raum') }}
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            {{ __('Von') }}
                                        </th>
                                        <th scope="col" class="home-card-today-table-head-item">
                                            {{ __('Bis') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="home-card-today-table-body">

                                    @forEach($today as $row)
                                    @if($row->not_applicable == 1)
                                    <tr class="table-danger strikethrough">
                                        @else
                                    <tr>
                                        @endif
                                        <td>
                                            {{ $row->event }}
                                        </td>
                                        <td>
                                            @foreach(explode(';', $row->team) as $group)
                                            @forEach($groups as $get_color)
                                            @if($get_color->alias == $group)
                                            <span class="badge rounded-pill text-dark"
                                                style="background-color:{{ $get_color->color }};">

                                                {{ $group }}
                                            </span>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $row->room }}
                                        </td>
                                        @if(date('d.m.Y', strtotime($row->start)) != date('d.m.Y',
                                        strtotime($row->end)))

                                        @if(date('H:i', strtotime($row->start)) == '00:00')
                                        <td> {{ date('d.m.Y', strtotime($row->start)) }} </td>
                                        @else
                                        <td> {{ date('d.m.Y - H:i', strtotime($row->start)) }} </td>
                                        @endif

                                        @if(date('H:i', strtotime($row->end)) == '00:00')
                                        <td> {{ date('d.m.Y ', strtotime($row->end)) }} </td>
                                        @else
                                        <td> {{ date('d.m.Y - H:i', strtotime($row->end))}} </td>
                                        @endif

                                        @endif
                                        @if(date('d.m.Y', strtotime($row->start)) == date('d.m.Y',
                                        strtotime($row->end)))

                                        @if(date('H:i', strtotime($row->start)) == date('H:i',
                                        strtotime($row->end)))

                                        @if(date('H:i', strtotime($row->start)) == '00:00')
                                        <td colspan="2"> {{ date('d.m.Y ', strtotime($row->start)) }}
                                        </td>
                                        <td style="display:none;">
                                            @else
                                        <td colspan="2"> {{ date('d.m.Y - H:i', strtotime($row->start))
                                            }} </td>
                                        <td style="display:none;">
                                            @endif

                                            @endif
                                            @if(date('H:i', strtotime($row->start)) != date('H:i',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == '00:00')
                                        <td> {{ date('d.m.Y', strtotime($row->start)) }} </td>
                                        @else
                                        <td> {{ date('d.m.Y - H:i', strtotime($row->start)) }} </td>
                                        @endif

                                        @if(date('H:i', strtotime($row->end)) == '00:00')
                                        <td> {{ date('d.m.Y', strtotime($row->end)) }} </td>
                                        @else
                                        <td> {{ date('H:i', strtotime($row->end)) }} </td>
                                        @endif
                                        @endif
                                        @endif


                                    </tr>
                                    @endforeach
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
                                        {{ __('Termin Vorschau') }}
                                    </h2>
                                </div>
                                <div class="col-auto home-card-preview-header-col">
                                    <div class="invisible" data-refresh-icon>
                                        <div class="spinner-grow" role="status">
                                            <span class="visually-hidden">{{ __('Laden...') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="refresh-title-preview" data-refresh>
                                <h2 class="header-secondary home-card-preview-header-title">
                                    {{ $preview->value }}
                                    @if($preview->unit == 'week')
                                    {{ __('Woche(n)') }}
                                    @endif
                                    @if($preview->unit == 'days')
                                    {{ __('Tage') }}
                                    @endif
                                </h2>
                            </div>
                        </nav>
                    </div>
                    <div class="card-body home-card-preview-body" id="refresh-card-preview" data-refresh>
                        <div class="table-responsive">
                            <table class="table table-striped home-card-preview-table">
                                <thead class="home-card-preview-table-head">
                                    <tr>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            {{ __('Termin') }}
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            {{ __('Gruppe(n)') }}
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            {{ __('Raum') }}
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            {{ __('Von') }}
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            {{ __('Bis') }}
                                        </th>
                                        <th scope="col" class="home-card-preview-table-head-item">
                                            {{ __('In') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="home-card-preview-table-body">

                                    @forEach($future as $row)
                                    @if($row->not_applicable == 1)
                                    <tr class="table-danger strikethrough">
                                        @else
                                    <tr>
                                        @endif
                                        <td>
                                            {{ $row->event }}
                                        </td>
                                        <td>
                                            @foreach(explode(';', $row->team) as $group)
                                            @forEach($groups as $get_color)
                                            @if($get_color->alias == $group)
                                            <span class="badge rounded-pill text-dark"
                                                style="background-color:{{ $get_color->color }};">

                                                {{ $group }}
                                            </span>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $row->room }}
                                        </td>
                                        @if(date('d.m.Y', strtotime($row->start)) != date('d.m.Y',
                                        strtotime($row->end)))

                                        @if(date('H:i', strtotime($row->start)) == '00:00')
                                        <td> {{ date('d.m.Y', strtotime($row->start)) }} </td>
                                        @else
                                        <td> {{ date('d.m.Y - H:i', strtotime($row->start)) }} </td>
                                        @endif

                                        @if(date('H:i', strtotime($row->end)) == '00:00')
                                        <td> {{ date('d.m.Y ', strtotime($row->end)) }} </td>
                                        @else
                                        <td> {{ date('d.m.Y - H:i', strtotime($row->end))}} </td>
                                        @endif

                                        @endif
                                        @if(date('d.m.Y', strtotime($row->start)) == date('d.m.Y',
                                        strtotime($row->end)))

                                        @if(date('H:i', strtotime($row->start)) == date('H:i',
                                        strtotime($row->end)))

                                        @if(date('H:i', strtotime($row->start)) == '00:00')
                                        <td colspan="2"> {{ date('d.m.Y ', strtotime($row->start)) }}
                                        </td>
                                        <td style="display:none;">
                                            @else
                                        <td colspan="2"> {{ date('d.m.Y - H:i', strtotime($row->start))
                                            }} </td>
                                        <td style="display:none;">
                                            @endif

                                            @endif
                                            @if(date('H:i', strtotime($row->start)) != date('H:i',
                                            strtotime($row->end)))

                                            @if(date('H:i', strtotime($row->start)) == '00:00')
                                        <td> {{ date('d.m.Y', strtotime($row->start)) }} </td>
                                        @else
                                        <td> {{ date('d.m.Y - H:i', strtotime($row->start)) }} </td>
                                        @endif

                                        @if(date('H:i', strtotime($row->end)) == '00:00')
                                        <td> {{ date('d.m.Y', strtotime($row->end)) }} </td>
                                        @else
                                        <td> {{ date('H:i', strtotime($row->end)) }} </td>
                                        @endif
                                        @endif
                                        @endif

                                        <td>
                                            {{ abs(strtotime(strftime('%Y-%m-%d', strtotime($row->start))) -
                                            strtotime(date("Y-m-d"))) / 60 / 60 / 24 }}
                                            {{ __('Tagen') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </article>
        <!-- Login Modal -->
        <div class="modal fade" id="modal_login" tabindex="-1" aria-labelledby="modal_login_Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_login_Label"> {{ __('Login') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row g-3 justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <input id="email" type="text"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" placeholder="{{ __('Email') }}" required
                                            autocomplete="email" autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="email">
                                            {{ __('Email Address/Name') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="{{ __('Passwort') }}">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="password">
                                            {{ __('Passwort') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input-green" type="checkbox"
                                            name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                {{ __('Schließen') }}
                            </button>
                            <button type="submit" class="btn btn-outline-success" name="login">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
        <!-- Jquery -->
        <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>
        <script>
            setInterval(function() {
            refresh_loop();
          }, 15 * 1000);
          function refresh_loop() {
            $('[data-refresh-icon]').each(function(index, element) {
              $(element).removeClass("invisible");
              $(element).addClass("visible");
            //   $(element).classList.toggle("invisible");
            //   $(element).classList.toggle("visible");
            });
            $('[data-refresh]').each(function(index, element) {
              $(element).load(window.location.href + " #" + this.id + " > *");
            });
            setTimeout(function() {
              $('[data-refresh-icon]').each(function(index, element) {
                $(element).removeClass("visible");
                $(element).addClass("invisible");
              });
            }, 1 * {{ $refresh->value * 1000 }});
            console.log(Date.now() + ' Content  Refreshed!');
          }
        </script>
        <script>
            show_clock();
        function show_clock(){
        const days = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];
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
        </script>

</body>

</html>
