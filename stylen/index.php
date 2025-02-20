<?php
require 'db_conexion.php';
include 'offcanvas-car.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylen</title>

</head>

<body class="b-index">
    <div>
        <img src="images/banner.png" class="banner" alt="Banner">
        <a href="catalogo.php" class="btn btn-rentar-ahora">RENTAR AHORA</a>
    </div>
    <hr>
    <div class="container container-info">
        <div class="row justify-content-evenly">
            <div class="col-md-3">
                <div class="card card-index">
                    <img src="images/camion.png" alt="">
                    <div class="card__content"> 
                    <p class="card__title" style=" margin: 30px auto 0;">Envios Rapidos</p>
                    <p class="card__description" style="margin: 0px 20px;">Recibe tu pedido en menos de 24 horas.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-index">
                    <img src="images/calendario.png" alt="">
                    <div class="card__content"> 
                    <p class="card__title" style=" margin: 0;">Renta por tiempo flexible</p>
                    <p class="card__description"  style="margin: 30px 20px;">Renta hasta por 5 días o exitende el tiempo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-index">
                    <img src="images/calidad.png" alt="">
                    <div class="card__content"> 
                    <p class="card__title" style=" margin: 0;">Trajes de calidad</p>
                    <p class="card__description" style="margin: 30px 20px;">Cada traje es lavado antes de cada renta.</p>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="contacto-section">
        <div class="container container-contacto">
            <form class="row g-3" method="post" action="">
                <h1>Contactanos</h1>
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="nombre" id="" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Apellido</label>
                    <input type="text" name="apellido" id="" class="form-control">
                </div>
                <div class="col-md-12">
                    <label>Email</label>
                    <input type="email" name="email" id="" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label>Escriba un mensaje</label>
                    <textarea class="form-control" name="mensaje" rows="3" required></textarea>
                </div>

                <div class="col-md-6">
                    <button type="submit" name="enviar" class="enviar btn">Enviar</button>
                </div>
                <div class="col-md-6">
                    <label class="d-flex justify-content-end label-thanks">Gracias por tu mensaje!</label>
                </div>
            </form>
        </div>
    </div>
    <?php

#Codigo para mandar correo

if (isset($_POST['enviar'])) {
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $mensaje = $_POST['mensaje'];
   
  $sql = $cnnPDO->prepare("INSERT INTO mensajes (nombre, apellido, email, mensaje) VALUES (?, ?, ?, ?)");
        $sql->execute([$nombre, $apellido, $email, $mensaje]);
}
?>

    <footer class="footer text-center">
        <div class="links">
            <h4>Enlaces rápidos</h4>
            <a href="index.php">Inicio</a> <br>
            <a href="catalogo.php">Catálogo</a> <br>
            <a href="favoritos.php">Favoritos</a> <br>

        </div>
        <div class="info">
            <h3>Stylen</h3>
            <p>Renta de trajes para todo tipo de ocasión.</p>
            <p>© 2025 Stylen. Todos los derechos reservados.</p>
        </div>

        <div class="redes">
            <h4>Síguenos</h4>
            <a href="https://www.instagram.com" class="bi bi-instagram"> Instagram</a><br>
            <a href="https://www.facebook.com" class="bi bi-facebook"> Facebook</a><br>
            <a href="https://twitter.com" class="bi bi-twitter"> Twitter</a><br>
        </div>
        </div>
    </footer>


</body>

</html>