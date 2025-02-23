<?php
session_start();
require_once 'db_conexion.php';

if (!isset($_SESSION['matricula'])) {
    header("Location: login.php");
    exit();
}

$matricula = $_SESSION['matricula'];

$sql = "SELECT * FROM alumnos WHERE matricula = '$matricula' ";
$result = $conn->query($sql);

$sql = "SELECT * FROM transferencia WHERE matricula = '$matricula' ";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Maestros</title>
    <?php require_once 'cdn.html'?>
    <style>
        body {
            background-image: url('./images/fondo.png');
            background-size: cover; /* Hace que la imagen cubra toda la pantalla */
            background-repeat: no-repeat;
        }
        .transparente{
            border: none;
            background-color: rgba(255, 255, 255, 0); 
        }
        th, td{
            background-color: rgba(255, 255, 255, 0.7) !important;
            color:black !important;
        }
        .custom-card-img .card-body::-webkit-scrollbar {
            width: 10px;
        }
        .custom-card-img .card-body::-webkit-scrollbar-thumb {
            background-color: rgb(238, 137, 87); /* Color negro para la barra */
            border-radius: 5px; /* Bordes redondeados */
            border: 2px solid #f1f1f1; /* Espacio entre la pista y la barra */
        }
        .bg-green{
            background-color: #8cccc6;
        }
        @font-face {
            font-family: 'arco';
            src: url('./font/ARCO.ttf') format('truetype');
        }
        .menu{
            font-family: arco; 
            font-size: xxx-large;
            text-shadow:2px 2px 4px #f3b2fd;
            color:white;
            padding-left: 80px; 
        }
        .title{
            font-family: arco; 
            font-size: xxx-large;
            color:#fb7f4a;
            text-shadow:2px 2px 4px #5fa2fb;
        }
        .contenedor {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centrar en el eje horizontal */
            gap: 10px; /* Espaciado entre botones */
            margin-top: 30px; 
            margin-right: 130px;
            text-align: right;
        }
        .btn-colors {
            color: white;
            cursor: pointer;
            font-size: 25px; /* Tamaño del texto */
            padding: 15px 30px; /* Espaciado interno para hacerlo grande */
            border: none;
            border-radius: 15px; /* Bordes redondeados */
            transition: transform 0.3s ease, background-color 0.3s ease; 
            height: 65px;
            width: 350px;
            text-decoration: none;
            font-family: arco;
            text-shadow: 2px 2px 4px gray;

        }
        .btn-colors:hover {
            transform: scale(1.3); /* Aumenta el tamaño en un 20% */
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="../menu.php">
            <img src="./images/logo.png" width="140">
        </a>
        <h3 class="title">P a g o s</h3>
        <button class="navbar-toggler bg-green" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation" style="margin-right: 35px;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end bg-green" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="menu">Menú</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <div class="contenedor">
                        <a href="./cerrar_sesion.php" class="btn-colors" style="background-color:rgb(250, 121, 121);">Cerrar Sesión</a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- Modal transferencia -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    Monto
                    <input type="number" name="monto" class="form-control" required><br>
                    Numero de Cuenta a transferir
                    <input type="number" name="recibio" class="form-control" required>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary"  type="submit">Confirmar Transferencia</button>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin-top: 170px;">
    <div class="row">
        <!-- card alumno -->
        <div class="col-sm-6 mb-3 mb-sm-0">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Alumno</h5>
                    <h5>Matricula: <?php echo $_SESSION['matricula']; ?></h5>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <!-- Tabla tranferencia -->
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                <div class="card-header"><!-- Button  modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  type="submit">
                    Realizar Pago
                    </button>
                </div>
                    <h5 class="card-title">Mensualidades</h5>
                    <table class="table table-striped-columns">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Mes</th>
                            <th scope="col">Monto a Pagar</th>
                            <th scope="col">Recibio</th>
                            <th scope="col">Estatus</th>
                            <th scope="col">Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- TABLA DATOS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>