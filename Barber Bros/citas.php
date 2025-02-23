<?php
require_once 'db_conexion.php';

if (isset($_POST['up'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $fecha_hora = $_POST['fecha_hora'];
    $servicio = $_POST['servicio'];
    $barbero = $_POST['barbero'];

    $checkUser = $cnnPDO->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = ?");
    $checkUser->execute([$correo]);
    $userExists = $checkUser->fetchColumn(); 

    if ($userExists == 0) {
        echo "<script>
                alert('No estás registrado. Debes crear una cuenta antes de reservar una cita.');
                window.location.href='registro.php';
            </script>";
        exit(); 
    }


    $sql = $cnnPDO->prepare("INSERT INTO citas (nombre, correo, telefono, fecha_hora, servicio, barbero) VALUES (?, ?, ?, ?, ?, ?)");
    $insertSuccess = $sql->execute([$nombre, $correo, $telefono, $fecha_hora, $servicio, $barbero]);

    if ($insertSuccess) {
        $mensaje = "
        <html>
        <head>
            <title>BarberBros</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color:rgb(0, 0, 0);
                margin: 0;
                padding: 0;
                
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                background: url('https://peluqueriacruz.com/wp-content/uploads/2024/02/joven-peluqueria-corte-pelo-1024x683.jpg');
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            .header {
                background: #0000004a;
                backdrop-filter: blur(40px);
                color: #ffc97c;
                padding: 20px;
                border-radius: 8px 8px 0 0;
                font-size: 24px;
                font-weight: bold;
            }
            .content {
                font-size: 16px;
                line-height: 1.6;
                text-align: left;
                color: #ffffff;
                padding: 20px;
                background:rgba(0, 0, 0, 0.44);
                backdrop-filter: blur(40px);
                text-align: center;
            }
            .details {
                text-align: left;
                padding: 15px;
                background:rgba(0, 0, 0, 0.44);
                backdrop-filter: blur(40px);
                border-radius: 5px;
                margin-top: 10px;
                color: #ffffff;
            }
            .details li {
                margin-bottom: 8px;
            }
            .footer {
                margin-top: 0px;
                font-size: 14px;
                color: #ffffff;
                backdrop-filter: blur(40px);
                padding: 50px;
            }
        </style>
    </head>

    <body>
        <div class='container'>
            <div class='header'>BarberBros - Confirmación de Cita</div>
            <p class='content'>Hola <strong>$nombre</strong>, gracias por reservar tu cita en BarberBros. A continuación, los detalles de tu reserva:</p>
            <ul class='details'>
                <li><strong>Nombre:</strong> $nombre</li>
                <li><strong>Teléfono:</strong> $telefono</li>
                <li><strong>Fecha y Hora:</strong> $fecha_hora</li>
                <li><strong>Servicio:</strong> $servicio</li>
                <li><strong>Barbero asignado:</strong> $barbero</li>
            </ul>
            <p class='content'>Recuerda que tu cita es única y no podrá ser reagendada en caso de inasistencia. Te esperamos puntual.</p>
            <p class='footer'>Gracias por confiar en BarberBros. ¡Nos vemos pronto!</p>
        </div>
    </body>
        </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $destinatario = $correo;
        $asunto = "Confirmación de Cita - BarberBros";

        mail($destinatario, $asunto, $mensaje, $headers);

        echo "<script>
                alert('Tu cita ha sido registrada exitosamente.');
                window.location.href='inicio.php';
            </script>";
    } else {
        echo "<script>
                alert('Error al registrar la cita. Intenta nuevamente.');
            </script>";
    }

    unset($sql);
    unset($checkUser);
    unset($cnnPDO);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/b1473ebfe8.js" crossorigin="anonymous"></script>
</head>
<body class="body-citas">
    <div class="container-citas">
        <div class="container-citas-img">
            <div class="container-citas-logo-img">
                <a href="inicio.php" title="Inicio">
                    <img src="img/logo-3.png" alt="Inicio">
                </a>
                
            </div>
                <img src="img/img-1.jpg" alt="">
        </div>
        <div class="container-formulario">
            <div class="content-form-citas">
                <h1>Citas</h1>
                <form id="appointment-form" method="post">
                    
                    <input class="input-form-1" type="text" placeholder="Nombre" id="name" name="nombre" required>
                    <label class="label-form-1" for="name">Nombre</label>

                    <input class="input-form-6" type="email" placeholder="Correo" id="correo" name="correo" required>
                    <label class="label-form-6" for="name">Correo</label>
        
                    <input class="input-form-2" type="number" id="phone" name="telefono" required pattern="[0-9]{10}" placeholder="Ejemplo: 5512345678">
                    <label class="label-form-2" for="phone">Teléfono</label>

                    <input class="input-form-3" type="datetime-local" id="date" name="fecha_hora" required>
                    <label class="label-form-3" for="date">Fecha y Hora</label>
        
                
                    <select class="input-form-4" id="service" name="servicio" required>
                        <option value="">Selecciona un servicio</option>
                        <option value="Corte de cabello">Corte de cabello</option>
                        <option value="Afeitado">Afeitado</option>
                        <option value="Afeitado">Diseño De Autor</option>
                        <option value="Corte + Barba">Corte + Barba</option>
                    </select>
                    <label class="label-form-4" for="service">Servicio</label>
        
                    
                    <select class="input-form-5" id="barber" name="barbero" required>
                        <option value="">Selecciona un barbero</option>
                        <option value="Carlos">Carlos</option>
                        <option value="Luis">Luis</option>
                        <option value="Miguel">Miguel</option>
                        <option value="Pedro">Pedro</option>
                    </select>
                    <label class="label-form-5" for="barber">Colaborador (Barbero)</label>
                    
                    <button class="btn-form" type="submit" name="up">Reservar Cita</button>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>