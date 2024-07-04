<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/style/style.css') }}" />
    <title>Liste des participants</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional CSS for styling */
        body {
            font-family: "Montserrat", sans-serif;
            background-color: #fff;
            color: #051d30;
        }
        .container {
            padding: 20px;
        }
        .custom-table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        .custom-table th, .custom-table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .custom-table th {
            background-color: #f2f2f2;
        }
        .btn-download {
            background-color: #FF8200;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            float: right;
        }
        .btn-download:hover {
            background-color: #e57200;
            
        }
    </style>
</head>
<body>
    <x-headerEvenement/>
    <div class="container">
        <a target="blank" href="{{ route('evenements.reservations.download', $evenement->hash_id) }}">
            <button class="btn-download">Télécharger</button>
        </a>
        <h2>Liste réservation</h2>
        <table class="custom-table mt-5">
            <thead>
                <tr >
                    <th>id</th>
                    <th>Nom Complet</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
