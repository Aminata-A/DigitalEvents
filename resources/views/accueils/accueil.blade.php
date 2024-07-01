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
        }
        .events h2 {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .event-img {
            height: 300px;
            object-fit: cover;
            width: 700px;

        }
        .card-event {
            flex: 1 0 30%;
            margin: 10px;
        }
        .events .cards-container {
            display: flex;
            flex-wrap: wrap; /* Ajoutez cette ligne si vous voulez permettre aux cartes de passer à la ligne suivante */
            justify-content: space-between; /* Ajoutez de l'espace entre les cartes */
        }
    </style>
</head>
<body>

    <!-- Navbar -->y
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                    <a class="nav-link" href="#">Événements</a>
                    <a class="nav-link" href="#">Réservations</a>
                </div>
            </div>
        </div>
    </nav>

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
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus fermentum massa eu dolor varius, et semper lectus aliquam. Nulla tincidunt mauris sit amet erat pretium, sit amet lobortis urna tincidunt. Nulla facilisi.</p>
            <p>Integer volutpat dignissim lectus, ac dapibus lorem euismod ut. Vestibulum eu magna ac velit condimentum posuere. Vivamus sagittis nisi non risus commodo, a consectetur felis malesuada.</p>
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
                                    <p class="card-text">{{ $evenement->description }}</p>
                                    <p class="card-text"><small class="text-muted">Dernière mise à jour il y a 3 minutes</small></p>
                                    <a href="#" class="btn btn-primary">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

    <!-- Bootstrap JavaScript et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
