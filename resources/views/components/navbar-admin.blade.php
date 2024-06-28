<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="{{ asset('spatie/style/style.css') }}" />
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

    body {
        font-family: "Montserrat", sans-serif;
        font-size: 14px;
        line-height: 1.6;
        margin: 0;
        padding: 0;
        background-color: #fff;
        color: #051d30;
        overflow-x: hidden;
        }
        .navbar-nav .nav-item .nav-link.active {
            color: #FF8200;
        }
        .btn-header {
            border: 1px #FF8200 solid;
            background: #FF8200;
            color: white;
            border-radius: 25px
        }
        .btn-modifier {
    background-color: #FF8200;
    color: white;
    border-radius: 25px
}
.btn-supprimer {
    background-color: red;
    color: white;
    border-radius: 25px
}
.btn-autoriser {
    background-color: #F5F5F5;
    color: #FF8200;
    border: 1px solid #FF8200;
    border-radius: 25px
}
.search-bar {
    margin-bottom: 20px;
    
}
.search-bar input {
    width: calc(100% - 120px);
    display: inline-block;
    border-radius: 25px
}
.search-bar button {
    width: 100px;
    display: inline-block;
}

.btn-ajout {
    border: #FF8200 1px solid;
    color: #FF8200;
    background: #F5F5F5;
    border-radius: 25px;
    padding: 7px 15px
}
th, td {
    text-align: center
}
.action {
    display: flex;
    justify-content: space-around;
   
}
.profile-header {
            background-color: #FF8200;
            color: white;
            padding: 2rem;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .profile-header img {
            border-radius: 15px;
            width: 100%;
            max-width: 100%;
        }
        .profile-info {
            text-align: center;
            margin-top: 2rem;
        }
        .profile-info h3 {
            font-weight: bold;
            text-align: start
        }
        .profile-info {
            display: flex;
            flex-direction: column;
            
            margin: 1rem 0;
            gap: 20px;
            
        }
        .contact-info {
            display: flex;
            
            margin: 1rem 0;
            gap: 20px;
            
        }
        .btn-custom {
            border-color: #FF8200;
            color: #FF8200;
            border-radius: 25px;
            width: 15%
        }

        .boites {
            margin-top: 6rem;
        }
        .stat-card {
            background-color: #fff7ef;
            border: 1px solid #FF8200;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .stat-card h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .stat-card p {
            font-size: 1rem;
            font-weight: normal;
            margin: 0;
        }
        

@media (max-width: 768px) {
            .btn-text {
                display: none;
            }
            .btn-icon {
                display: inline-block;
            }
            .btn-modifier, .btn-supprimer, .btn-autoriser {
                background: white
            }
            .btn-autoriser {
                border: 1px solid white;
            }
            .responsive-mobile {
                display: none
            }
            th, td {
                font-size: 10px;   
            }
            .profile-header img {
                display: none
            }            
            .profile-header {
                padding: 6rem;
                text-align: center
            }  
            .contact-info {
            display: flex;
            flex-direction: column;
            margin: 1rem 0;
            text-align: start;
            gap: 10px;
            
        }
        .profile-info {
            gap: 10px;
        }
        .btn-custom {
            width: 50%;
        }

        .titre-edit {
            font-size: 14px;
        }
                 
        }


        @media (min-width: 768px) {
           
            .btn-icon {
                display: none;
            }
            
            
            
        }


        
        
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#" style="font-size: 20px; font-weight:500; color:#05243C">DigitalEvents</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style="font-size: 20px; font-weight: 500; color: #05243C">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}" href="{{ route('dashboard.admin') }}">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('roles.index', 'role.permissions') ? 'active' : '' }}" href="{{ route('roles.index') }}">Rôles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}" href="{{ route('permissions.index') }}">Permissions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('users.index', 'users.show') ? 'active' : '' }}" href="{{ route('users.index') }}">Utilisateurs</a>
            </li>
            
        </ul>
        <button class="btn my-2 my-sm-0 btn-header" type="button">Déconnexion</button>
        <a href="{{ route('profil.admin') }}"><span class="navbar-text ml-3" style="color: #FF8200">Mouhammad</span></a>
    </div>
</nav>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
