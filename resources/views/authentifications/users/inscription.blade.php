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
</head>
<body>
    {{-- <div class="auth">
        <div class="image-container">
            <img src="{{ asset('auth/img/bienvenue.png') }}" alt="image">
        </div>
        <div class="form-container mt-5">
            <h1>Inscription</h1>
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom Complet</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="nom" style="border-color: #FF8200">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" style="border-color: #FF8200">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" style="border-color: #FF8200">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" style="border-color: #FF8200">
                </div>
                
                <button type="submit" class="btn form-control" style="background-color: #FF8200; color:white; display:flex; justify-content:center; align-items:center">S'inscrire</button>
            </form>
        </div>
    </div> --}}

    <div class="row d-flex align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('auth/img/bienvenue.png') }}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <div class="mb-5">
                <div class="card-body">
                    <h2 class="card-title">Inscription</h2>
                    <form method="POST" action="{{ route('register-traitement') }}" enctype="multipart/form-data">
                        @csrf
                    
                        <div class="mb-2">
                            <label for="name" class="form-label">Nom Complet</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="nom complet" style="border-color: #FF8200" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-2">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="adresse email" style="border-color: #FF8200" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-2">
                            <label for="phone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Téléphone" style="border-color: #FF8200" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-2">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="mot de passe" style="border-color: #FF8200" >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-2">
                            <label for="logo" class="form-label">Photo profil</label>
                            <input type="file" class="form-control1 @error('logo') is-invalid @enderror" id="logo" name="logo" value="{{ old('logo') }}">
                            @if ($errors->has('logo'))
                                <span class="text-danger">{{ $errors->first('logo') }}</span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn form-control" style="background-color: #FF8200; color:white; display:flex; justify-content:center; align-items:center">S'inscrire</button>
                        <div class="mb-3" style="display: flex; justify-content:center; align-items:center">
                            <p class="mt-2">Vous avez déjà un compte. Cliquer <a href="{{ route('login') }}">ici</a></p>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>