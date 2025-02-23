<?php
session_start();
require "cdn.html";
require "db_conexion.php";

$sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto");
$sql->execute();
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['eliminar_producto'])) {
    $indice = $_POST['eliminar_producto'];
    
    if (isset($_SESSION['carrito'][$indice])) {
        unset($_SESSION['carrito'][$indice]);
    }
}

if (isset($_POST['prodname'])) {
    $_SESSION['prodname'] = $_POST['prodname'];
    header("Location: ver_producto.php");
}

if (isset($_POST['comprar'])) {
        
        header("Location: confirmar_compra.php");
    
}

if (isset($_GET['buscar'])) {
  $buscar = $_GET['buscar'];
  $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto WHERE prodname LIKE :buscar");
  $sql->execute([':buscar' => "%" . $buscar . "%"]);
} else {
  $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto");
  $sql->execute();
}
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto Final</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
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
    </style>
</head>

<body style="background-color:#f1efe7;">
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
        <!-- Menú de hamburguesa -->
        <div class="menu-icon" id="menu-icon">☰</div>
        
        <!-- Logo -->
        <div class="logo">
            <a href="#"><img src="imagenes/logo.jpg" alt="Logo" style="margin-left: 460px;"></a>
        </div>

        <div class="nav-icons i">
            <a href="cuenta.php"><i class="bi bi-person"></i></a>
        </div>

        <form class="d-flex" action="" method="get">
          <input class="form-control me-2" type="search" name="buscar" placeholder="Buscar productos" aria-label="Search" style="margin-top: 7px;">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>


        <!-- Menú desplegable -->
        <div class="dropdown-menu" id="dropdown-menu">
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Carrito</a>
            <a href="ver_miorden.php">Órdenes de compra</a>
            <a href="logout.php">Cerrar sesión</a>
        </div>
    </nav>
 
<!-- <nav class="navbar navbar-expand-lg" style="background-color: #87b5cd;">
    <div class="container-fluid">
        <div class="navbar-text me-auto text-light">
        <a class="nav-link text-light me-3 d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <img src="imagenes/logo.png" alt="Logo" style="height: 2.5rem; margin-right: 0.5rem;">
                <h3 style="color: white;">Bienvenido <?php echo htmlspecialchars($_SESSION['nombre']); ?></h3> 
            </a>
        
            
        </div>
        <div class="navbar-nav ms-auto d-flex align-items-center">
            <a class="nav-link text-light me-3 d-flex align-items-center" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <img src="imagenes/carrito.png" alt="Icono" style="height: 2.5rem; margin-right: 1.rem;">
                
            </a>
            <a class="btn btn-light" href="logout.php">Cerrar Sesión</a>
        </div>
    </div>
</nav> -->

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel" style="margin-top: 7px;">Carrito de compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="background-color:#f1efe7;">
        <form action="" method="post">
            <ul class="list-group">
                <?php foreach ($_SESSION['carrito'] as $index => $item): ?>
                    <li class="list-group-item d-flex align-items-center">
                        <img src="data:image/jpeg;base64,<?php echo htmlspecialchars($item['imagen']); ?>" alt="Imagen del producto" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                        <div>
                            <strong><?php echo htmlspecialchars($item['prodname']); ?></strong><br>
                            Cantidad: <?php echo htmlspecialchars($item['cantidad']); ?><br>
                            Precio total: $<?php echo htmlspecialchars($item['total']); ?> pesos
                        </div>
                        <button type="submit" name="eliminar_producto" value="<?php echo $index; ?>" class="btn" style="background-color:#c5b4b7; color:white; margin-left: 15px">Eliminar</button>
                    </li>
                <?php endforeach; ?>
            </ul>
                <button type="submit" name="comprar" class="btn" style="background-color:#c5b4b7; color:white; margin-top: 15px">Comprar</button>
        </form>
    </div>
</div>

<nav class="navbar navbar-expand-lg" style="background-color: #fdfefe;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" style="color: black;" href="#">Mi Amigo de Cuatro Patas</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-bold active" aria-current="page" href="#">Tienda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="ver_miorden.php">Ordenes de Compra</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-bold" href="pdf_politicas.html">Políticas de la Empresa</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="banner" style="position: relative; width: 100%; height: 250px; background-image: url('imagenes/banner_misesion.png'); background-size: cover; background-position: center;">
    <div class="banner-text" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 26px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); text-align: center;">
        Bienvenido a nuestra pastelería.<br>Donde la nostalgia es horneada.
    </div>
</div>


<div id="productos" class="container my-5" style="background-color: #f1efe7;">
        <h1 style="margin-left: 40px;">Nuestros productos</h1>
    <div class="card custom-card2">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($productos as $producto): ?>
            <div class="col">
                <div class="card">
                    <?php
                    if (!empty($producto['imagen'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($producto['imagen']) . '" class="card-img-top" style="object-fit: cover; height: 350px;"/>';
                    } else {
                        echo '<img src="ruta/a/imagen_default.jpg" class="card-img-top" style="object-fit: cover; height: 200px;" alt="Imagen no disponible"/>';
                    }
                    ?>
                    <div class="card-body" style="background-color: #f1efe7;">
                        <h5 class="card-title"><?php echo htmlspecialchars($producto['prodname']); ?></h5>
                        <p class="card-text">Precio: $<?php echo htmlspecialchars($producto['precio']); ?> pesos</p>
                        
                        <form action="" method="post">
                            <input type="hidden" name="prodname" value="<?php echo htmlspecialchars($producto['prodname']); ?>">
                            <button type="submit" class="btn" style="background-color:#c5b4b7; color:white;">Ver producto</button>
                        </form>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a>
</footer>

<script>
    const menuIcon = document.getElementById('menu-icon');
    const dropdownMenu = document.getElementById('dropdown-menu');

    menuIcon.addEventListener('click', () => {
        dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });
</script>

</body>
</html>