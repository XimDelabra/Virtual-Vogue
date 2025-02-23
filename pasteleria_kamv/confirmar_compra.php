<?php
session_start();
require "cdn.html";
require "db_conexion.php";

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<nav class='navbar navbar-expand-lg' style='border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;'>

    <div class='logo' style='flex-grow: 1; text-align: center;'>
        <a href='#'><img src='imagenes/logo.jpg' alt='Logo' style='max-width: 100px; height: auto; margin-left: 10%;'></a>
    </div>

    <div class='navbar-nav ms-auto d-flex align-items-center'>
        <a class='btn' style='background-color:#c5b4b7; margin-right:8px;' href='misesion.php'>Regresar</a>
        <a class='btn' style='background-color:#c5b4b7' href='logout.php'>Cerrar Sesión</a>
    </div>
</nav>
    <div class='banner' style='position: relative; width: 100%; height: 100px; background-image: url(\"imagenes/banner_misesion.png\"); background-size: cover; background-position: center; padding-top: 695px;'>
        <div class='banner-text' style='position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 26px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); text-align: center; padding-top: 80px;'>
            El carrito se encuentra vacío.
        </div>
    </div>
";
    exit;
}

foreach ($_SESSION['carrito'] as $index => $item) {
    if (isset($item['prodname'])) {
        $prodname = $item['prodname'];

        $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto WHERE prodname = :prodname");
        $sql->bindParam(':prodname', $prodname, PDO::PARAM_STR);
        $sql->execute();
        $producto = $sql->fetch(PDO::FETCH_ASSOC);
        
        if ($producto) {
            $_SESSION['carrito'][$index]['cantidad_disponible'] = htmlspecialchars($producto['cantidad']);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];
    $index = (int)$_POST['index'];

    if ($accion === 'eliminar') {
        array_splice($_SESSION['carrito'], $index, 1);
    } elseif ($accion === 'editar') {
        $nueva_cantidad = (int)$_POST['nueva_cantidad'];
        $_SESSION['carrito'][$index]['cantidad'] = $nueva_cantidad;
        $_SESSION['carrito'][$index]['total'] = $_SESSION['carrito'][$index]['precio'] * $nueva_cantidad;
    }

    header('Location: confirmar_compra.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .card {
            max-width: 540px;
            width: 100%;
        }
        .custom-card {
            background-image: url('imagenes/imagen index.avif'); 
            color: black; 
            border-radius: 45px; 
            text-align: center; 
            padding: 40px; 
            margin-bottom: 20px;
        }
        .custom-card h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .btn-edit {
            background-color: #ffc107;
            color: black;
            border: none;
        }
        .btn-edit:hover {
            background-color: #e0a800;
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
        .product-image {
            width: 100%;
            height: auto;
            max-width: 400px;
        }
        .product-details h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-details p {
            font-size: 16px;
        }
        .product-details p:last-child {
            font-size: 14px;
            font-weight: lighter;
            text-align: justify;
        }
        .product-quantity {
            margin-top: 10px;
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            font-size: 14px;
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

    </style>
</head>
<body style="background-color: #f1efe7;">

<nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
    <!-- Logo centrado -->
    <div class="logo" style="flex-grow: 1; text-align: center;">
        <a href="#"><img src="imagenes/logo.jpg" alt="Logo" style="max-width: 100px; height: auto; margin-left: 110%;"></a>
    </div>

    <div class="navbar-nav ms-auto d-flex align-items-center">
        <a class="btn" style="background-color:#c5b4b7; margin-right:8px;" href="misesion.php">Regresar</a>
        <a class="btn" style="background-color:#c5b4b7" href="logout.php">Cerrar Sesión</a>
    </div>
</nav>
    <div class="banner" style="position: relative; width: 100%; height: 100px; background-image: url('imagenes/banner_misesion.png'); background-size: cover; background-position: center; padding-top: 170px;">
        <div class="banner-text" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 26px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); text-align: center; padding-top: 80px;">
            ¡Gracias por comprar con nosotros!<br>Revisa tu pedido.
        </div>
    </div>
    
    <div class="container card-container flex-grow-1">
        <h1 style="margin-top: -55px;">Productos</h1>
        <?php foreach ($_SESSION['carrito'] as $index => $item): ?>
            <div class="card mb-3" style="background-color: #f1efe7;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($item['imagen']); ?>" class="product-image rounded-start" alt="Imagen del producto">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['prodname']); ?></h5>
                            <p class="card-text">Cantidad: <?php echo htmlspecialchars($item['cantidad']); ?></p>
                            <p class="card-text">Precio total: $<?php echo htmlspecialchars($item['total']); ?> pesos</p>

                            <form action="confirmar_compra.php" method="POST">
                                <input type="hidden" name="accion" value="editar">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <div class="mb-3">
                                    <label for="nueva_cantidad" class="form-label mb-0">Cantidad:</label>
                                    <select id="nueva_cantidad" name="nueva_cantidad" class="form-select form-select-sm" style="max-width: 120px;">
                                        <?php for ($i = 1; $i <= $item['cantidad_disponible']; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php echo $i == $item['cantidad'] ? 'selected' : ''; ?>>
                                                <?php echo $i; ?>
                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-edit" style="background-color:#c5b4b7; color:white;">Editar</button>
                                    <button type="submit" formaction="confirmar_compra.php" name="accion" value="eliminar" class="btn" style="background-color:#c5b4b7; color:white;">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>       
        <div>
            <form action="orden_compra.php" method="POST">
                <button type="submit" class="btn" style="background-color:#c5b4b7; color:white">Proceder al pago</button>
                <a href="misesion.php" class="btn">Regresar</a>
            </form>
        </div>
        <br>
    </div>
    
    <footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a>
    </footer>
</body>
</html>
