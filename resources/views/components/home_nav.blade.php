<button class="btn btn-lg btn_hidden btn_menu" type="button" href="?b=events" data-bs-toggle="offcanvas"
    data-bs-target="#home-offcanvasTop" aria-controls="home-offcanvasTop">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="offcanvas offcanvas-start home-offcanvas" tabindex="-1" id="home-offcanvasTop"
    aria-labelledby="home-offcanvasTopLabel">
    <div class="offcanvas-header">
        <h4 id="home-offcanvasTopLabel">
            {{ __('Navigation') }}
        </h4>
        <button type="button" class="btn-close text-reset home-offcanvas-close" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body home-offcanvas-body">
        @if (Route::has('login'))
        @auth
        <div class="mb-3">
            <a href="{{ url('/home') }}" class="btn btn-outline-secondary home-offcanvas-body-link w-100">
                <span class="btn-label"><i class="bi bi-house-door"></i></span>
                {{ __('Home') }}
            </a>
        </div>
        <div class="btn-group-vertical w-100" role="group">
            <div class="btn-group-vertical w-100" role="group">
                <a href="{{ url('/events') }}" type="button" class="btn btn-outline-secondary home-offcanvas-body-link">
                    <span class="btn-label"><i class="bi bi-calendar"></i></span>
                    {{ __('Termine') }}
                </a>
                <li class="home-offcanvas-body-second-link">
                    <a href="{{ url('/events') }}" type="button"
                        class="btn btn-outline-secondary home-offcanvas-body-link home-offcanvas-body-second-link">
                        <span class="btn-label"><i class="bi bi-plus-lg"></i></span>
                        {{ __('Hinzufügen') }}
                    </a>
                </li>
                <li class="home-offcanvas-body-second-link">
                    <a href="{{ url('/events') }}" type="button"
                        class="btn btn-outline-secondary home-offcanvas-body-link home-offcanvas-body-second-link">
                        <span class="btn-label"><i class="bi bi-list"></i></span>
                        {{ __('Auflistung') }}
                    </a>
                </li>
            </div>
            <div class="btn-group-vertical w-100" role="group">
                <a href="?b=groups" type="button" class="btn btn-outline-secondary home-offcanvas-body-link"><span
                        class="btn-label"><i class="bi bi-people"></i></span>
                    {{ __('Gruppen') }}
                </a>
                <li class="home-offcanvas-body-second-link">
                    <a href="{{ url('/events') }}" type="button"
                        class="btn btn-outline-secondary home-offcanvas-body-link home-offcanvas-body-second-link">
                        <span class="btn-label"><i class="bi bi-plus-lg"></i></span>
                        {{ __('Hinzufügen') }}
                    </a>
                </li>
                <li class="home-offcanvas-body-second-link">
                    <a href="{{ url('/events') }}" type="button"
                        class="btn btn-outline-secondary home-offcanvas-body-link home-offcanvas-body-second-link">
                        <span class="btn-label"><i class="bi bi-person-lines-fill"></i></span>
                        {{ __('Auflistung') }}
                    </a>
                </li>
            </div>
            <a href="{{ route('settings') }}" type="button" class="btn btn-outline-secondary home-offcanvas-body-link">
                <span class="btn-label"><i class="bi bi-gear"></i></span>
                {{ __('Einstellungen') }}
            </a>
        </div>
        <div class="mt-3">
            <a type="button" class="btn btn-outline-danger w-100" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        @else
        <button type="button" class="btn btn-outline-success w-100" data-bs-dismiss="offcanvas" data-bs-toggle="modal"
            data-bs-target="#modal_login">
            {{ __('Login') }}
        </button>
        @endauth
        @endif
    </div>
</div>
