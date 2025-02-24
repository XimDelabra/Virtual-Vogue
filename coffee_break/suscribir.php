<?php
require 'db_conexion.php'; // Conexión a la base de datos

$alert = '';

if (isset($_POST['suscribirse'])) {
    $email = $_POST['email'];

    if (!empty($email)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $alert = "<script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Correo inválido',
                            text: 'Por favor ingresa un correo válido.',
                            timer: 5000,
                            backdrop: true,
                            background: '#000000'
                        });
                      </script>";
        } else {
            $sql = $cnnPDO->prepare("INSERT INTO suscriptores (email) VALUES (:email)");
            $sql->bindParam(':email', $email);
            header("Location: index.html");

            if ($sql->execute()) {
                $asunto = "¡Gracias por suscribirte a Coffee Break!";
                $mensaje = "
                    <html>
                    <head>
                        <title>Bienvenido a Coffee Break</title>
                    </head>
                    <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
                        <div style='max-width: 600px; margin: auto; background: #fff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); overflow: hidden;'>
                            <div style='background: #8B4513; padding: 20px; text-align: center; color: white;'>
                                <h1>Coffee Break</h1>
                            </div>
                            <div style='padding: 30px; text-align: center;'>
                                <h2 style='color: #333;'>¡Bienvenido!</h2>
                                <p style='font-size: 16px; color: #555;'>Gracias por suscribirte a nuestro newsletter. Recibirás novedades y promociones exclusivas.</p>
                                <p style='color: #666;'>¡Nos vemos pronto en Coffee Break!</p>
                            </div>
                            <div style='background: #eee; padding: 15px; text-align: center; font-size: 12px; color: #777;'>
                                © 2025 Coffee Break | Todos los derechos reservados.
                            </div>
                        </div>
                    </body>
                    </html>
                ";

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: Coffee Break <no-reply@coffeebreak.com>" . "\r\n";

                if (mail($email, $asunto, $mensaje, $headers)) {
                    $alert = "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Suscripción exitosa! ☕',
                                    text: 'Te has suscrito a nuestro newsletter. Pronto recibirás ofertas exclusivas.',
                                    confirmButtonText: 'Genial',
                                    background: '#f8f1e4', 
                                    color: '#6B4226', 
                                    confirmButtonColor: '#8B4513'
                                });
                              </script>";
                } else {
                    $alert = "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'No se pudo enviar el email.',
                                    timer: 5000,
                                    backdrop: true,
                                    background: '#000000'
                                });
                              </script>";
                }
            } else {
                $alert = "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Este correo ya está registrado o hubo un problema.',
                                timer: 5000,
                                backdrop: true,
                                background: '#000000'
                            });
                          </script>";
            }
        }
    } else {
        $alert = "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Campos vacíos',
                        text: 'Por favor ingresa un correo electrónico.',
                        timer: 5000,
                        backdrop: true,
                        background: '#000000'
                    });
                  </script>";
    }
}

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo $alert;
