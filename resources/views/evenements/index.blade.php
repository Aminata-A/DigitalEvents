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
    </style>
</head>

<body>
    @include('components.headerEvenement')
    
    <div class="container mt-4">
        <div class="banniere">
            <img src="https://img.freepik.com/vecteurs-libre/modele-sans-couture-lignes-organiques-irregulieres-orange_1409-4190.jpg?t=st=1719417420~exp=1719421020~hmac=e0da1aea7e251917a9394925bb9a5f1211ffe8353400c44f56ff1a9f0c86ebf8&w=826" alt="Banner Image">
            <div>
                <h1>Nos événements</h1>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-3 ">
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
                        <button type="submit" class="btn btn-light rounded-pill px-3 mt-2" style="background-color: #FF8200; color: #fff">Filtrer</button>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($evenements as $evenement)
                    <div class="col-md-4 mb-4">
                        <div class="card mb-4">
                            <img src="{{ Storage::url($evenement->image) }}" class="card-img-top" alt="Event Image">
                            <span class="activity-badge">{{ $evenement->user->activity_area }}</span>
                            <div class="card-body">
                                <h5 class="card-title">{{ $evenement->name }}</h5>
                                <p class="card-text">{{ $evenement->description }}</p>
                                <div class="d-flex justify-content-between">
                                    <button class="badge orange">{{ $evenement->places }} places</button>
                                    
                                    <a href="{{ route('evenements.show', ['id' => $evenement->hash_id]) }}" class="badge text-dark">Voir Détails</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>
    @include('components.footer')
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
