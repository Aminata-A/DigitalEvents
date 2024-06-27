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
}
.btn-supprimer {
    background-color: red;
    color: white;
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
    background: #D9D9D9;
    border-radius: 25px;
    padding: 7px 15px
}
th, td {
    text-align: center
}
.action {
    display: flex;
    justify-content: space-around;
    align-items: center
}
@media (max-width: 768px) {
            .btn-text {
                display: none;
            }
            .btn-icon {
                display: inline-block;
            }
            .btn-modifier, .btn-supprimer {
                background: white
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
    <div class="collapse navbar-collapse" id="navbarNav" style="font-size: 20px; font-weight:500; color:#05243C">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Rôles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Permissions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Utilisateurs</a>
            </li>
        </ul>
        <button class="btn my-2 my-sm-0 btn-header" type="button">Déconnexion</button>
        <span class="navbar-text ml-3" style="color: #FF8200">Mouhammad</span>
    </div>
</nav>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
