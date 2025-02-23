<?php
require "cdn.html";
require "db_conexion.php";
session_start();

if (isset($_SESSION['prodname'])) {
    $prodname = ($_SESSION['prodname']);

    $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto WHERE prodname = :prodname");
    $sql->bindParam(':prodname', $prodname, PDO::PARAM_STR);
    $sql->execute();
    $producto = $sql->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        $nombre = htmlspecialchars($producto['prodname']);
        $precio = htmlspecialchars($producto['precio']);
        $cantidad = htmlspecialchars($producto['cantidad']);
        $imagen = $producto['imagen'];
        $descripcion = htmlspecialchars($producto['descripcion']);
    } else {
        echo "Producto no encontrado.";
        exit;
    }
} else {
    echo "No se especificó ningún producto.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
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
        <a href="#"><img src="imagenes/logo.jpg" alt="Logo" style="max-width: 100px; height: auto; margin-left: 50%;"></a>
    </div>

    <div class="navbar-nav ms-auto d-flex align-items-center">
        <a class="btn" style="background-color:#c5b4b7; margin-right:8px;" href="misesion.php">Regresar</a>
        <a class="btn" style="background-color:#c5b4b7" href="logout.php">Cerrar Sesión</a>
    </div>
</nav>


<div class="container my-5">
    <div class="card custom-card2" style="background-color: #f1efe7;">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if (!empty($imagen)) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($imagen) . '" class="product-image" alt="Imagen del producto"/>';
                    } else {
                        echo '<img src="ruta/a/imagen_default.jpg" class="product-image" alt="Imagen no disponible"/>';
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <div class="product-details">
                        <br>
                        <h2><?php echo $nombre; ?></h2>
                        <p>$<?php echo $precio; ?></p>
                        <p><strong>Cantidad disponible:</strong> <?php echo $cantidad; ?></p>
                        <p><?php echo $descripcion; ?></p>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <select name="cantidad" id="cantidad" class="product-quantity">
                                    <?php for ($i = 1; $i <= $cantidad; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn" name="agregar_al_carrito" style="background-color: #c5b4b7; color:white">Agregar al carrito</button>
                        </form>
                    </div><br>
                </div><br>
            </div><br>
        </div><br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cantidad'])) {
            $cantidad_seleccionada = $_POST['cantidad'];
        
            if ($cantidad_seleccionada > $cantidad) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>VALIDACIÓN:</strong> La cantidad seleccionada excede la disponible.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } else {
                $producto_en_carrito = [
                    'prodname' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad_seleccionada,
                    'total' => $precio * $cantidad_seleccionada,
                    'imagen' => base64_encode($imagen)
                ];
        
                if (!isset($_SESSION['carrito'])) {
                    $_SESSION['carrito'] = [];
                }
        
                $producto_existe = false;
                foreach ($_SESSION['carrito'] as &$producto) {
                    if ($producto['prodname'] == $producto_en_carrito['prodname']) {
                        if ($producto['cantidad'] + $producto_en_carrito['cantidad'] > $cantidad) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>VALIDACIÓN:</strong> La cantidad seleccionada excede la disponible.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        } else {
                            $producto['cantidad'] += $producto_en_carrito['cantidad'];
                            $producto['total'] = $producto['precio'] * $producto['cantidad'];
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>ÉXITO:</strong> El producto se ha agregado al carrito.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }
                        $producto_existe = true;
                    }
                }
                if (!$producto_existe) {
                    $_SESSION['carrito'][] = $producto_en_carrito;
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>ÉXITO:</strong> El producto se ha agregado al carrito.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
            }
        }
        ?>
    </div>
</div>

<footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a>
</footer>

</body>
</html>
