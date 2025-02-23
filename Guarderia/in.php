<?php
require_once 'cdn.html';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Little Angel</title>
  <style>
    .bg-green{
        background-color: #8cccc6;
    }
    .bg-pink{
        background-color: #f7c5eb;;
    }
    .bg-yellow{
        background-color:  #f4e786;
    }
    .bg-orange{
        background-color:  #ffaf7e;;
    }
    .bg-blue{
        background-color:rgb(146, 195, 248);;
    }
    .bg-purple{
        background-color:rgb(223, 166, 246);;
    }
    .bg-verde{
        background-color:rgb(166, 246, 207);;
    }
    @font-face {
            font-family: 'arco';
            src: url('../Guarderia/font/ARCO.ttf') format('truetype');
    }
    .title{
        font-family: arco; 
        font-size: xxx-large;
        color:#fb7f4a;
        text-shadow:2px 2px 4px #5fa2fb;
    }
    .sin{
        border: none;
        background-color: rgba(255, 255, 255, 0); 
    }
    .group {
      position: absolute;
      top: 125px; /* Ajusta para mover los botones hacia abajo/arriba */
      left: 80%;
      transform: translateX(-50%);
      z-index: 10;
    }
    .button{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-decoration: none;
        position: relative;
        width: 8vw;
        height: 7vh;
        align-items: center;
        font-weight: 500;
        display: flex;
        font-size: 15px;
        color: white;
        background-color:rgb(0, 183, 85);
        border: none;
        cursor: pointer;
        overflow: hidden;
        transition: color 0.2s ease-out;
        justify-content: center;
        z-index: 1;
        margin-left: 0.5vw;
        margin-right: 0.5vw;
        border-radius: 8px;
        box-shadow: 2px 4px 6px rgba(0, 0, 0, 0.3);
        font-style: oblique;
    }
    .button::before{
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color:rgb(0, 255, 119);
        transition: left 0.2s ease;
        z-index: -1;
    }
    .button:hover::before {
        left: 0;
    }
    .button:hover {
        color: #fff;
    }
  </style>
</head>
<body>
<nav class="navbar bg-green">
   <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="Logo" width="90" height="70" class="d-inline-block align-text-top">
        </a>
        <div class="nav justify-content-end ">
            <a type="button" href="login.php" class="button">Iniciar sesión</a>
        </div>   
   </div>
</nav>

<div>
    <div class="card group sin shadow-lg" style="width: 20rem;">
    <div class="card-body">
        <h5 class="card-title title">Contacto</h5>
        <form name="form1" method="post">
            <div class="form-outline mb-4">
            <i class="fas fa-user"></i>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre" required/>
            </div>
            <div class="form-outline mb-4">
            <i class="fas fa-mobile-alt"></i>
            <input type="text" name="celular" class="form-control" placeholder="Celular" required/>
            </div>
            <div class="form-outline mb-4">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" class="form-control" placeholder="Email" required/>
            </div>
            <div class="form-outline mb-4">
            <i class="fas fa-comment-dots"></i>
            <textarea class="form-control" name="comentario" rows="4" placeholder="Deja tu comentario" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" name="enviar" class="btn btn-warning">Solicitar Información</button>
            </div>
        </form>	
    </div>
</div>
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="2000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="https://estaticos-cdn.prensaiberica.es/clip/2b0dc2c4-f8e5-4da3-bc0e-f5c85b830035_16-9-discover-aspect-ratio_default_0.jpg" class="d-block w-100" height="590">
    </div>
    <div class="carousel-item">
      <img src="https://padresrebeldes.com/wp-content/uploads/2019/03/guarderia-portada2.jpg" class="d-block w-100" height="590">
    </div>
    <div class="carousel-item">
      <img src="https://s2.abcstatics.com/abc/www/multimedia/espana/2024/04/17/guarderia-valencia-U07858582515ZTz-1024x512@diario_abc.jpg" class="d-block w-100" height="590">
    </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container-fluid" style="margin-top: 100px;">
  <h1 class="display-2 text-center title">¿Qué ofrecemos en nuestra guarderia?</h1><br><br>
  <div class="row text-center">
    <div class="col-2">
      <button type="button" class="btn bg-orange" style="height: 120px; width:200px;">
        <i class="fas fa-chalkboard-teacher fa-2x"></i><br>
        Amplios salones
      </button>
    </div>
    <div class="col-2">
      <button type="button" class="btn bg-verde" style="height: 120px; width:200px;">
        <i class="fas fa-book-open fa-2x"></i><br>        Materiales didácticos
      </button>
    </div>
    <div class="col-2">
      <button type="button" class="btn bg-pink" style="height: 120px; width:200px;">
        <i class="fas fa-cubes fa-2x"></i><br>
        Áreas de juego funcional
      </button>
    </div>
    <div class="col-2">
      <button type="button" class="btn bg-purple" style="height: 120px; width:200px;">
        <i class="fas fa-building fa-2x"></i><br>
        Salón de usos múltiples
      </button>
    </div>
    <div class="col-2">
      <button type="button" class="btn bg-blue" style="height: 120px; width:200px;">
        <i class="fas fa-hand-sparkles fa-2x"></i><br>
        Salones esterilizados
      </button>
    </div>
    <div class="col-2">
      <button type="button" class="btn bg-yellow" style="height: 120px; width:200px;">
        <i class="fas fa-award fa-2x"></i><br>
        Guardería certificada
      </button>
    </div>
  </div>   
</div><br><br><br><hr><br><br>
<div class="d-flex">
  <!-- Contenido principal -->
  <div class="container flex-grow-1">
    <h1 class="display-4 text-center title">¿Por qué elegir Little Angel?</h1><br><br>
    <div class="row">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <button type="button" class="btn bg-blue">
          <div class="card sin">
            <div class="card-body">
              <img src="https://www.alariaescuelasinfantiles.es/wp-content/uploads/importancia_escuelas_infantiles.jpg" height="200" width="450"><br><br>
              <h5 class="card-title">AMBIENTE SEGURO</h5>
              <p class="card-text">Espacios diseñados para la seguridad y comodidad de los niños.</p>
            </div>
          </div>
        </button>
      </div>
      <div class="col-sm-6">
        <button type="button" class="btn bg-yellow">
          <div class="card sin">
            <div class="card-body">
              <img src="https://okdiario.com/img/2020/08/23/10-consejos-para-que-los-ninos-se-adapten-a-la-guarderia.jpg" height="200" width="450"><br><br>
              <h5 class="card-title">APRENDIZAJE DIVERTIDO</h5>
              <p class="card-text">Juegos educativos que fomentan el desarrollo temprano.</p>
            </div>
          </div>
        </button>
      </div>
    </div>
    <div class="row" style="margin-top: 50px;">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <button type="button" class="btn bg-verde">
          <div class="card sin">
            <div class="card-body">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNnNHm8G3YyQ6ZKS0Y-TjgPtciUHby5cg29A&s" height="200" width="450"><br><br>
              <h5 class="card-title">PERSONAL CALIFICADO</h5>
              <p class="card-text">Educadores y cuidadores especializados en atención infantil.</p>
            </div>
          </div>
        </button>
      </div>
      <div class="col-sm-6">
        <button type="button" class="btn bg-purple">
          <div class="card sin">
            <div class="card-body">
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS74H7B6QQgmtwM8q9dv2aNJ2szjkdcrJfdmA&s" height="200" width="450"><br><br>
              <h5 class="card-title">ALIMENTACIÓN SALUDABLE</h5>
              <p class="card-text">Menús balanceados para el crecimiento y bienestar de los niños.</p>
            </div>
          </div>
        </button>
      </div>
    </div>
  </div>
  <!-- Card en la parte derecha -->
<div class="card align-self-start shadow-lg p-4" style="border:none; width: 25rem; margin-left: 15px; height: auto; background-color: #8cccc6; color: white;">
  <div class="card-body">
    <h4 class="card-title text-center mb-4">¿Qué nos distingue?</h4><br>
    <ul class="list-unstyled" style="text-align: center;">
      <li class="mb-3">
        <i class="fas fa-shield-alt fa-lg"></i> Seguridad y confianza
      </li><br>
      <li class="mb-3">
        <i class="fas fa-user-graduate fa-lg"></i> Personal capacitado
      </li><br>
      <li class="mb-3">
        <i class="fas fa-chalkboard-teacher fa-lg"></i> Métodos educativos innovadores
      </li><br>
      <li class="mb-3">
        <i class="fas fa-heart fa-lg"></i> Atención personalizada
      </li><br>
      <li class="mb-3">
        <i class="fas fa-utensils fa-lg"></i> Alimentación balanceada
      </li><br>
      <li class="mb-3">
        <i class="fas fa-tree fa-lg"></i> Áreas de juego seguras
      </li><br>
      <li class="mb-3">
        <i class="fas fa-first-aid fa-lg"></i> Primeros auxilios disponibles
      </li><br>
      <li class="mb-3">
        <i class="fas fa-music fa-lg"></i> Actividades artísticas y recreativas
      </li><br>
      <li class="mb-3">
        <i class="fas fa-door-open fa-lg"></i> Salones amplios y ventilados
      </li><br>
      <li class="mb-3">
        <i class="fas fa-sun fa-lg"></i> Horarios flexibles para padres
      </li>
    </ul>
  </div>
</div>

</div>

<footer style="background-color: #8cccc6; padding: 40px; color: #fff; margin-top: 70px;">
    <div style="display: flex; justify-content: space-between; flex-wrap: wrap; text-align: center;">
        <div style="flex: 1; min-width: 250px; margin: 10px;">
            <h3 style="margin-bottom: 15px;">Sobre Nosotros</h3>
            <p>En <strong>Little Angel</strong>, brindamos un ambiente seguro, divertido y educativo para el crecimiento de los más pequeños.</p>
        </div>

        <div style="flex: 1; min-width: 250px; margin: 10px;">
            <h3 style="margin-bottom: 15px;">Servicios</h3>
            <ul style="list-style: none; padding: 0;">
                <li><a href="#" style="color: #fff; text-decoration: none;">Guardería Diurna</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Clases de Estimulación</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Eventos Infantiles</a></li>
                <li><a href="#" style="color: #fff; text-decoration: none;">Cuidado Especial</a></li>
            </ul>
        </div>

        <div style="flex: 1; min-width: 250px; margin: 10px;">
            <h3 style="margin-bottom: 15px;">Contacto</h3>
            <p><strong>📍 Dirección:</strong> Calle Angelitos #123, Ciudad</p>
            <p><strong>📞 Teléfono:</strong> +52 123 456 7890</p>
            <p><strong>📧 Email:</strong> contacto@littleangel.com</p>
        </div>
    </div>

    <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
        <a href="#" style="margin: 0 10px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" width="30">
        </a>
        <a href="#" style="margin: 0 10px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="30">
        </a>
        <a href="#" style="margin: 0 10px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6f/Twitter_Logo_2021.svg" alt="Twitter" width="30">
        </a>
    </div>

    <p style="text-align: center; margin-top: 20px; font-size: 14px;">© 2025 Little Angel. Todos los derechos reservados.</p>
</footer>

<section style="margin:auto; width:600px; text-align: center;">
    <div class="card shadow-lg p-4" style="border:none; background-color: #f8f9fa;">
        <?php
        if (isset($_POST['enviar'])) {
            $emailcontacto = $_POST['email'];
            $nombre = $_POST['nombre'];
            $celular = $_POST['celular'];
            $comentario = $_POST['comentario'];

            // Asunto del email
            $asunto = "Información de contacto";

            // Cabeceras para envío en formato HTML
            $cabeceras  = "MIME-Version: 1.0\r\n";
            $cabeceras .= "Content-type: text/html; charset=UTF-8\r\n";
            $cabeceras .= "From: contacto@tusitio.com\r\n"; // Reemplaza con un correo válido

            // Cuerpo del mensaje con diseño
            $mensaje = "
            <html>
            <head>
                
            </head>
            <body>
                <div class='content' style='align-items: center;'>
                  <div class='card shadow-lg' >
                      <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5eHT_NwCTfv8rzu0rTB0WEHSSAcz9YB4ZCg&s' alt='Logo' style='width: 150px; margin-bottom: 20px;'>
                      <h2 class='title'>¡Gracias por tu registro, $nombre!</h2>
                      <p><strong>Email:</strong> $emailcontacto</p>
                      <p><strong>Celular:</strong> $celular</p>
                      <p><strong>Comentario:</strong> $comentario</p>
                      <br>
                      <p>Nos pondremos en contacto contigo pronto.</p>
                  </div>
                </div>
            </body>
            </html>";

            // Envío del correo
            if (mail($emailcontacto, $asunto, $mensaje, $cabeceras)) {
              echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro exitoso!',
                        text: 'Revisa tu bandeja de entrada. Te hemos enviado un email con tus datos de registro y una contraseña asignada.',
                    });
                </script>";
            } else {
              echo "<script>toastr.error('Ocurrió un error al procesar tu solicitud. Inténtalo nuevamente.');</script>";
            }
        }
        ?>
    </div>
</section>

</body>
</html>