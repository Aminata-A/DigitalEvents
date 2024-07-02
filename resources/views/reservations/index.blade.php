
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Inclusion de Font Awesome -->
<body>
    
@include('components.headerEvenement')

{{-- @section('content') --}}
<div class="container">
    <h1>Mes Réservations</h1>

    @foreach($reservations as $reservation)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $reservation->evenement->name }}</h5>
                <p class="card-text">{{ $reservation->evenement->description }}</p>
                <p class="card-text">Date: {{ $reservation->evenement->event_start_date }}</p>
                <p class="card-text">Lieu: {{ $reservation->evenement->location }}</p>
                <p class="card-text">Status: {{ $reservation->status }}</p>
                <!-- Ajoutez d'autres détails de l'événement selon vos besoins -->
            </div>
        </div>
    @endforeach
</div>
</body>

{{-- @endsection --}}
