<?php
session_start();
require 'db_conexion.php';
if (isset($_POST['registrar'])) 
{  
	$correo=$_POST['correo'];
	$nombre=$_POST['nombre'];
    $contraseña=$_POST['contraseña'];
	
	if (!empty($correo) && !empty($nombre) && !empty($contraseña))	{

			$sql=$cnnPDO->prepare("INSERT INTO usuarios
			(correo, nombre, contraseña) VALUES (?, ?, ?)");
            $sql->execute([$correo, $nombre, $contraseña]);
			unset($sql);
			unset($cnnPDO);
            $_SESSION['nombre'] = $campo['nombre'];
            header("location:login.php");
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
<body class="body-registro">
<div class="container-registro">
<div class="container-registro-img">
            <div class="container-registro-logo-img">
                    <img src="img/logo-3.png" alt="Inicio">
            </div>
                <img src="img/img-2.jpg" alt="">
        </div>
        <div class="container-formulario-registro">
            <div class="content-form-registro">
                <h1>Registro</h1>
                <form id="appointment-form" method="post">
                    
                    <input class="input-form-1" type="text" placeholder="Nombre" id="name" name="nombre" required>
                    <label class="label-form-1" for="name">Nombre</label>

                    <input class="input-form-6" type="email" placeholder="Correo" id="correo" name="correo" required>
                    <label class="label-form-6" for="name">Correo</label>
        
                    <input class="input-form-2" type="password" placeholder="Contraseña" id="contraseña" name="contraseña" required >
                    <label class="label-form-2" for="phone">Contraseña</label>
                    <a href="login.php">¿Ya tienes cuenta? Inicia Sesion</a>
        
                    <button class="btn-form" type="submit" name="registrar">Registrar</button>
                </form>
            </div>
            
        </div>
    </div>
</body>
</html>