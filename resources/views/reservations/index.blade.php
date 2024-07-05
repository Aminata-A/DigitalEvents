<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-title {
            font-size: 1.5rem;
            color: #FF8200;
        }
        .card-text {
            font-size: 1rem;
        }
        .header {
            background-color: #FF8200;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
        }
        .container {
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #FF8200;
            border-color: #FF8200;
        }
        .btn-primary:hover {
            background-color: #FF8200;
            border-color: #FF8200;
        }
    </style>
</head>
<body>

@include('components.headerEvenement')

<div class="header">
    <h1>Mes Réservations</h1>
</div>

<div class="container">
    @foreach($reservations as $reservation)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $reservation->evenement->name }}</h5>
                <p class="card-text">{{ $reservation->evenement->description }}</p>
                <p class="card-text"><i class="fas fa-calendar-alt"></i> Date: {{ $reservation->evenement->event_start_date }}</p>
                <p class="card-text"><i class="fas fa-map-marker-alt"></i> Lieu: {{ $reservation->evenement->location }}</p>
                <p class="card-text"><i class="fas fa-info-circle"></i> Status: {{ $reservation->status }}</p>
                <!-- Ajoutez d'autres détails de l'événement selon vos besoins -->
                <a href="{{ route('evenements.show', ['id' => $reservation->evenement->id]) }}" class="btn btn-primary"><i class="fas fa-info-circle"></i> Voir Détails</a>
            </div>
        </div>
    @endforeach
</div>

@include('components.footer')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
