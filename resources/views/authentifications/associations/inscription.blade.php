<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/style/style.css') }}" />
    <style>
        body {
            overflow-y: scroll;
            padding: 0;
            margin: 0;
        }
        
        .col-md-6 img {
            position: fixed;
            width: 50%;
            height: 100vh;
            overflow-x: hidden;
            display: block;
        }
        
        .form-control {
            padding: 0.8rem;
            border-radius: 10px;
            border-color: #FF8200;
        }
        .btn {
            background-color: #FF8200;
            color: white;
            font-size: 1.2rem;
            padding: 0.75rem;
            border-radius: 10px;
            width: 100%;
        }
        
        .text-center p {
            margin-top: 1rem;
        }
        
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            width: 100%;
        }
        
        .form-group {
            flex: 1 1 calc(50% - 1.5rem);
            margin-bottom: 0;
        }
        
        .form-group-full {
            flex: 1 1 100%;
        }
        
        @media (max-width: 767px) {
            .form-group {
                flex: 1 1 100%;
            }
            .col-md-6 img {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="">
        <div class="row d-flex ">
            <div class="col-md-6 ">
                <img src="{{ asset('auth/img/bienvenue.png') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h2 class="card-title">Inscription</h2>
                    <form method="POST" action="{{ route('register-traitement.association') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-container">
                            <div class="form-group">
                                <label for="name" class="form-label">Nom de l'association</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom de l'association" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="adress" class="form-label">Adresse</label>
                                <input type="text" class="form-control @error('adress') is-invalid @enderror" id="adress" name="adress" placeholder="Adresse de l'association" value="{{ old('adress') }}">
                                @error('adress')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Adresse email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="activity_area" class="form-label">Secteur d'activité</label>
                                <select class="form-control @error('activity_area') is-invalid @enderror" id="activity_area" name="activity_area" aria-placeholder="Sélectionner un secteur d'activité">
                                    <option value="Événements corporatifs" {{ old('activity_area') == 'Événements corporatifs' ? 'selected' : '' }}>Événements corporatifs</option>
                                    <option value="Événements sportifs" {{ old('activity_area') == 'Événements sportifs' ? 'selected' : '' }}>Événements sportifs</option>
                                    <option value="Événements culturels" {{ old('activity_area') == 'Événements culturels' ? 'selected' : '' }}>Événements culturels</option>
                                    <option value="Anniversaires" {{ old('activity_area') == 'Anniversaires' ? 'selected' : '' }}>Anniversaires</option>
                                    <option value="Salons et expositions" {{ old('activity_area') == 'Salons et expositions' ? 'selected' : '' }}>Salons et expositions</option>
                                    <option value="Concerts et spectacles" {{ old('activity_area') == 'Concerts et spectacles' ? 'selected' : '' }}>Concerts et spectacles</option>
                                    <option value="Conférences et séminaires" {{ old('activity_area') == 'Conférences et séminaires' ? 'selected' : '' }}>Conférences et séminaires</option>
                                    <option value="Festivals" {{ old('activity_area') == 'Festivals' ? 'selected' : '' }}>Festivals</option>
                                    <option value="Événements communautaires" {{ old('activity_area') == 'Événements communautaires' ? 'selected' : '' }}>Événements communautaires</option>
                                    <option value="Autres" {{ old('activity_area') == 'Autres' ? 'selected' : '' }}>Autres</option>
                                    <option value="Mariages" {{ old('activity_area') == 'Mariages' ? 'selected' : '' }}>Mariages</option>
                                </select>
                                @error('activity_area')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Téléphone" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ninea" class="form-label">Ninea</label>
                                <input type="text" class="form-control @error('ninea') is-invalid @enderror" id="ninea" name="ninea" placeholder="Ninea" value="{{ old('ninea') }}">
                                @error('ninea')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mot de passe">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="creation_date" class="form-label">Date fondation</label>
                                <input type="date" class="form-control @error('creation_date') is-invalid @enderror" id="creation_date" name="creation_date" placeholder="Date fondation">
                                @error('creation_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group form-group-full">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Description de l'association">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group form-group-full mb-4">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control-file @error('logo') is-invalid @enderror" id="logo" name="logo">
                                @error('logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn form-control d-flex justify-content-center align-items-center">S'inscrire</button>
                        <div class="text-center">
                            <p class="mt-2">Vous avez déjà un compte ? Cliquez <a href="{{ route('login') }}">ici</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JavaScript -->
    <script src
    