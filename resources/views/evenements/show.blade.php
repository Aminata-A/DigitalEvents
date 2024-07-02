<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'événement</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        .banner {
            background-size: cover;
            background-position: center;
            padding: 70px 0;
            text-align: center;
            margin-bottom: 20px;
            margin-left: 100px;
            margin-right: 100px;
        }

        .banner img {
            width: 100%;
            height: auto;
            max-height: 400px; /* Hauteur maximale ajustable selon vos besoins */
            object-fit: cover;
            border-radius: 10px;
        }
        .banner-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
        }
        .container-details {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 20px;
            margin-right: 100px;
        }
        .evenement-details {
            width: 70%; /* Largeur ajustable selon vos besoins */
            margin-right: 20px; /* Marge à droite pour séparer des réservations */
            align-content: center;
            justify-content: center;
        }
        .reservation-list {
            width: 70%; /* Largeur ajustable selon vos besoins */
            max-width: 600px; /* Largeur maximale du tableau des réservations */
            padding-top: 40px;
            margin-left: 100px;
        }
        .reservation-list table {
            width: 100%;
        }
        .details-icons {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 10px;
        }
        .icon-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .icon-item i {
            margin-right: 5px;
            color: darkorange; /* Couleur des icônes en orange */
        }
        .btn-orange {
            background-color: darkorange;
            border-color: darkorange;
            color: white;
        }
        .btn-orange:hover {
            background-color: darkorange;
            border-color: darkorange;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Bannière avec image -->
    <div class="banner">
        <img src="{{ asset('images/Rectangle_6.png') }}" class="img-fluid rounded-start event-img" alt="Image Événement">
    </div>

    <div class="container">
        <a href="#" class="btn btn-orange mt-3">Retour</a>
        <div class="container-details">
            <div class="evenement-details">
                <!-- Détails de l'événement -->
                <h2>TITRE 1{{ $evenement->title }}</h2>
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Assumenda aperiam adipisci corporis! Id quisquam voluptatibus
                    aspernatur soluta saepe pariatur consequatur fugiat animi,
                    eligendi laborum fugit impedit ut quae ea expedita.
                    {{ $evenement->description }}
                </p>
                <div class="details-icons">
                    <div class="icon-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $evenement->location }}</span>
                    </div>
                    <div class="icon-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>{{ $evenement->phone }}</span>
                    </div>
                    <div class="icon-item">
                        <i class="far fa-calendar-alt"></i>
                        <span>{{ $evenement->event_start_date }}</span>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="reservation-list">
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Liste des réservations</h3>
                    <a href="#" class="btn btn-orange">Voir</a>
                  </div>

                  <div class="flex-container">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nom complet</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Boucle pour afficher les réservations -->
                        @foreach($reservations as $reservation)
                        <tr>
                          <td>{{ $reservation->full_name }}</td>
                          <td>
                            <a href="#" class="btn btn-danger">décliné</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript et dépendances -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
