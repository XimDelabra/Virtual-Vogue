<?php
session_start();
require_once 'db_conexion.php';

if (isset($_POST['login'])) {
    $matricula = trim($_POST['matricula']);
    $password = trim($_POST['password']);

    if (!empty($matricula) && !empty($password)) {
        // Consulta para verificar si el usuario es administrador
        $sql_admin = $cnnPDO->prepare("SELECT * FROM administradores WHERE matricula = ? AND password = ?");
        $sql_admin->execute([$matricula, $password]);
        $admin = $sql_admin->fetch(PDO::FETCH_ASSOC);

        // Consulta para verificar si el usuario es maestro
        $sql_maestro = $cnnPDO->prepare("SELECT * FROM maestros WHERE matricula = ? AND password = ?");
        $sql_maestro->execute([$matricula, $password]);
        $maestro = $sql_maestro->fetch(PDO::FETCH_ASSOC);

        // Consulta para verificar si el usuario es alumno
        $sql_alumno = $cnnPDO->prepare("SELECT * FROM alumnos WHERE matricula = ? AND celular = ?");
        $sql_alumno->execute([$matricula, $password]);
        $alumno = $sql_alumno->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            $_SESSION['matricula'] = $admin['matricula'];
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        text: 'Inicio de sesión exitoso.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = './administrador/alumnos/tablaAlumnos.php';
                    });
                  </script>";
        } elseif ($maestro) {
            $_SESSION['matricula'] = $maestro['matricula'];
            $_SESSION['nombre'] = $maestro['nombre'];
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        text: 'Inicio de sesión exitoso.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = './Login_Maestro/cardAlumno.php';
                    });
                  </script>";
        } elseif ($alumno) {
            $_SESSION['matricula'] = $alumno['matricula'];
            $_SESSION['nombre'] = $alumno['nombre'];
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido',
                        text: 'Inicio de sesión exitoso.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'alumno_page.php';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Error',
                        text: 'Los datos ingresados son incorrectos.'
                    });
                  </script>";
        }
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Campos vacíos',
                    text: 'Completa todos los campos para iniciar sesión.'
                });
              </script>";
    }
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap');
        body {
            background-image: url('images/fondologin.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Comic Neue', cursive;
        }

        @font-face {
            font-family: 'arco';
            src: url('font/ARCO.ttf') format('truetype');
        }
        .fuente{
            font-family: arco; 
            font-size:80px;
            color:#fb7f4a;
            text-shadow:2px 2px 4px #5fa2fb;
        }
        body.swal2-shown {
        overflow-y: hidden;
        }
        
        .login-container {
            background-color: #f5ebdc;
            position: absolute;
            top: 50%;
            left: 30%;
            transform: translate(-50%, -50%);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
        }
        
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 20px;
            background-color: #fff;
            text-align: center;
            font-size: 16px;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 20px;
            background-color: #70c050;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #5ba03e;
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.3);
        }

    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12" style="margin-top: 10px; margin-left:70px;">
            <!-- Form -->
            <form method="POST">
                <div class="login-container">
                    <h3 class="fuente">Iniciar Sesión</h3><br>
                    <input type="text" name="matricula" placeholder="Matrícula"><br><br>
                    <input type="password" name="password" placeholder="Contraseña"><br><br>
                    <button type="submit"  name="login">Ingresar</button>
                    <a href="./Login_Maestro/cardAlumno.php"></a>
                </div>
            </form>
        </div>
    </div>
</div>
 
</body>
</html>
