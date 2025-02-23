<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src=".https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
<body style="background-color:#c5b4b7;">
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
        <!-- Menú de hamburguesa -->
        <div class="menu-icon" id="menu-icon">☰</div>

        <!-- Logo -->
        <div class="logo">
            <a href="index.php"><img src="imagenes/logo.jpg" alt="Logo" style="margin-left: 650px;"></a>
        </div>
        <div class="ms-auto">
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="logout.php">Cerrar Sesión</a>
        </div>
        <div class="dropdown-menu" id="dropdown-menu">
            <a href="insertar_productos.php">Insertar</a>
            <a href="gestionar_productos.php">Gestionar</a>
            <a href="inventario.php">Inventario</a>
            <a href="ver_orden_admin.php">Órdenes</a>
        </div>
    </nav>

<div class="banner" style="position: relative; width: 100%; height: 110px; background-image: url('imagenes/banner_misesion.png'); background-size: cover; background-position: center;">
    <div class="banner-text" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 26px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); text-align: center; margin-top:35px;">
        Acciones administrativas
    </div>
</div>

<div class="card container" style="margin-top: 10px;">
        <div class="card-body" style="background-color: #f1efe7;">
            <div class="container text-center">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <div class="col">
                        <div class="card card-custom">
                            <img src="imagenes/insertar.webp" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="insertar_productos.php" type="button" class="btn btn-outline-secondary" style="background-color:#f1efe7;">Insertar productos</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-custom">
                            <img src="imagenes/gestion.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="gestionar_productos.php" type="button" class="btn btn-outline-secondary" style="background-color:#f1efe7;">Gestionar productos</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-custom">
                            <img src="imagenes/inventario.webp" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="inventario.php" type="button" class="btn btn-outline-secondary" style="background-color:#f1efe7;">Ver inventario</a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card card-custom">
                            <img src="imagenes/compra.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="ver_orden_admin.php" type="button" class="btn btn-outline-secondary" style="background-color:#f1efe7;">Ver órdenes de compra</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>

<script>
    const menuIcon = document.getElementById('menu-icon');
    const dropdownMenu = document.getElementById('dropdown-menu');

    menuIcon.addEventListener('click', () => {
        dropdownMenu.style.display = dropdownMenu.style.display === 'flex' ? 'none' : 'flex';
    });
</script>

</body>
</html>
