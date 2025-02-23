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
    <title>Insertar Tarjeta de Crédito</title>
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
            margin: 20px auto;
            max-width: 600px;
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
            <div class="card-body" style="background-color: #f1efe7;">
                <h4 class="card-title mb-4" style="text-align: center;">Inserta los datos de tu tarjeta</h4>

                <form method="post">
                    <div class="mb-3">
                        <label for="ntarjeta" class="form-label">Número de tarjeta</label>
                        <input name="ntarjeta" type="text" class="form-control" id="ntarjeta" required>
                    </div>
                    <div class="mb-3">
                        <label for="banco" class="form-label">Banco</label>
                        <select name="banco" class="form-select" id="banco" required>
                            <option value="" selected disabled>Selecciona un Banco</option>
                            <option value="BBVA">BBVA</option>
                            <option value="Banamex">Banamex</option>
                            <option value="Santander">Santander</option>
                            <option value="Banorte">Banorte</option>
                            <option value="HSBC">HSBC</option>
                        </select>
                    </div>
                    <button name="registrar" type="submit" class="btn" style="background-color:#c5b4b7; margin-left:40%;">Guardar</button>
                </form>
            </div>
        </div>
    </div>

    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['ntarjeta']) && !empty($_POST['banco']) && isset($_SESSION['nombre'])) {
        $nombre = $_SESSION['nombre'];
        $ntarjeta = $_POST['ntarjeta'];
        $banco = $_POST['banco'];

        $sql = $cnnPDO->prepare("UPDATE usuarios_proyecto SET ntarjeta = :ntarjeta, banco = :banco WHERE nombre = :nombre");
        $sql->bindParam(':ntarjeta', $ntarjeta);
        $sql->bindParam(':banco', $banco);
        $sql->bindParam(':nombre', $nombre);
        
        if ($sql->execute()) {
            header("Location: orden_compra.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Error al guardar la tarjeta.</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Todos los campos son obligatorios.</div>";
    }
}
    ?>

    <footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#" style="color:white;">Política de Privacidad</a> | <a href="#" style="color:white;">Términos de Servicio</a>
    </footer>
</body>
</html>