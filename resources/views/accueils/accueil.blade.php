<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - DigitalEvents</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .navbar-brand {
            font-weight: bold;
            color: #333; /* Couleur du texte du logo */
        }
        .banner {
            background-image: url('{{ asset('img/vert_minimaliste_evenement_printemps_banniere_1.png') }}'); /* Chemin vers votre image de bannière */
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            text-align: center;
            color: #fff; /* Couleur du texte sur l'image */
        }
        .banner h1 {
            font-size: 48px;
            font-weight: bold;
        }
        .banner p {
            font-size: 24px;
        }
        .events {
            padding: 40px 0;
            display: flex;
            flex-wrap: wrap;
        }
        .events h2 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .event-img {
            height: 187px;
            object-fit: cover;
            width: 1500px;
            padding-bottom: 5px;

        }
        .card-event {
            flex: 1 0 30%;
            margin: 10px;

        }

        .card-text.description {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .card {
            width: 100%;

        }
        .events .cards-container {
            display: flex;
            flex-wrap: wrap; /* Ajustez cette ligne pour empêcher les cartes de passer à la ligne suivante */
            justify-content: space-between; /* Ajoutez de l'espace entre les cartes */
            /* overflow-x: auto; Ajoutez cette ligne pour permettre le défilement horizontal si nécessaire */
        }



        .types-section {
            margin-top: 50px;
            padding: 50px 0;

        }

        .types-section .content {
            display: flex;
            flex-wrap: wrap;

            align-items: center;
            justify-content: center;
        }

        .types-section .content .image {
            flex: 1;
            padding-right: 20px;
        }

        .types-section .content .text {
            flex: 1;
            padding-left: 20px;
        }


        .types-section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .text h2 {
            padding-top: 100px;
        }
@media (max-width: 768px) {
    .types-section .content {
        flex-direction: column; /* Passer à la disposition en colonne pour les petits écrans */
    }

    .types-section .image, .types-section .text {
        flex-basis: 100%; /* Les éléments prennent toute la largeur disponible en mode colonne */
        margin-bottom: 20px; /* Espacement entre les éléments en mode colonne */
    }
}

    </style>
</head>
<body>

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


    <!-- Banner -->
    <div class="banner">
        <div class="container-fluid">
            <img src="{{ asset('images/Vert_Minimaliste.png') }}" alt="Bannière" class="img-fluid">
        </div>
    </div>

    <!-- À propos de nous -->
    <div class="about-us">
        <div class="container">
            <h2>À propos de nous</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fermentum massa eu dolor varius, et semper lectus aliquam. Nulla tincidunt mauris sit amet erat pretium, sit amet lobortis urna tincidunt. Nulla facilisi.
            Integer volutpat dignissim lectus, ac dapibus lorem euismod ut. Vestibulum eu magna ac velit condimentum posuere. Vivamus sagittis nisi non risus commodo, a consectetur felis malesuada.
            Integer volutpat dignissim lectus, ac dapibus lorem euismod ut. Vestibulum eu magna ac velit condimentum posuere. Vivamus sagittis nisi non risus commodo, a consectetur felis malesuada
            Integer volutpat dignissim lectus, ac dapibus lorem euismod ut. Vestibulum eu magna ac velit condimentum posuere. Vivamus sagittis nisi non risus commodo, a consectetur felis malesuada
            Integer volutpat dignissim lectus, ac dapibus lorem euismod ut. Vestibulum eu magna ac velit condimentum posuere. Vivamus sagittis nisi non risus commodo, a consectetur felis malesuada
        </p>
        </div>
    </div>
<!-- Événements à venir -->
<div class="events">
    <div class="container">
        <h2>Événements à venir</h2>
        <div class="cards-container">
            @foreach ($evenements as $evenement)
            <div class="card-event">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('images/Rectangle_6.png') }}" class="img-fluid rounded-start event-img" alt="Image Événement">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $evenement->name }}</h5>
                                <p class="card-text description">
                                    {{ Str::limit($evenement->description, 150) }}
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">Dernière mise à jour: {{ $evenement->updated_at->diffForHumans() }}</small>
                                </p>
                                <a href="{{ route('evenements.show', ['id' => $evenement->id]) }}" class="btn btn-primary">Voir plus</a>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            @endforeach
        </div>
    </div>
</div>



</div>
<!-- Nos types d'événements Section -->
<section class="types-section">
    <div class="container">
        <h2 class="text">Nos types d'événements</h2>
        <div class="content">
            <div class="image">
                <img src="{{ asset('images/image_22.png') }}" class="img-fluid rounded-start event-img" alt="Type d'événement">
            </div>
            <div class="text">
                <h3>Evénements corporatifs</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="text">
                <h3>Evénements sportifs</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
            </div>
            <div class="image">
                <img src="{{ asset('images/image_23.png') }}" class="img-fluid rounded-start event-img" alt="Type d'événement">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="image">
                <img src="{{ asset('images/image_24.png') }}" class="img-fluid rounded-start event-img" alt="Type d'événement">
            </div>
            <div class="text">
                <h3>Evénements salons et expositions</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.</p>
            </div>
        </div>
    </div>
</section>
<!-- Nos partenaires -->
<section class="partners-section">
    <div class="container">
        <h2>Nos Partenaires</h2>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <img src="{{ asset('images/image 25.png') }}" class="img-fluid partner-logo" alt="Partenaire 1">
            </div>
            <div class="col-md-3 col-sm-6">
                <img src="{{ asset('images/image 26.png') }}" class="img-fluid partner-logo" alt="Partenaire 2">
            </div>
            <div class="col-md-3 col-sm-6">
                <img src="{{ asset('images/image 27.png') }}" class="img-fluid partner-logo" alt="Partenaire 3">
            </div>
            <div class="col-md-3 col-sm-6">
                <img src="{{ asset('images/image 28.png') }}" class="img-fluid partner-logo" alt="Partenaire 4">
            </div>

        </div>

    </div>
</section>

    <!-- Bootstrap JavaScript et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
