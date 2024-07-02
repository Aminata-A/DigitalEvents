<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Inclusion de Font Awesome -->
    <style>
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
            left: 10%;
            transform: translateX(-50%);
            /* background-color: #fff; Arrière-plan blanc semi-transparent */
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-light {
            background-color: #fff; 
            color: #FF8200;
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
    </style>
</head>
<body>
    @include('components.headerEvenement')
    
    <div class="container mt-4">
        <div class="card mb-3 card-no-border">
            <div class="banniere">
                <img src="{{ Storage::url($evenement->image) }}" alt="Banner Image">
                <div class="btn-reserver rounded-pill">
                    @if($remaining_places > 0)
                    <form action="{{ route('evenement.reserver', $evenement->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light rounded-pill px-4">Réserver</button>
                    </form>
                    @else
                    <p class="text-danger">Aucune place disponible</p>
                    @endif
                </div>
            </div>
            <div class="">
                <h1>{{ $evenement->name }}</h1>
            </div>
            <div class="card-body">
                <div class="info-item">
                    <i class="fas fa-users"></i> <strong>Places disponibles :</strong> {{ $remaining_places }}
                </div>
                <div class="info-item">
                    <i class="far fa-calendar-alt"></i> <strong>Date de début :</strong> {{ $evenement->event_start_date }}
                </div>
                <div class="info-item">
                    <i class="far fa-calendar-alt"></i> <strong>Date de fin :</strong> {{ $evenement->event_end_date }}
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i> <strong>Lieu :</strong> {{ $evenement->location }}
                </div>
                <div class="association-info">
                    <img src="{{ Storage::url($evenement->association->logo) }}" alt="Association Logo">
                    <div>
                        <p>Organisé par {{ $evenement->association->name }}</p>
                        <p>{{ $evenement->association->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
