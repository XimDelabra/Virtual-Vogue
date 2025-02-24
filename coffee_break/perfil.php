<?php
session_start();
require 'db_conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Obtener los datos del usuario desde la base de datos
$select = $cnnPDO->prepare('SELECT * FROM usuarios_cafeteria WHERE email = ?');
$select->execute([$email]);
$usuario = $select->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Error: Usuario no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil | Coffee Break</title>
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
    background-color:rgb(255, 77, 77);
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
        .profile-container {
            background: rgba(253, 250, 233, 0.86);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-coffee {
            background-color: #208f5a;
            color: white;
            font-weight: bold;
        }
        .btn-coffee:hover {
            background-color: rgb(15, 66, 42);
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
<nav class="navbar">
    <div class="navbar-left">
        <a href="#" class="logo">Coffee Break</a>
    </div>
    <div class="navbar-right">
        <a href="index.html">Inicio</a>
        <a href="menu.html">Menú</a>
        <a href="logout.php" class="donate-btn">Cerrar Sesión</a>
    </div>
</nav>


    <div class="container d-flex justify-content-center">
        <div class="col-md-6">
            <div class="profile-container text-center">
                <h2>Perfil de Usuario</h2>
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
            </div>
        </div>
    </div>
    <br><br><br><br><br>

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
</body>
</html>
