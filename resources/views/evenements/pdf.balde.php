<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </style>
</head>
<body>
    <h2>Liste réservation</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->first_name }}</td>
                    <td>{{ $reservation->last_name }}</td>
                    <td>{{ $reservation->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
