<!-- resources/views/emails/reservation_declined.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Réservation acceptée</title>
</head>
<body>

    <h1>Votre réservation a été acceptée</h1>
    <p>Bonjour {{ $reservation->user->name }},</p>
    <p>Votre réservation pour l'événement {{ $reservation->evenement->name }} a été acceptée.</p>
    <p>Merci pour votre participation.</p>
</body>
</html>
