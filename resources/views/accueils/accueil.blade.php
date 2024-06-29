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
        .banniere div{
            z-index: 1;
        }        
        .banniere a{
            color: #FF8200
        }        
        .banniere a:hover{
            color: #FF8200
        }
        .banniere h1 {
            font-size: 45px;
        }
        .card {
            height: 300px;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-img-top {
            height: 150px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
        }
        .card-text {
            flex-grow: 1;
            margin-bottom: 15px;
        }
        .card-footer {
            background-color: #FFF3E6;
            border-top: 1px solid rgba(0,0,0,0.125);
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-details {
            background-color: #FF8200;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
        }
        .btn-details:disabled {
            background-color: grey;
        }
        .badge-places {
            background-color: #FF8200;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
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
        @media (min-width: 768px) { 
            .card-columns {
                column-count: 3;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="banniere">
            <img src="https://img.freepik.com/vecteurs-libre/modele-sans-couture-lignes-organiques-irregulieres-orange_1409-4190.jpg?t=st=1719417420~exp=1719421020~hmac=e0da1aea7e251917a9394925bb9a5f1211ffe8353400c44f56ff1a9f0c86ebf8&w=826" alt="Banner Image">
            <div>
                <h1>Nos événements</h1>
                <a href="#" class="btn btn-light rounded-pill px-3">Bouton</a>
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
                        <button type="submit" class="btn btn-primary rounded-pill px-3 mt-2">Filtrer</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card-columns">
                    @foreach($evenements as $evenement)
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('storage/' . $evenement->image) }}" alt="{{ $evenement->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $evenement->name }}</h5>
                            <p class="card-text">{{ $evenement->description }}</p>
                        </div>
                        <div class="card-footer">
                            <span class="badge-places">Places restantes: {{ $evenement->remaining_places }}</span>
                            <a href="#" class="btn btn-details" @if($evenement->remaining_places == 0) disabled @endif>Réserver</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
