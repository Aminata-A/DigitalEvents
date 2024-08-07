<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .image-container {
            height: 110vh;
        }
        .img-fluid {
            height: 112vh;
            width: 35em;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .evenement{
            background-color: #FF8200;
            color: white;
        }        
        .evenement:hover {
            background-color: white;
            color: #FF8200;
            border: solid 1px #FF8200;
            
        }
        .btn-annuler{
            background-color: white;
            color: #FF8200;
            border: solid 1px #FF8200;
        }
        label{
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>

<body>
    @include('components.headerEvenement')
    
    @if (!Auth::user()->hasRole('association'))
    <div class="alert alert-danger mt-4">
        Vous n'avez pas les permissions nécessaires pour créer un événement.
    </div>
    @else
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-5 d-none d-lg-block mt-4 ml-5">
                <img src="{{ asset('images/bienvenue(1).png') }}" alt="Bienvenue" class="img-fluid ">
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="container form-container">
                    <h1 class="">Créer un Événement</h1>
                    @if (Auth::user()->validation_status === 'invalid')
                    <div class="alert alert-danger mt-4">
                        Votre compte n'est pas encore validé. Veuillez patientez.
                    </div>
                    @endif
                    
                    @if (Auth::user()->account_status === 'disabled')
                    <div class="alert alert-danger mt-4">
                        Votre compte est désactivé. Veuillez contacter l'administrateur.
                    </div>
                    @endif
                    <form action="{{ route('creation') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Nom de l'événement</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="event_start_date">Date de début</label>
                                <input type="date" class="form-control @error('event_start_date') is-invalid @enderror" id="event_start_date" name="event_start_date" value="{{ old('event_start_date') }}">
                                @error('event_start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="event_end_date">Date de fin</label>
                                <input type="date" class="form-control @error('event_end_date') is-invalid @enderror" id="event_end_date" name="event_end_date" value="{{ old('event_end_date') }}">
                                @error('event_end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="registration_deadline">Date limite d'inscription</label>
                                <input type="date" class="form-control @error('registration_deadline') is-invalid @enderror" id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline') }}">
                                @error('registration_deadline')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="location">Lieu</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="places">Nombre de places</label>
                                <input type="number" class="form-control @error('places') is-invalid @enderror" id="places" name="places" value="{{ old('places') }}">
                                @error('places')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn evenement rounded-pill">Créer l'événement</button>
                        <a href="{{ route('evenement') }}" class="btn btn-annuler rounded-pill">Annuler</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>
@endif
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>