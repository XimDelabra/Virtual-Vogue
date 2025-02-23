<?php
session_start();
require "db_conexion.php";
require "cdn.html";

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$nombreUsuario = $_SESSION['nombre'];

$sql = $cnnPDO->prepare("SELECT * FROM ordenes_compra WHERE nombre_usuario = :nombre_usuario ORDER BY fecha DESC");
$sql->bindParam(':nombre_usuario', $nombreUsuario);
$sql->execute();
$ordenes = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Órdenes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 3px 10px;
            border-bottom: 1px solid #ddd;
            position: fixed;
            top: 0;
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
        .nav-icons {
            display: flex;
            gap: 20px;
        }
        .nav-icons i {
            font-size: 20px;
            cursor: pointer;
        }
        .dropdown-menu {
            display: none;
            flex-direction: column;
            position: absolute;
            top: 60px;
            left: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .dropdown-menu a {
            text-decoration: none;
            padding: 10px 20px;
            color: #333;
            border-bottom: 1px solid #ddd;
        }
        .dropdown-menu a:hover {
            background-color: #f4f4f4;
        }
        @media (max-width: 768px) {
            .menu-icon {
                display: block;
            }
            .nav-icons {
                display: none;
            }
        }
        .logo img {
        width: 120px;
        height: auto;
        }

        .container h1 {
        font-size: 36px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        }
        footer {
            background-color: #c5b4b7;
            position: relative;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body style="background-color:#c5b4b7;">
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
        <!-- Logo -->
        <div class="logo">
            <a href="misesion.php"><img src="imagenes/logo.jpg" alt="Logo" style="margin-left: 690px;"></a>
        </div>
        <div class="ms-auto">
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="logout.php">Cerrar Sesión</a>
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="misesion.php">Regresar</a>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h1>Órdenes de compra</h1>
        <?php if (empty($ordenes)): ?>
            <div class="alert alert-info" role="alert">
                No tienes órdenes de compra.
            </div>
        <?php else: ?>
            <?php foreach ($ordenes as $orden): ?>
                <div class="card mb-3" style="background-color: #f1efe7;">
                    <div class="card-body">
                        <h5 class="card-title">Orden #<?php echo htmlspecialchars($orden['id']); ?></h5>
                        <p class="card-text">Fecha: <?php echo htmlspecialchars($orden['fecha']); ?></p>
                        <p class="card-text">Dirección: <?php echo htmlspecialchars($orden['direccion']); ?></p>
                        <p class="card-text">Total: $<?php echo number_format($orden['total_compra'], 2); ?> pesos</p>
                        <!-- <a href="ver_detalle_orden.php?id=<*?php echo htmlspecialchars($orden['id']); ?*>" class="btn btn-primary">Ver Detalles</a> quitar asteriscos para utilizar--> 
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#" style="color: white;">Política de Privacidad</a> | <a href="#" style="color: white;">Términos de Servicio</a>
    </footer>
</body>
</html>
