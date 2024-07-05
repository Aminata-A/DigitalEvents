<!-- resources/views/components/header.blade.php -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img class="navbar-brand" src="{{ asset('images/Logo.png') }}" alt="Logo image" width="100px">
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto px-4">
                <li class="nav-item">
                    <a class="nav-link text-black" href="{{ route('accueil') }}" style="color: #051D30;">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-black" href="{{ route('evenement') }}" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #051D30;">
                        Événement
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('evenement') }}">Événement</a>
                        @auth
                            @if (Auth::user()->hasRole('association'))
                                <a class="dropdown-item" href="{{ route('creation') }}">Création d'Événement</a>
                                <a class="dropdown-item" href="{{ route('mes-evenements') }}">Mes Événements</a>
                            @endif
                        @endauth
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-black" href="{{ route('reservations.index') }}" style="color: #051D30;">Reservations</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ route('logout') }}" style="color: #051D30;">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <span class="navbar-text" style="color: #051D30;">
                            {{ Auth::user()->name }}
                        </span>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn rounded-pill mx-3 mb-1" href="{{ route('login') }}" style="background-color: #FF8200; color: white;">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn rounded-pill mx-3" href="{{ route('register') }}" style="background-color: white; color: #FF8200; border: 1px solid #FF8200;">Inscription</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
