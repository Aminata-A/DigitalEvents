<!DOCTYPE html>
<html>
<head>
    <title>Evenements</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            width: 100%;
            overflow-x: hidden;
        }
        .banniere {
            width: 100%;
            height: 70vh;
            margin: 0 auto;
            background: #FF8200;
            border-radius: 20px;
            position: relative;
            text-align: center;
            padding: 20px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .banniere img {
            position: absolute;
            right: 0;
            top: 0;
            width: 50%;
            height: 100%;
            object-fit: cover;
            opacity: 0.5;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;
        }
        .banniere h1 {
            z-index: 1;
            font-size: 45px;
        }
        .card {
            height: 250px; /* Ajustez cette valeur selon vos besoins */
            overflow: hidden;
            padding: 10px;
            border: 1px solid black 10%;
            border-radius: 10px;
        }
        .card-img {
            height: 100%;
            border-radius: 10px;
            object-fit: cover; /* Assure que l'image couvre toute la zone sans distorsion */
        }
        .card-body {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Nombre de lignes à afficher */
            -webkit-box-orient: vertical;
        }
        button {
            border: none;
        }
        .orange {
            background-color: #FFF3E6;
        }
        .filter-sidebar {
            position: sticky;
            top: 20px;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary{
            background-color: #FF8200;
            border: #FF8200;
        }
        
    </style>
</head>
<body>
    <h1>COUCOU</h1>
    <div class="container mt-4">
        <div class="banniere">
            <img src="https://img.freepik.com/vecteurs-libre/modele-sans-couture-lignes-organiques-irregulieres-orange_1409-4190.jpg?t=st=1719417420~exp=1719421020~hmac=e0da1aea7e251917a9394925bb9a5f1211ffe8353400c44f56ff1a9f0c86ebf8&w=826" alt="Banner Image">
            <div>
            <h1>Nos événements</h1>
            <a href="#" class="btn btn-secondary rounded-pill px-3">Boutton</a>
            <a href="#" class="btn btn-secondary rounded-pill px-3">Boutton</a>
        </div>

        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="filter-sidebar">
                    <h5>Filtrer par activité</h5>
                    <form method="GET" action="{{ route('evenements.index') }}">
                        <div class="form-group">
                            <label for="activity_area">Sélectionner une activité</label>
                            <select class="form-control" id="activity_area" name="activity_area">
                                {{-- @foreach($activity_areas as $activity_area)
                                    <option value="{{ $activity_area }}">{{ $activity_area }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-3 mt-2">Filtrer</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($evenements as $evenement)
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="row no-gutters h-100">
                                    <div class="col-4">
                                        <img src="https://as1.ftcdn.net/v2/jpg/07/48/41/86/1000_F_748418612_srgfdPj71sfzl2luy4l73VgkKc3yUGku.jpg" class="card-img" alt="Event Image">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <button class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill mb-2">{{ $evenement->user->activity_area }}</button>
                                            <h5 class="card-title">{{ $evenement->name }}</h5>
                                            <p class="card-text">{{ $evenement->description }}</p>
                                            <div class="d-flex justify-content-between">
                                                <button class="badge bg-secondary-subtle text-secondary-emphasis rounded-pill mb-2 orange">{{ $evenement->places }} pls</button>
                                                <button class="badge bg-warning-subtle text-secondary-emphasis rounded-pill mb-2">Voir Détails</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
