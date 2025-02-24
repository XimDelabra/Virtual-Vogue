<?php
session_start();
require 'db_conexion.php'; 

$mensaje = "";
$tipo_mensaje = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $select = $cnnPDO->prepare('SELECT * FROM usuarios_cafeteria WHERE email = ?');
        $select->execute([$email]);
        $campo = $select->fetch(PDO::FETCH_ASSOC);

        if ($campo) {
            if (password_verify($password, $campo['password'])) {
                $_SESSION['email'] = $campo['email'];
                $_SESSION['nombre'] = $campo['nombre'];
                
                $mensaje = "Inicio de sesión exitoso. Redirigiendo...";
                $tipo_mensaje = "success";
                
                echo '<script>
                    setTimeout(function() {
                        window.location.href = "perfil.php";
                    }, 2000);
                </script>';
            } else {
                $mensaje = "Contraseña incorrecta";
                $tipo_mensaje = "danger";
            }
        } else {
            $mensaje = "El correo no está registrado";
            $tipo_mensaje = "warning";
        }
    } else {
        $mensaje = "Todos los campos son obligatorios";
        $tipo_mensaje = "warning";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión | Coffee Break</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('image/fondo.jpg');
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            padding-top: 60px;
        } 
        .navbar {
            position: fixed; 
    top: 0; 
    left: 0;
    width: 100%; 
    margin: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #208f5a ;
    padding: 10px 20px;
    height: 60px;
    color: rgb(0, 0, 0);
    z-index: 1000;
}

.navbar-left .logo {
    font-size: 1.5em;
    font-weight: bold;
    color: #ffffff;
    text-decoration: none;
}

.navbar-right a {
    color: #ffeb5b;
    text-decoration: none;
    margin: 0 10px;
    font-size: 0.9em;
    transition: color 0.3s ease;
}

.navbar-right .donate-btn {
    background-color: #ffeb5b;
    padding: 8px 20px;
    border-radius: 5px;
    font-weight: bold;
    color: #ffffff;
    transition: background-color 0.3s ease;
}

.navbar-right a:hover {
    color: #ffffff; 
}

.donate-btn:hover {
    background-color: #000000; 
}
        .container {
            margin-top: 50px;
        }
        .form-container {
            background: rgba(253, 250, 233, 0.86);
            padding: 40px;
            width: 400px;
            margin-left: 90px; 
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            margin-bottom: 70px; 
        }
        .btn-coffee {
            background-color: #208f5a;
            color: white;
            font-weight: bold;
        }
        .btn-coffee:hover {
            background-color: rgb(15, 66, 42);
        }
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        footer {
        background-color: #208f5a;
        color: white;
        padding: 40px 20px;
        font-family: 'Arial', sans-serif;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }

    .footer-left, .footer-center, .footer-right {
        flex: 1;
        min-width: 250px;
    }

    .footer-left h3 {
        margin-bottom: 10px;
        font-size: 1.6em;
    }

    .footer-left p {
        font-size: 1.1em;
        margin-bottom: 20px;
    }

    .social-links a {
        margin-right: 10px;
        display: inline-block;
    }

    .social-links img {
        width: 30px;
        height: 30px;
        transition: transform 0.3s ease;
    }

    .social-links a:hover img {
        transform: scale(1.1);
    }

    .footer-center h4, .footer-right h4 {
        font-size: 1.4em;
        margin-bottom: 10px;
    }

    .footer-center ul, .footer-right ul {
        list-style-type: none;
        padding: 0;
    }

    .footer-center li, .footer-right li {
        margin-bottom: 10px;
        font-size: 1.1em;
    }

    .footer-bottom {
        text-align: center;
        font-size: 1em;
        border-top: 1px solid #ffffff;
        padding-top: 10px;
    }

    </style>
</head>
<body>

<div class="toast-container">
    <?php if (!empty($mensaje)) : ?>
        <div id="toast" class="toast align-items-center text-bg-<?php echo $tipo_mensaje; ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $mensaje; ?>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
</div>

<nav class="navbar">
    <div class="navbar-left">
        <a href="#" class="logo">Coffee Break</a>
    </div>
    <div class="navbar-right">
        <a href="menu.html">Menú</a>
        <a href="#coffee">Sobre nosotros</a>
        <a href="#coffee">Ubicación</a>
        <a href="login.php" class="donate-btn">Iniciar Sesión</a>
    </div>
</nav>

<div class="container d-flex justify-content-center">
    <div class="col-md-6">
        <div class="form-container">
            <h2 class="text-center">Inicia Sesión en <strong>Coffee Break</strong></h2>
            <p class="text-center text-muted">Disfruta de nuestra cafetería ☕</p>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <a href="registro.php">No tienes cuenta?</a>
                <button type="submit" name="login" class="btn btn-coffee w-100">Iniciar sesión</button>
            </form>
        </div>
    </div>
</div>

<footer>
        <div class="footer-content">
            <div class="footer-left">
                <h3>Coffee Break</h3>
                <p>Tu lugar para disfrutar del mejor café y postres en un ambiente acogedor.</p>
                <div class="social-links">
                    <a href="#" target="_blank"><img src="https://img.icons8.com/ios/50/000000/facebook.png" alt="Facebook"></a>
                    <a href="#" target="_blank"><img src="https://img.icons8.com/ios/50/000000/instagram-new.png" alt="Instagram"></a>
                    <a href="#" target="_blank"><img src="https://img.icons8.com/ios/50/000000/twitter.png" alt="Twitter"></a>
                </div>
            </div>
            <div class="footer-center">
                <h4>Contacto</h4>
                <ul>
                    <li>Teléfono: +1 (555) 123-4567</li>
                    <li>Email: contacto@cafeteriadeliciosa.com</li>
                </ul>
            </div>
            <div class="footer-right">
                <h4>Horarios</h4>
                <ul>
                    <li>Lunes - Viernes: 8:00 AM - 8:00 PM</li>
                    <li>Sábado - Domingo: 9:00 AM - 6:00 PM</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Coffee Break. Todos los derechos reservados.</p>
        </div>
    </footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var toastEl = document.getElementById('toast');
        if (toastEl) {
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
