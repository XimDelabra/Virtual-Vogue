]<?php
    require "cdn.html";
    require "db_conexion.php";

    $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto");
    $sql->execute();
    $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .navbar h3 {
            margin: 0;
            color: white;
        }
        .container {
            flex: 1;
            margin-top: 80px;
            margin-bottom: 20px;
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
        table {
            table-layout: fixed;
        }
        td.text-wrap {
            max-width: 200px;
            word-wrap: break-word;
        }
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
    </style>
</head>
<body style="background-color:#c5b4b7;">
    <nav class="navbar navbar-expand-lg" style="border-bottom: 3px solid black; background-color:#f1efe7; position: fixed; z-index: 1000; width: 100%;">
        <!-- Logo -->
        <div class="logo">
            <a href="sesion_admin.php"><img src="imagenes/logo.jpg" alt="Logo" style="margin-left: 690px;"></a>
        </div>
        <div class="ms-auto">
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="logout.php">Cerrar Sesión</a>
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="sesion_admin.php">Salir</a>
        </div>
    </nav>

    <div class="container">
        <h1 style="color:white;">Inventario de Productos</h1>

        <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['prodname']); ?></td>
                            <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
