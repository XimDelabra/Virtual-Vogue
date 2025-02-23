<?php
session_start();
require "db_conexion.php";

if (isset($_SESSION['nombre'])) {
    $nombreUsuario = $_SESSION['nombre'];

    $sql = $cnnPDO->prepare("SELECT id FROM ordenes_compra WHERE nombre_usuario = :nombre_usuario ORDER BY fecha DESC LIMIT 1");
    $sql->bindParam(':nombre_usuario', $nombreUsuario);
    $sql->execute();
    $orden = $sql->fetch(PDO::FETCH_ASSOC);

    if ($orden) {
        $ordenId = $orden['id'];
        $sql = $cnnPDO->prepare("SELECT * FROM detalles_orden WHERE orden_id = :orden_id");
        $sql->bindParam(':orden_id', $ordenId);
        $sql->execute();
        $detallesOrden = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por tu Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
            padding: 5px 10px;
            border-bottom: 1px solid #ddd;
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
        width: 110px;
        height: auto;
        }

        .container h1 {
        font-size: 36px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        }
        html, body {
        height: 100%;
        display: flex;
        flex-direction: column;
        }
        .container {
            flex: 1;
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

<body style="background-color:#f1efe7;">
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
        <!-- Logo -->
        <div class="logo">
            <a href="misesion.php"><img src="imagenes/logo.jpg" alt="Logo" style="margin-left:680px;"></a>
        </div>
        <a class="btn" style="background-color:#c5b4b7" href="logout.php">Cerrar Sesión</a>
    </nav>


<div class="card container" style="margin-top: 70px; margin-bottom: 20px; max-width: 600px; background-color:#f1efe7;">
  <div class="card-body">
   <div class="container mt-5">
        <h1>¡Gracias por tu compra!</h1>
        <p style="text-align: center;">Tu pedido ha sido recibido y está siendo procesado.<br>Aquí están los detalles de tu orden:</p>
        
        <?php if (isset($ordenId) && !empty($detallesOrden)): ?>
            <h4 style="text-align: center;">Resumen de la orden</h4>
            <div class="card mb-3">
                <div class="card-body" style="background-color:#f1efe7;">
                    <h5 class="card-title" style="text-align: center;">Número de orden: <?php echo htmlspecialchars($ordenId); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="text-align: center;">Fecha: <?php echo date('d/m/Y'); ?></h6>
                    <ul class="list-group mt-3">
                        <?php foreach ($detallesOrden as $detalle): ?>
                            <li class="list-group-item">
                                <?php echo htmlspecialchars($detalle['prodname']); ?> - Cantidad: <?php echo htmlspecialchars($detalle['cantidad']); ?> - Precio: $<?php echo htmlspecialchars($detalle['precio']); ?> pesos
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <p>No se pudieron recuperar los detalles de la orden.</p>
        <?php endif; ?>
        <div class="text-center">
            <a href="misesion.php" class="btn" style="background-color:#c5b4b7;">Regresar a la tienda</a>
        </div>
    </div>
  
  </div>
</div>

<footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#" style="color: white;">Política de Privacidad</a> | <a href="#" style="color: white;">Términos de Servicio</a>
</footer>
    
</body>
</html>
