<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            width: 100%;
            overflow-x: hidden;
        }
        .banniere {
            height: 70vh;
            background: #FF8200;
            border-radius: 20px;
            position: relative;
            text-align: center;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
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
        .banniere div {
            z-index: 1;
        }
        .banniere a {
            color: #FF8200;
        }
        .banniere a:hover {
            color: #FF8200;
        }
        .banniere h1 {
            font-size: 45px;
        }
        .card {
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.8rem;
            margin-bottom: 30px;
        }
        .card-img-top {
            border-radius: 0.8rem  0.8rem 0 0;

            height: 150px;
            width: 100%;
            object-fit: cover;
        }
        .activity-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: rgba(255, 255, 255, 0.8);
            color: #051D30;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1rem;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .badge {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 10rem;
            border: none;
        }
        .orange {
            background-color: #FFF3E6;
            /* color: white; */
        }
        
        .btn-light {
            background-color: #f8f9fa;
            color: #212529;
        }
        .btn-light:hover {
            background-color: #e2e6ea;
            color: #212529;
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
        .btn-light{
            background-color: #FF8200;
            border: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="banniere">
            <img src="https://img.freepik.com/vecteurs-libre/modele-sans-couture-lignes-organiques-irregulieres-orange_1409-4190.jpg?t=st=1719417420~exp=1719421020~hmac=e0da1aea7e251917a9394925bb9a5f1211ffe8353400c44f56ff1a9f0c86ebf8&w=826" alt="Banner Image">
            <div>
                <h1>Nos événements</h1>
                <a href="{{ route('creation') }}" class="btn btn-light rounded-pill px-3">Creation</a>
                <a href="#" class="btn btn-light rounded-pill px-3">Bouton</a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="filter-sidebar">
                    <h5>Filtrer par activité</h5>
                    <form method="GET" action="{{ route('evenement') }}">
                        <div class="form-group">
                            <label for="activity_area">Sélectionner une activité</label>
                            <select class="form-control" id="activity_area" name="activity_area">
                                @foreach($activity_areas as $activity_area)
                                <option value="{{ $activity_area }}">{{ $activity_area }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-light rounded-pill px-3 mt-2">Filtrer</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($evenements as $evenement)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ Storage::url($evenement->image) }}" class="card-img-top" alt="Event Image">
                            <span class="activity-badge">{{ $evenement->user->activity_area }}</span>
                            <div class="card-body">
                                <h5 class="card-title">{{ $evenement->name }}</h5>
                                <p class="card-text">{{ $evenement->description }}</p>
                                <div class="d-flex justify-content-between">
                                    <button class="badge orange">{{ $evenement->places }} places</button>
                                    <button class="badge  text-dark">Voir Détails</button>
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
