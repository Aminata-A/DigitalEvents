<!-- resources/views/components/header.blade.php -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">DigitalEvents</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('evenement') }}">Accueil</a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Événement
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('evenement') }}">Événement</a>
                        <a class="dropdown-item" href="{{ route('creation') }}">Création d'Événement</a>
                        <a class="dropdown-item" href="{{ route('mes-evenements') }}">Mes Événements</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Déconnexion</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                </li>
                @endauth
            </ul>
            <!-- Affichage de l'utilisateur connecté -->
            @auth
            <span class="navbar-text">
                Connecté en tant que: {{ Auth::user()->name }}
            </span>
            @endauth
        </div>
    </nav>
</header>
