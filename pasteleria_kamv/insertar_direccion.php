<?php
session_start();
require "cdn.html";
require "db_conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Dirección</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 70px;
        }
        .card {
            border-radius: 0.5rem;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .btn-light {
            background-color: #ffffff;
            border: 1px solid #87b5cd;
        }
        .btn-light:hover {
            background-color: #e9ecef;
            color: #0056b3;
        }
        .alert {
            margin-top: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: auto;
        }
        footer a {
            color: #87b5cd;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
        .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }
        .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .logo img {
            height: 50px;
        }
        .container {
            margin-top: 120px;
        }
    </style>
</head>
<body style="background-color: #f1efe7;">
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
        <!-- Logo centrado -->
        <div class="logo" style="flex-grow: 1; text-align: center;">
            <a href="#"><img src="imagenes/logo.jpg" alt="Logo" style="max-width: 100px; height: auto; margin-left: 110%;"></a>
        </div>

        <div class="navbar-nav ms-auto d-flex align-items-center">
            <a class="btn" style="background-color:#c5b4b7; margin-right:8px;" href="orden_compra.php">Regresar</a>
            <a class="btn" style="background-color:#c5b4b7" href="logout.php">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-body" style="background-color:#f1efe7">
                <h4 class="card-title mb-4" style="text-align: center;">Inserta los datos de la dirección</h4>

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <input name="direccion" type="text" class="form-control" required>
                    </div>
                    <button name="registrar" type="submit" class="btn" style="background-color:#c5b4b7; margin-left:40%;">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['registrar'])) {  
        $direccion = $_POST['direccion'];
        $nombre = $_SESSION['nombre'];

        if (!empty($direccion)) {
            $sql = $cnnPDO->prepare("INSERT INTO direcciones_proyecto (direccion, nombre) VALUES (:direccion, :nombre)");
            $sql->bindParam(':direccion', $direccion);
            $sql->bindParam(':nombre', $nombre);
            $sql->execute();
            unset($sql);
            unset($cnnPDO);
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Éxito</strong> La dirección ha sido guardada correctamente.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Validación</strong> Debes completar todos los campos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
    }
    ?> 

    <footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#" style="color:white;">Política de Privacidad</a> | <a href="#" style="color:white;">Términos de Servicio</a>
    </footer>
</body>
</html>