<?php
session_start();
require "db_conexion.php";
require "cdn.html";

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    ?> 
    <div class="card container mt-5 mb-5" style="max-width: 600px;">
        <div class="card-body">
            <h1>No hay productos en la orden.</h1>
        </div>
    </div>
    <?php
    exit();
}

$totalCompra = 0;
foreach ($_SESSION['carrito'] as $item) {
    $totalCompra += $item['total']; 
}

$metodoPago = '';
$numeroTarjeta = '';
$banco = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['metodo_pago']) && $_POST['metodo_pago'] === 'Tarjeta') {
        $metodoPago = 'Tarjeta';
        $nombre = $_SESSION['nombre'];

        $sql = $cnnPDO->prepare("SELECT ntarjeta, banco FROM usuarios_proyecto WHERE nombre = :nombre");
        $sql->bindParam(':nombre', $nombre);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $usuario['ntarjeta']) {
            $numeroTarjeta = $usuario['ntarjeta'];
            $banco = $usuario['banco'];
        } else {
            header("Location: insertar_tarjeta.php");
            exit();
        }
    } elseif (isset($_POST['metodo_pago']) && $_POST['metodo_pago'] === 'En Tienda') {
        $metodoPago = 'Tienda';
        $numeroTarjeta = null;
    }

    $direccionSeleccionada = $_POST['direccion'] ?? '';

    if (isset($_SESSION['nombre']) && !empty($direccionSeleccionada)) {
        $nombreUsuario = $_SESSION['nombre'];
        $fecha = date('Y-m-d H:i:s');

        $sql = $cnnPDO->prepare("INSERT INTO ordenes_compra (nombre_usuario, fecha, total_compra, direccion) VALUES (:nombre_usuario, :fecha, :total_compra, :direccion)");
        $sql->bindParam(':nombre_usuario', $nombreUsuario);
        $sql->bindParam(':fecha', $fecha);
        $sql->bindParam(':total_compra', $totalCompra);
        $sql->bindParam(':direccion', $direccionSeleccionada);
        $sql->execute();
        $ordenId = $cnnPDO->lastInsertId();

        foreach ($_SESSION['carrito'] as $item) {
            $sql = $cnnPDO->prepare("INSERT INTO detalles_orden (orden_id, prodname, cantidad, precio) VALUES (:orden_id, :prodname, :cantidad, :precio)");
            $sql->bindParam(':orden_id', $ordenId);
            $sql->bindParam(':prodname', $item['prodname']);
            $sql->bindParam(':cantidad', $item['cantidad']);
            $sql->bindParam(':precio', $item['total']);
            $sql->execute();

            $sql = $cnnPDO->prepare("UPDATE productos_proyecto SET cantidad = cantidad - :cantidad WHERE prodname = :prodname");
            $sql->bindParam(':cantidad', $item['cantidad']);
            $sql->bindParam(':prodname', $item['prodname']);
            $sql->execute();
        }

        unset($_SESSION['carrito']);
        header("Location: gracias.php");
        exit();
    }
}

$direcciones = [];
if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
    $sql = $cnnPDO->prepare("SELECT direccion FROM direcciones_proyecto WHERE nombre = :nombre");
    $sql->bindParam(':nombre', $nombre);
    $sql->execute();
    $direcciones = $sql->fetchAll(PDO::FETCH_ASSOC);
}

$tarjetas = [];
if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
    $sql = $cnnPDO->prepare("SELECT ntarjeta FROM usuarios_proyecto WHERE nombre = :nombre");
    $sql->bindParam(':nombre', $nombre);
    $sql->execute();
    $tarjetas = $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
    <style>
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        footer a {
            color: #87b5cd;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        .container-custom {
            max-width: 300px;
            margin: auto;
        }
        .product-image {
            height: 200px;
            object-fit: cover;
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
            <a class="btn" style="background-color:#c5b4b7; margin-right:8px;" href="confirmar_compra.php">Regresar</a>
            <a class="btn" style="background-color:#c5b4b7" href="logout.php">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container text-center mt-5">
    <h1 class="mb-4" style="margin-top: 100px;">Orden</h1>
    <?php foreach ($_SESSION['carrito'] as $item): ?>
        <div class="card mb-3 container-custom" style="background-color: #f1efe7;">
            <div class="row g-0">
                <div class="col-12 text-center">
                    <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($item['imagen']); ?>" 
                         class="product-image img-fluid rounded" alt="Imagen del producto">
                </div>
                <div class="col-12">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($item['prodname']); ?></h5>
                        <p class="card-text">Cantidad: <?php echo htmlspecialchars($item['cantidad']); ?></p>
                        <p class="card-text">Precio total: $<?php echo htmlspecialchars($item['total']); ?> pesos</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <div class="container text-center mt-5">
    <form method="post" action="" class="container-custom">
        <h4 class="mb-3">Método de pago</h4>
        <div class="card mb-3">
            <div class="card-body text-center" style="background-color: #f1efe7;">
                <?php if (!empty($tarjetas)): ?>
                    <ul class="list-group">
                        <?php foreach ($tarjetas as $tarjeta): ?>
                            <li class="list-group-item">
                                <input type="radio" name="metodo_pago" value="Tarjeta" required>
                                <?php echo htmlspecialchars($tarjeta['ntarjeta']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No tienes una tarjeta guardada.</p>
                <?php endif; ?>
                <a href="insertar_tarjeta.php" class="btn btn-sm mt-2" style="background-color:#c5b4b7">Agregar tarjeta</a>
            </div>
        </div>

        <h4 class="mb-3">Dirección de Envío</h4>
        <div class="card mb-3">
            <div class="card-body text-center" style="background-color: #f1efe7;">
                <?php if (!empty($direcciones)): ?>
                    <ul class="list-group">
                        <?php foreach ($direcciones as $direccion): ?>
                            <li class="list-group-item">
                                <input type="radio" name="direccion" value="<?php echo htmlspecialchars($direccion['direccion']); ?>" required>
                                <?php echo htmlspecialchars($direccion['direccion']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No tienes direcciones guardadas.</p>
                <?php endif; ?>
                <a href="insertar_direccion.php" class="btn btn-sm mt-2" style="background-color:#c5b4b7">Agregar dirección</a>
            </div>
        </div>

        <h3>Total: $<?php echo number_format($totalCompra, 2); ?> pesos</h3>
        <button type="submit" class="btn btn-sm mt-3" style="background-color:#c5b4b7">Confirmar orden</button>
    </form>
</div>
    <br>
    <footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#" style="color:white;">Política de Privacidad</a> | <a href="#" style="color:white;">Términos de Servicio</a>
    </footer>
</body>
</html>