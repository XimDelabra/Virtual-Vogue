<?php
session_start();
require "db_conexion.php";
require "cdn.html";

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

$ordenId = $_GET['id'] ?? null;

if (!$ordenId || !is_numeric($ordenId)) {
    echo "ID de la orden inválido.";
    exit();
}

$sql = $cnnPDO->prepare("SELECT * FROM ordenes_compra WHERE id = :orden_id AND nombre_usuario = :nombre_usuario");
$sql->bindParam(':orden_id', $ordenId);
$sql->bindParam(':nombre_usuario', $_SESSION['nombre']);
$sql->execute();
$orden = $sql->fetch(PDO::FETCH_ASSOC);

if (!$orden) {
    echo "Orden no encontrada o no autorizada.";
    exit();
}

$sql = $cnnPDO->prepare("SELECT * FROM detalles_orden WHERE orden_id = :orden_id");
$sql->bindParam(':orden_id', $ordenId);
$sql->execute();
$detalles = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Orden</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .container {
            flex: 1;
        }
        body {
            background-color: #f4f7f9;
            color: #333;
        }
        .navbar {
            background-color: #87b5cd;
        }
        .navbar h3 {
            margin: 0;
            color: white;
        }
        .container h1 {
            color: #555;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #87b5cd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5b97a6;
        }
        footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 20px;
        }
        footer a {
            color: #87b5cd;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <h3>Detalle de Orden</h3>
            <a href="ver_miorden.php" class="btn btn-light">Regresar</a>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h1>Detalle de la Orden #<?php echo htmlspecialchars($orden['id']); ?></h1>

        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Usuario</td>
                        <td><?php echo htmlspecialchars($orden['nombre_usuario']); ?></td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td><?php echo htmlspecialchars($orden['fecha']); ?></td>
                    </tr>
                    <tr>
                        <td>Dirección</td>
                        <td><?php echo htmlspecialchars($orden['direccion']); ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$<?php echo number_format($orden['total_compra'], 2); ?> pesos</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2>Detalles de los Productos</h2>
        <?php if (empty($detalles)): ?>
            <div class="alert alert-info" role="alert">
                No se encontraron detalles para esta orden.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $detalle): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($detalle['prodname']); ?></td>
                                <td><?php echo htmlspecialchars($detalle['cantidad']); ?></td>
                                <td>$<?php echo number_format($detalle['precio'], 2); ?> pesos</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Tu Empresa. Todos los derechos reservados. | <a href="contacto.php">Contacto</a></p>
    </footer>
</body>
</html>
