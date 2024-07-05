<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des participants</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #fff;
            color: #051d30;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h2 {
            color: #FF9B33;
            text-align: center;
            font-size: 20px
        }
    </style>
</head>
<body>
    <div>
        <p>Organisme : {{ $evenement->user->name }}</p>
        <p>Lieu : {{ $evenement->location }}</p>
        <p>Date : ...../...../.......</p>
        
    </div>
    <h2>Liste des réservations pour l'événement {{ $evenement->name }}</h2>
    <h4>Liste des participants</h4>
    

    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Signature</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $reservation->first_name }}</td>
                    <td>{{ $reservation->last_name }}</td>
                    <td>{{ $reservation->email }}</td>
                    <td>{{ $reservation->phone }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>
