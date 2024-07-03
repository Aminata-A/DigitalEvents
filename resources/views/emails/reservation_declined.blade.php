<!-- resources/views/emails/reservation_declined.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Réservation déclinée</title>
</head>
<body>
    
    <h1>Votre réservation a été déclinée</h1>
    <p>Bonjour {{ $reservation->user->name }},</p>
    <p>Votre réservation pour l'événement {{ $reservation->evenement->name }} a été déclinée.</p>
    <p>Merci de votre compréhension.</p>
</body>
</html>
