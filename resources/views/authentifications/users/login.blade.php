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
    <div class="row d-flex align-items-center">
        <div class="col-md-6">
            <img src="{{ asset('auth/img/bienvenue.png') }}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6">
            <div class="">
                <div class="card-body">
                    @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
                    <h1 class="card-title">Connexion</h1>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    
                        
                    
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="adresse email" style="border-color: #FF8200" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="mot de passe" style="border-color: #FF8200" >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                    
                        <button type="submit" class="btn form-control" style="background-color: #FF8200; color:white; display:flex; justify-content:center; align-items:center">Se connecter</button>

                        <div class="mb-3" style="display: flex; justify-content:center; align-items:center">
                            <p class="mt-5">Vous n'avez pas de compte. Cliquer <a href="{{ route('register') }}">ici</a></p>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        
    </div>
    
</body>
</html>