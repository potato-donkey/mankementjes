    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand secondary"><i class="bi bi-tools"></i>&nbsp;{{ env('APP_NAME') }}</a>
            <button class="navbar-toggler" type="button" id="navbarButton" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="/archief" class="nav-link">Archief</a></li>
                    @auth
                        <li class="nav-item"><a href="/melden" class="nav-link">Melden</a></li>
                    @endauth

                    @auth
                        @if (Auth::user()->id == 0)
                            <li class="nav-item"><a href="/admin" class="nav-link">Administratie</a></li>
                        @endif
                    @endauth
                </ul>
                @auth
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item ms-auto"><a href="/me"
                                class="nav-link @if (Auth::user()->id == 0) {{ 'text-secondary' }} @endif">{{ Auth::user()->name }}&nbsp;<i
                                    class="bi bi-person-circle"></i></a></li>
                    </ul>
                @endauth

                @guest
                    <ul class="navbar-nav ms-md-auto">
                        <li class="nav-item ms-auto"><a href="/me/login" class="btn btn-secondary">Inloggen</a></li>
                    </ul>
                @endguest
            </div>
        </div>
    </nav>

    @if (env('APP_ENV') == 'development')
        <x-alert type="info" message="Development mode" />
    @endif
