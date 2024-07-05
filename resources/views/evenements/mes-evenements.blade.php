<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('evenements/evenements.css') }}" />
    <style>
        .card {
            height: 100%;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-img-top {
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-text {
            flex-grow: 1;
        }

        .card-link {
            color: #051D30;
            text-decoration: none;
        }

        .card-link:hover {
            color: #051D30;
            text-decoration: none;
        }

        /* Style pour le badge d'activité */
        .activity-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 5px;

        }
    </style>
</head>
<body>
    @include('components.headerEvenement')
    <div class="container mt-4">
        <div class="banniere">
            <img src="https://img.freepik.com/vecteurs-libre/modele-sans-couture-lignes-organiques-irregulieres-orange_1409-4190.jpg?t=st=1719417420~exp=1719421020~hmac=e0da1aea7e251917a9394925bb9a5f1211ffe8353400c44f56ff1a9f0c86ebf8&w=826" alt="Banner Image">
            <div>
                <h1>Mes Événements</h1>
            </div>
        </div>
        <div class="row mt-4">
            @foreach($evenements as $evenement)
                <div class="col-md-3 pb-4">
                    <a href="{{ route('evenements.show', ['id' => $evenement->hash_id]) }}" class="card-link">
                        <div class="card">
                            <img src="{{ Storage::url($evenement->image) }}" class="card-img-top" alt="Event Image">
                            <span class="activity-badge">{{ $evenement->user->activity_area }}</span>
                            <div class="card-body">
                                <h5 class="card-title">{{ $evenement->name }}</h5>
                                <p class="card-text">{{ $evenement->description }}</p>
                                <div class="d-flex justify-content-between">
                                    <button class="badge orange">{{ $evenement->places }} places</button>
                                    <form action="{{ route('supprimer', $evenement->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger badge" style="background: red" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement ?');">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @include('components.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
