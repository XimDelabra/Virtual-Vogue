<?php
    require "cdn.html";
    require "db_conexion.php";

    if (isset($_GET['prodname'])) {
        $prodname = $_GET['prodname'];

        $sql = $cnnPDO->prepare("SELECT * FROM productos_proyecto WHERE prodname = :prodname");
        $sql->bindParam(':prodname', $prodname);
        $sql->execute();
        $producto = $sql->fetch(PDO::FETCH_ASSOC);

        if (!$producto) {
            echo "Producto no encontrado.";
            exit;
        }
    } else {
        echo "Producto no especificado.";
        exit;
    }

    if (isset($_POST['actualizar'])) {
        $nuevo_prodname = $_POST['prodname'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $imagen = $producto['imagen'];
        $descripcion = $_POST['descripcion'];

        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $size = getimagesize($_FILES["imagen"]["tmp_name"]);

            if ($size !== false) {
                $cargarImagen = $_FILES['imagen']['tmp_name'];
                $imagen = fopen($cargarImagen, 'rb');
            }
        }

        $sql = $cnnPDO->prepare("UPDATE productos_proyecto SET prodname = :nuevo_prodname, precio = :precio, cantidad = :cantidad, imagen = :imagen, descripcion = :descripcion WHERE prodname = :prodname");
        $sql->bindParam(':nuevo_prodname', $nuevo_prodname);
        $sql->bindParam(':precio', $precio);
        $sql->bindParam(':cantidad', $cantidad);
        $sql->bindParam(':descripcion', $descripcion);
        $sql->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
        $sql->bindParam(':prodname', $prodname);
        $sql->execute();

        header("Location: gestionar_productos.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
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
        .card {
            max-width: 600px;
            margin-top: 80px;
            margin-bottom: 80px;
        }
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

    <div class="card container">
        <div class="card-body" style="text-align: center; background-color:#f1efe7">
            <h1>Edita el producto</h1>

            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nombre del Producto</label>
                    <input name="prodname" type="text" class="form-control" value="<?php echo htmlspecialchars($producto['prodname']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">$</span>
                        <input name="precio" type="text" class="form-control" value="<?php echo htmlspecialchars($producto['precio']); ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input name="cantidad" type="number" class="form-control" value="<?php echo htmlspecialchars($producto['cantidad']); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input name="imagen" type="file" class="form-control">
                    <?php if (!empty($producto['imagen'])): ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>" style="width: 100px; height: auto; margin-top: 10px;"/>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="4"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                </div>

                <button name="actualizar" type="submit" class="btn" style="background-color: #c5b4b7; color:white;">Actualizar Producto</button>
            </form>
        </div>
    </div>
</body>
</html>
