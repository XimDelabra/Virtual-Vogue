<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['matricula'])) {
    header("Location: login.php");
    exit();
}

$matricula_maestro = $_SESSION['matricula'];

$sql = "SELECT alumnos.nombre, alumnos.edad, alumnos.matricula, alumnos.foto 
        FROM alumnos 
        INNER JOIN asignacion ON alumnos.matricula = asignacion.matricula_a 
        WHERE asignacion.matricula_m = '$matricula_maestro'";
$result = $conn->query($sql)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alumnos</title>
    <?php require_once 'cdn.html'?>
    <style>
        body {
            background-image: url('../images/fondo.png');
            background-size: cover; /* Hace que la imagen cubra toda la pantalla */
            background-repeat: no-repeat;
        }
        .transparente{
            border: 25px;
            background-color: rgba(248, 242, 121, 0.6); 
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
            src: url('../font/ARCO.ttf') format('truetype');
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
            <img src="../images/logo.png" width="140">
        </a>
        <h3 class="title">Bienvenido Maestro/a: <?php echo  $_SESSION['nombre']?></h3>
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
                        <a href="cardAlumno.php" class="btn-colors"  style="background-color: #f4e786;">Mis alumnos</a><br>
                        <a href="./cerrar_sesion.php" class="btn-colors" style="background-color:rgb(250, 121, 121);">Cerrar Sesión</a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</nav>
    <div class="container">
        <div class="row" style="margin-top: 150px;">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-3 transparente">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <img src="../administrador/<?php echo ($row['foto']); ?>" width="110" height="110" style="border-radius:5%;"> 
                                </div>
                                <div class="col-8">
                                    <h5 class="card-title"> Nombre: <?php echo ($row['nombre']); ?></h5>                
                                    <p class="card-text">Edad: <?php echo $row['edad']; ?> años</p>
                                    <p class="card-text"><strong>Matrícula:</strong> <?php echo $row['matricula']; ?></p>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php $conn->close(); ?>
