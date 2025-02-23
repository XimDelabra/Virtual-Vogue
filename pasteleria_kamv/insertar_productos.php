<?php
    require "cdn.html";
    require "db_conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.js"></script>
</head>
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
        label {
    font-size: 18px;
        }
    </style>

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

    <div class="card container" style="margin-top: 70px; margin-bottom: 80px; max-width: 600px;" >
<div class="card-body" style="background-color: #f1efe7;">
    <h1>Insertar productos<h1>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nombre del producto</label>
            <input name="prodname" type="text" class="form-control">
            <br>
            <label>Precio</label>
                <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input name="precio" type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            <label>Cantidad</label>
            <input name="cantidad" type="number" class="form-control">
            <br>
            <div class="mb-3">
                <label class="form-label">Foto del Producto</label>
                <input name="imagen" type="file" class="form-control">
            </div>
            <label>Descripción del Producto</label>
            <input name="descripcion" type="text" class="form-control">    
            <button name="registrar" type="submit" class="btn" style="background-color:#c5b4b7; color:white;">Registrar</button>
            <a href="gestionar_productos.php" type="submit" class="btn" style="background-color:#c5b4b7; color:white;">Edita Productos</a>
    </form>

    <?php
        if (isset($_POST['registrar'])) 
        {  
            $prodname = $_POST['prodname'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];

            if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $size = getimagesize($_FILES["imagen"]["tmp_name"]);

                if (!empty($prodname) && !empty($precio) && !empty($cantidad) && ($size !== false)) {
                    
                    $cargarImagen = $_FILES['imagen']['tmp_name'];
                    $imagen = fopen($cargarImagen,'rb');

                    $sql = $cnnPDO->prepare("INSERT INTO productos_proyecto
                    (prodname, precio, cantidad, imagen, descripcion) VALUES (:prodname, :precio, :cantidad, :imagen, :descripcion)");

                    $sql->bindParam(':prodname', $prodname);
                    $sql->bindParam(':precio', $precio);
                    $sql->bindParam(':cantidad', $cantidad);
                    $sql->bindParam(':imagen',$imagen, PDO::PARAM_LOB);
                    $sql->bindParam(':descripcion', $descripcion);
                    $sql->execute();
                    unset($sql);
                    unset($cnnPDO);
    ?>

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>REGISTRO</strong> Tus datos fueron enviados.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php
            } else {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>VALIDACIÓN </strong> Debes de completar todos los campos o subir una imagen válida.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            }
        } else {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR DE SUBIDA</strong> Hubo un problema al subir la imagen.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            }
        }
        ?>


</div>
</div>
</body>
</html>