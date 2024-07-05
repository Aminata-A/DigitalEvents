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
        .image-container img {
        }

        .form-container {
            max-width: 60em;
            width: 40em;
            margin: 0 auto;
            padding: 2em;
        }

        .form-container label {
            color: #051D30;
        }

        .form-container .btn-primary {
            background-color: #FF8200;
            border-color: #FF8200;
        }

        .form-container .btn-primary:hover {
            background-color: #e57300;
            border-color: #e57300;
        }

        .form-container .form-control {
            border-color: #FF8200;
        }

        .form-container .invalid-feedback {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .image-container {
                display: none;
            }
            .form-container {
                margin-top: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 d-none d-md-block image-container">
                <img src="{{ asset('auth/img/bienvenue.png') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <div class="form-container bg-white">
                    <h2 class="text-center mb-4">Inscription</h2>
                    <form method="POST" action="{{ route('register-traitement') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Nom Complet</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom complet" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="form-label">Adresse email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Adresse email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Téléphone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mot de passe">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logo" class="form-label">Photo profil</label>
                            <input type="file" class=" @error('logo') is-invalid @enderror" id="logo" name="logo">
                            @error('logo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                        <div class="mt-3 text-center">
                            <p>Vous avez déjà un compte? <a href="{{ route('login') }}" class="text-decoration-none" style="color: #FF8200;">Cliquez ici</a></p>
                            <p>Si vous êtes une <strong> association <a href="{{ route('register.association') }}" class="text-decoration-none" style="color: #FF8200;"></strong>Cliquez ici</a> pour s'inscrire</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
