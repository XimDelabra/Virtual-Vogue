<?php
require 'db_conexion.php';
include 'navbar.php';
session_start();

# Inicia Código de REGISTRAR

if (isset($_POST['registrar'])) {
    $email = $_POST['iptEmailR'];
    $nombre = $_POST['iptNombreR'];
    $apellido = $_POST['iptApellidoR'];
    $password = $_POST['iptPassR'];
    $confirmacion = $_POST['iptPassConfirmR'];

    if (!empty($email) && !empty($nombre) && !empty($apellido) && !empty($password) && !empty($confirmacion)) {

        #Buscar si existe el email en la bd
        $select = $cnnPDO->prepare('SELECT * from usuarios WHERE email =?');
        $select->execute([$email]);
        $count = $select->rowCount();

        #Si no existe, seguir
        if (!$count) {
            #Verificar que la password sea igual a la confirmacion          
            if ($password == $confirmacion) {
                $sql = $cnnPDO->prepare("INSERT INTO usuarios
                    (email,nombre,apellido,password) VALUES (?,?,?,?)");
                $sql->execute([$email, $nombre, $apellido, $password]);

                echo "<script>alert('Exito: Sus datos fueron enviados, sera redirigido al login en 5 segundos.');</script>";

                sleep(5);
                header('location: login.php');
            } else {
                echo "<script>alert('Mensaje:Las contraseñas no coinciden.');</script>";
            }
            #Si existe, error   
        } else {
            echo "<script>alert('Mensaje: El email ingresado ya existe, favor de probar con otro.');</script>";
        }
    } else {
        echo "<script>alert('Mensaje: Rellenar todos los campos.');</script>";
    }
}
# Termina Código de REGISTRAR

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylen</title>
</head>

<body class="blogin">
    <div class="container text-center">
        <h1 class="txt-registro2">REGISTRATE</h1>
        <a href="login.php" class="txt-login2">O INICIA SESION</a>

        <div class="container c-registro">
            <form class="row g-3 f-registro" method="POST" action="">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="iptNombreR" name="iptNombreR" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="iptApellidoR" name="iptApellidoR" placeholder="Apellido">
                </div>
                <div class="col-12">
                    <input type="email" class="form-control" id="iptEmailR" name="iptEmailR" placeholder="Email">
                </div>
                <div class="col-12">
                    <input type="password" class="form-control" id="iptPassR" name="iptPassR" placeholder="Contrasena">
                </div>
                <div class="col-12">
                    <input type="password" class="form-control" id="iptPassConfirmR" name="iptPassConfirmR" placeholder="Confirmar Contrasena">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-registrar" name="registrar">REGISTRAR</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>