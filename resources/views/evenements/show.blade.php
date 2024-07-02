<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('admin/style/style.css') }}" />
    <title>Responsive Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");
        body {
    font-family: "Montserrat", sans-serif;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #fff;
    color: #051d30;
    overflow-x: hidden;
}
        .custom-header img{
            width: 100%;
            background-size: cover;
            height: 40vh;
            position: relative;
            border-radius: 20px;
        }
        .custom-header button {
            position: absolute;
            bottom: 10px;
            left: 10px;
        }
        .custom-section {
            padding: 20px;
        }
        .custom-footer {
            margin-top: 20px;
        }
        .custom-footer img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        .btn-lien {
            color: #FF8200;
            margin-left: -1rem;
        }
        .btn-red {
            border-radius: 10px;
            border: 1px solid #ff0000;
            background: #ff0000;
            color: white
        }
        
    </style>
</head>
<body>
    <x-headerEvenement/>
    <div class="container">
        <div class="custom-header mt-5">
            <img src="{{ Storage::url($evenement->image) }}" class="card-img-top" alt="Event Image">
        </div>
        
        <div class="row mt-4">
            <div class="col-lg-8 col-md-12">
                <a href="{{ route('accueil') }}" class="btn btn-link">Retour</a>
                <h1>{{ $evenement->name }}</h1>
                <p>{{ $evenement->description }}</p>
                <div class="custom-footer">
                    <p><img src="{{ asset('admin/img/location.svg') }}" alt="icone location"> {{ $evenement->location }} </p>
                    <p><img src="{{ asset('admin/img/phone.svg') }}" alt="icone location"> {{ $evenement->user->phone }} </p>
                    <p><img src="{{ asset('admin/img/calendar.svg') }}" alt="icone location"> Du {{ $evenement->event_start_date }} au {{ $evenement->event_end_date }}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <h2>Liste des réservations</h2>
                <table class="table table-bordered" >
                    <thead>
                        <tr>
                            <th>Nom complet</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                        <tr>
                            
                               <td>{{ $reservation->name }}</td> 
                               <td><button class="btn btn-red btn-sm">Décliner</button></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <a href="#" class="btn btn-lien">Voir tous</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
