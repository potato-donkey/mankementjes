    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a href="/" class="navbar-brand primary"><i class="bi bi-tools"></i>&nbsp;Mankementjes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item"><a href="/mankement-melden" class="nav-link">Melden</a></li>
                    @endauth

                    <li class="nav-item"><a href="/archief" class="nav-link">Archief</a></li>
                </ul>
                @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ms-auto"><a href="/me" class="nav-link">Ik&nbsp;<i class="bi bi-person-circle"></i></a></li>
                </ul>
                @endauth
                
                @guest
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item ms-auto"><a href="/login" class="nav-link">Inloggen</a></li>
                </ul>
                @endguest
            </div>
        </div>
    </nav>