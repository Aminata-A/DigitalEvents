<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

    <Style>
        .footer-bg {
            background-color: #FF8200;
        }
    </Style>
</head>
<body>
<footer class="footer-bg text-white">
    <div class="text-center py-3 bg-light">
        <img src="{{ asset('images/Logo.png')}}" alt="Logo" class="img-fluid" width="150px" />
    </div>
    <div class="row text-center py-4">
        <div class="col-md-4 d-flex justify-content-center">
            <i class="bi bi-geo-alt mr-2"></i>
            <p>Cite keur gorgui</p>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
            <i class="bi bi-telephone mr-2"></i>
            <p>+221 33 824 29 27</p>
        </div>
        <div class="col-md-4 d-flex justify-content-center">
            <i class="bi bi-envelope mr-2"></i>
            <p>Simplon@gmail.com</p>
        </div>
    </div>
</footer>
</body>
</html>

