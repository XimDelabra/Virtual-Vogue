<?php
    require "cdn.html";
    require "db_conexion.php";

    if (isset($_POST['eliminar'])) {
        $prodname = $_POST['prodname'];
        $sql = $cnnPDO->prepare("DELETE FROM productos_proyecto WHERE prodname = :prodname");
        $sql->bindParam(':prodname', $prodname);
        $sql->execute();
    }

    $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto");
    $sql->execute();
    $productos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Productos</title>
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
            <a href="sesion_admin.php"><img src="imagenes/logo.jpg" alt="Logo" style="margin-left: 690px;"></a>
        </div>
        <div class="ms-auto">
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="logout.php">Cerrar Sesión</a>
            <a class="btn" style="background-color:#c5b4b7; color:white;" href="sesion_admin.php">Salir</a>
        </div>
    </nav>
    <div class="card container" style="margin-top: 80px; margin-bottom: 80px; max-width: 1300px;  background-color:#f1efe7;">
        <div class="card-body" style="background-color:#f1efe7;">
            <h1>Gestionar productos</h1>

            <table class="table table-bordered" style="margin-top: 20px; text-align:center;">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['prodname']); ?></td>
                            <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                            <td><?php echo htmlspecialchars($producto['cantidad']); ?></td>
                            <td>
                                <?php
                                    if (!empty($producto['imagen'])) {
                                        echo '<img src="data:image/jpeg;base64,'.base64_encode($producto['imagen']).'" style="width: 100px; height: auto;"/>';
                                    } else {
                                        echo 'No disponible';
                                    }
                                ?>
                            </td>
                            <td class="text-wrap" style="max-width: 200px;"> <?php echo htmlspecialchars($producto['descripcion']); ?> </td>
                            <td>
                                <a href="editar_producto.php?prodname=<?php echo $producto['prodname']; ?>" class="btn" style="background-color: #f1efe7;">Editar</a>
                                <form method="post" style="display:inline-block;">
                                    <input type="hidden" name="prodname" value="<?php echo $producto['prodname']; ?>">
                                    <button name="eliminar" type="submit" class="btn" style="background-color: #c5b4b7; color:white;">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>

<a href="insertar_productos.php" class="btn" style="background-color:#c5b4b7;">Insertar productos</a>
                    
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
