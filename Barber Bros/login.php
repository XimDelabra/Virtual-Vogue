<?php
require_once 'db_conexion.php';
session_start();

if (isset($_POST['login'])) {
    $nombre=$_SESSION['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $select = $cnnPDO->prepare('SELECT * FROM usuarios WHERE correo = ? AND contraseña = ?');
    $select->execute([$correo, $contraseña]);
    $campo = $select->fetch();

    if ($campo) {
        $_SESSION['correo'] = $campo['correo'];
        $_SESSION['contraseña'] = $campo['contraseña'];
        $_SESSION['nombre'] = $campo['nombre'];
        header('Location: inicio.php');
        exit();
    } else {
        echo "<script>alert('Correo o contraseña incorrectos.'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="body-login">

<div class="container-login">

        <div class="container-formulario-login">
            <div class="content-form-login">
                <h1>Inicio de Sesion</h1>
                <form id="appointment-form" method="post">
                    
                    <input class="input-form-1" type="email" placeholder="correo" id="name" name="correo" required>
                    <label class="label-form-1" for="name">correo</label>

                    <input class="input-form-6" type="password" placeholder="contraseña" id="contraseña" name="contraseña" required>
                    <label class="label-form-6" for="name">contraseña</label>
                    <strong>
                    <a href="registro.php">¿No tienes cuenta? Registrate</a>
                    </strong>
                    <button class="btn-form" type="submit" name="login">Iniciar sesion</button>
                </form>
            </div>
            
        </div>
        <div class="container-login-img">
            <div class="container-login-logo-img">
                    <img src="img/logo-3.png" alt="Inicio">
            </div>
                <img src="img/img-2.jpg" alt="">
        </div>
    </div>
</body>
</html>