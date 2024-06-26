<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .orange-background {
            background-color: orange;
        }
        .image-container {
            background-image: url('https://img.freepik.com/vecteurs-libre/modele-sans-couture-lignes-organiques-irregulieres-orange_1409-4190.jpg?t=st=1719417420~exp=1719421020~hmac=e0da1aea7e251917a9394925bb9a5f1211ffe8353400c44f56ff1a9f0c86ebf8&w=826');
            background-size: cover;
            background-position: center;
            height: 100vh;
            opacity: 0.5;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 orange-background image-container">
                <!-- Image et background orange avec opacité -->
            </div>
            <div class="col-md-6">
                <div class="container form-container">
                    <h1>Créer un Événement</h1>
                
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                    <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                        <input type="hidden" name="user_id" value="1">
                
                        <div class="form-group">
                            <label for="name">Nom de l'événement</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        </div>
                
                        <div class="form-group">
                            <label for="event_start_date">Date de début</label>
                            <input type="date" class="form-control" id="event_start_date" name="event_start_date" value="{{ old('event_start_date') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="event_end_date">Date de fin</label>
                            <input type="date" class="form-control" id="event_end_date" name="event_end_date" value="{{ old('event_end_date') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="location">Lieu</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="registration_deadline">Date limite d'inscription</label>
                            <input type="date" class="form-control" id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="places">Nombre de places</label>
                            <input type="number" class="form-control" id="places" name="places" value="{{ old('places') }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                
                        <button type="submit" class="btn btn-primary">Créer l'événement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
