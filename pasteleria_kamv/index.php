<?php
session_start();
require "db_conexion.php";

$sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto");
$sql->execute();
$productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<?php 

$mensajeExito = "";
$mensajeError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    try {
        $sql = $cnnPDO->prepare("INSERT INTO contactos (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':mensaje', $mensaje);
        $sql->execute();
        $_SESSION['mensajeExito'] = "¡Tu mensaje fue enviado exitosamente!";
    } catch (PDOException $e) {
        $_SESSION['mensajeError'] = "Hubo un error al enviar el mensaje: " . $e->getMessage();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pastelería Kamv</title>
    <link rel="icon" href="imagenes/favicon.png" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
            <a href="#"><img src="imagenes/logo.jpg" alt="Logo"></a>
        </div>

        <div class="nav-icons i">
            <a href="cuenta.php"><i class="bi bi-person"></i></a>
        </div>

        <!-- Menú desplegable -->
        <div class="dropdown-menu" id="dropdown-menu">
            <a href="#">Inicio</a>
            <a href="cuenta.php">Cuenta</a>
            <a href="#productos">Productos</a>
            <a href="#contacto">Contacto</a>
        </div>
    </nav>

    <script>
        const menuIcon = document.getElementById('menu-icon');
        const dropdownMenu = document.getElementById('dropdown-menu');

        menuIcon.addEventListener('click', () => {
            if (dropdownMenu.style.display === 'flex') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'flex';
            }
        });
    </script>


</body>
</html>
</head>

<div id="banner-lateral" style="position: fixed; left: 0; top: 50px; width: 300px; background-color:#f1efe7; padding: 15px; border: 2px solid black; border-radius: 8px; z-index: 1050; box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);">
    <button id="cerrar-banner" style="position: absolute; top: 5px; right: 5px; border: none; background: none; font-size: 20px; cursor: pointer;">&times;</button>
    <h4 style="text-align: center; color: #877a7c">¡Lunes de mitad de precio en Individuales!</h4>
    <img src="imagenes/banner_promo.png" alt="Promoción" style="width: 100%; border-radius: 15px;"><br><br>
    <p style="text-align: center;">Disfruta un 50% de descuento en postres individuales. Válido online y tienda física.</p>
</div>

<script>
    document.getElementById('cerrar-banner').addEventListener('click', function() {
        document.getElementById('banner-lateral').style.display = 'none';
    });
</script>

<nav class="navbar navbar-expand-lg" style="background-color:#f1efe7; padding-top: 80px;">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold">Pastelería Kamv</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link fw-bold" href="cuenta.php">Más que postres, recuerdos horneados. Adquiérelos aquí.</a>
        </li>
      </ul>
      <!-- Menú de tres puntos -->
      <div class="dropdown">
        <button class="btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-three-dots-vertical"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="#">Idioma</a></li>
          <li><a class="dropdown-item" href="#">Configuración</a></li>
          <li><a class="dropdown-item" href="cuenta.php">Iniciar sesión</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<!-- Agregar Bootstrap Icons si no los tienes -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<!-- sección 1 -->
<div class="hero2-section" id="inicio">
        <div>
            <h1 class="hero2-text">Los mejores pasteles de México</h1>
            <p class="hero2-subtitle">Disfruta de Kamv: el mejor pastel de Saltillo ahora a tu alcance. Pasteles artesanales, calidad insuperable y sabor que conquista paladares.</p>
            <div>
                <a href="cuenta.php" class="btn btn-outline-light">Compra</a>
            </div>
        </div>
        <img src="imagenes/pastel_index_choc.jpg" alt="pastel_index_choc" class="hero2-image">
</div>
 

<!-- mostrar productos -->
<div id="productos" class="container my-5" style="background-color: #f1efe7;">
        <h1>Productos</h1>
        <!-- Mostrar productos -->
        <div class="card custom-card2" style="background-color: #f1efe7;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php 
                $contador = 0;
                foreach ($productos as $producto): 
                    if ($contador >= 3) break;
                ?>
                <div class="col">
                    <div class="card" style="background-color: #f1efe7;">
                        <?php
                        if (!empty($producto['imagen'])) {
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($producto['imagen']) . '" class="card-img-top" style="object-fit: cover; height: 300px;"/>';
                        } else {
                            echo '<img src="ruta/a/imagen_default.jpg" class="card-img-top" style="object-fit: cover; height: 300px;" alt="Imagen no disponible"/>';
                        }
                        ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($producto['prodname']); ?></h5>
                            <p class="card-text">Precio: $<?php echo htmlspecialchars($producto['precio']); ?> pesos</p>      
                            <a href="cuenta.php" class="btn" style="background-color:#c5b4b7; color:white;">Compra</a>
                        </div>
                    </div>
                </div>
                <?php 
                    $contador++;
                endforeach; 
                ?> 
            </div>
        </div>
    </div>

<!-- gif -->
<div class="container text-center my-5"> 
    <img src="imagenes/cakedessert.gif" alt="Preparación de pastel" style="width: 40%; border-radius: 40px;">
</div>

    <div class="container text-center my-5">
        <h3 class="mb-4">Disfruta de nuestra selección de productos estrella</h3>
            <div class="row row-cols-1 row-cols-md-5 g-4">
                <div class="col">
                    <div class="card h-100">
                        <img src="imagenes/pastel_estrella.png" class="card-img-top" alt="pastel" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">Pasteles</h6>
                        </div>
                            </div>
                        </div>
            <div class="col">
                <div class="card h-100">
                        <img src="imagenes/pay_estrella.png" class="card-img-top" alt="pay" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">Pays</h6>
                        </div>
                            </div>
                                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="imagenes/muffin_estrella.png" class="card-img-top" alt="muffin" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                                <h6 class="card-title">Muffins</h6>
                        </div>
                            </div>
                                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="imagenes/brownie_estrella.png" class="card-img-top" alt="brownie" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                                <h6 class="card-title">Brownies</h6>
                        </div>
                            </div>
                                </div>
                <div class="col">
                    <div class="card h-100">
                        <img src="imagenes/galleta_estrella.png" class="card-img-top" alt="galleta" style="height: 150px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">Galletas</h6>
                        </div>
                            </div>
                                </div>
    </div>
</div>

<!-- formulario de contacto -->
<div id="contacto" class="container my-5 p-4" style="background-color: #f1efe7; border-radius: 8px; max-width: 600px;">
        <h3 class="text-center mb-4">Contáctanos</h3>
    
    <?php if (isset($_SESSION['mensajeExito'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['mensajeExito']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['mensajeExito']); ?>
    <?php elseif (isset($_SESSION['mensajeError'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['mensajeError']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['mensajeError']); ?>
    <?php endif; ?>

    <form action="#contacto" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe tu nombre" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email@ejemplo.com" required>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" placeholder="Escribe tu mensaje aquí" required></textarea>
        </div>
        <button type="submit" class="btn w-100" style="background-color: #c5b4b7; color:white;">Enviar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- footer -->
<footer style="background-color: #c5b4b7; bottom: 0; width: 100%;">
        <p>&copy; 2025 Pastelería Kamv. Todos los derechos reservados.</p>
        <a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a>
</footer>

</body>
</html>