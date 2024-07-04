<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Inclusion de Font Awesome -->
    <style>
        body {
            overflow-x: hidden; /* Empêche le défilement horizontal */
        }
        .banniere {
            height: 70vh;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }
        .banniere img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintient le ratio de l'image et la centre */
        }
        .card-no-border {
            border: none; /* Supprime la bordure de la carte */
        }
        .btn-reserver {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-light {
            background-color: #FF8200;
            color: #fff;
            border: none;

        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-item i {
            margin-right: 10px;
        }
        .association-info {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .association-info img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .text-danger {
            background: #fff;
            padding: 10px;
            border-radius: 6px;
        }
        .card-association {
            display: flex;
            align-items: center;
            margin-top: 20px;
            border: none; /* Supprime la bordure de la carte */
        }
        .card-association .card-img-top {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card-association .card-body {
            padding-left: 20px;
        }
        .badge.orange {
            background-color: #fce6ce;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .body_detail {
            display: flex;
            flex-direction: column;
        }
        .btn-dark{
            background: transparent;
            color: #FF8200;
            border: none;
            
        }
        @media (max-width: 767px) {
            .banniere {
                height: 40vh; /* Diminuer la hauteur de la bannière pour les petits écrans */
            }
            .btn-reserver {
                bottom: 10px;
            }
        }
        @media (min-width: 768px) {
            .body_detail {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>
    @include('components.headerEvenement')
    
    <div class="container mt-4">
        <!-- Bouton Retour -->
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="btn btn-dark">Retour</a>
        </div>
        
        <!-- Afficher le message de succès -->
        @if(session('reservation_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('reservation_success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <!-- Afficher les messages d'erreur -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        <div class="card mb-3 card-no-border">
            <div class="banniere">
                <img src="{{ Storage::url($evenement->image) }}" alt="Banner Image">
                <div class="btn-reserver rounded-pill d-flex flex-column flex-md-row">
                    @if($remaining_places > 0)
                    <form id="reservationForm" action="{{ route('evenement.reserver', $evenement->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light rounded-pill px-4 mr-2">Réserver</button>
                    </form>
                    @else
                    <p class="text-danger">Aucune place disponible</p>
                    @endif
                </div>
            </div>
            <div>
                <div class="body_detail">
                    <div class="card-body">
                        <h1>{{ $evenement->name }}</h1>
                        <p>{{ $evenement->description }}</p>
                        <div class="info-item">
                            <i class="fas fa-users" style="color: #FF8200"></i> <strong>Places disponibles :</strong> {{ $remaining_places }}
                        </div>
                        <div class="info-item">
                            <i class="far fa-calendar-alt" style="color: #FF8200"></i> <strong>Date :</strong>du  {{ $evenement->event_start_date }} au {{ $evenement->event_end_date }}
                        </div>

                        <div class="info-item">
                            <i class="fas fa-map-marker-alt" style="color: #FF8200"></i> <strong>Lieu :</strong> {{ $evenement->location }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-association">
                                <img src="{{ Storage::url($evenement->user->logo) }}" class="card-img-top" alt="association Logo">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $evenement->user->name }}</h5>
                                    <p class="card-text">{{ $evenement->user->description }}</p>
                                    <button class="badge orange">{{ $evenement->user->email }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>
</html>
