<?php
require 'db_conexion.php';
include 'navbar.php';
session_start();
#inicia codigo de LOGIN

if (isset($_POST['login'])) {
    $email = $_POST['iptEmail'];
    $password = $_POST['iptPass'];

    if (!empty($email) && !empty($password)){
        $select = $cnnPDO->prepare('SELECT * FROM usuarios WHERE email = ? AND password = ?');
        $select->execute([$email, $password]);
        $existe = $select->rowCount();
        $campo = $select->fetch(PDO::FETCH_ASSOC);

        if($existe){
            if($campo['email']== 'ximena@gmail'){
                header('location: admin_catalogo.php');
            } else{
                $_SESSION['email'] = $campo['email'];
                $_SESSION['nombre'] = $campo['nombre'];
                $_SESSION['apellido'] = $campo['apellido'];
                $_SESSION['password'] = $campo['password'];
                echo "<script>alert('Exito: Haz iniciado sesion, sera redirigido al catalogo en 5 segundos.');</script>";  

                sleep(5);
                header('location: catalogo.php');
            }
        } else {
            echo "<script>alert('Mensaje: La contrasena o el email son incorrectos.');</script>";            
        }
    } else {
        echo "<script>alert('Mensaje: Rellenar todos los campos.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylen</title>
</head>

<body class="blogin">
    <div class="container text-center c-reg-log">
        <h1 class="txt-login1">INICIA SESION</h1>
        <a href="registro.php" class="txt-registro1">O REGISTRATE</a>
        <div class="container c-login">
            <form class="row g-3 f-login" method="POST" action="">
                <div class="col-12">
                    <input type="email" class="form-control form-control-lg" id="iptEmail" name="iptEmail" placeholder="Email">
                </div>
                <div class="col-12">
                    <input type="password" class="form-control form-control-lg" id="iptPass" name="iptPass" placeholder="Contrasena">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-lg btn-login" name="login">ACEPTAR</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>