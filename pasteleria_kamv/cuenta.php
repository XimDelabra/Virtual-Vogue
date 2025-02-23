<?php
session_start();
require "db_conexion.php";
require "cdn.html"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
        }
        .login-img {
            background: url('imagenes/pastel_cuenta.png') no-repeat center center;
            background-size: cover;
        }
        .login-form {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-form h5 {
            font-weight: bold;
        }
        .btn-login {
            background-color: #000;
            color: #fff;
        }
        .btn-signup {
            background-color: #f2f2f2;
            color: #000;
        }
    </style>
</head>
<body>

<?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password']; 
        
        $select = $cnnPDO->prepare('SELECT * from usuarios_proyecto WHERE email = ? and password = ?');
        $select->execute([$email, $password]); 
        $count = $select->rowCount();
        $campo = $select->fetch();

        if ($count) {
            if ($email == 'admin@gmail.com' && $password == '123') {
                $_SESSION['nombre'] = $campo['nombre'];
                header('Location: sesion_admin.php');

            } else {
                $_SESSION['nombre'] = $campo['nombre'];
                header('Location: misesion.php');

            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>VALIDACIÓN:</strong> Usuario no registrado
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
?>

<div class="container-fluid login-container" style="background-color: #f1efe7;">
    <div class="row flex-grow-1">
        <div class="col-md-6 d-none d-md-block login-img">
            <div class="h-100 d-flex flex-column justify-content-center align-items-start p-5 text-white">
                <h1 class="display-4 fw-bold">Disfruta del mejor sabor</h1>
                <a href="index.php" type="button" class="btn btn-outline-light">Regresar</a>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <div class="login-form w-75">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="btn btn-light w-100 active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Ingresar</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="btn btn-light w-100" id="pills-signup-tab" data-bs-toggle="pill" data-bs-target="#pills-signup" type="button" role="tab" aria-controls="pills-signup" aria-selected="false">Regístrate</button>
                </li>
            </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                        <h5 class="text-center mb-4">Ingresa a tu Cuenta</h5>
                        <form method="post">
                            <div class="mb-3">
                                <label>Email</label>
                                <input name="email" class="form-control" placeholder="Ingresa tu email">
                            </div>
                            <div class="mb-3">
                                <label>Contraseña</label>
                                <input name="password"  type="password" class="form-control" placeholder="Ingresa tu contraseña">
                            </div>
                            <button name="login" type="submit" class="btn btn-login w-100">Ingresar</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                        <h5 class="text-center mb-4">Crea tu cuenta</h5>
                        <form method="post">
                            <div class="mb-3">
                                <label>Nombre</label>
                                <input name="nombre" type="text" class="form-control"  placeholder="Ingresa tu Nombre">
                            </div>
                            <div class="mb-3">
                                <label for="signupEmail" class="form-label">Email</label>
                                <input name="email" type="text" class="form-control" placeholder="Ingresa tu email">
                            </div>
                            <div class="mb-3">
                                <label for="signupPassword" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Ingresa una contraseña">
                            </div>
                            <button name="registrar" type="submit" class="btn btn-login w-100">Regístrate</button>

                            <?php
                                if (isset($_POST['registrar'])) 
                                {  
                                    $nombre = $_POST['nombre'];
                                    $email = $_POST['email'];
                                    $password = $_POST['password'];

                                    if (!empty($nombre) && !empty($email) && !empty($password)) {

                                        $sql = $cnnPDO->prepare("INSERT INTO usuarios_proyecto
                                        (nombre, email, password) VALUES (:nombre, :email, :password)");

                                        $sql->bindParam(':nombre', $nombre);
                                        $sql->bindParam(':email', $email);
                                        $sql->bindParam(':password', $password);
                                        $sql->execute();
                                        unset($sql);
                                        unset($cnnPDO);
                            ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Registro</strong> Tus datos fueron enviados.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>

                            <?php
                                    } else {
                            ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Validación</strong> Debes de completar todos los campos
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            <?php
                                    }
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
