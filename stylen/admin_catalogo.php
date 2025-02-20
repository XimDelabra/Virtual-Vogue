<?php
require 'db_conexion.php';

# Inicia Código de Registrar nueva talla

if (isset($_POST['regP'])) {
    $id = $_POST['iptNombreT'];
    $nombre = $_POST['iptNombreT'];
    $categoria = $_POST['iptCategoria'];
    $precio = $_POST['iptPrecio'];


    if (!empty($nombre) && !empty($precio) && !empty($categoria)) {
        if (isset($_FILES["foto_traje"]) && $_FILES["foto_traje"]["error"] === UPLOAD_ERR_OK) {
            $size = getimagesize($_FILES["foto_traje"]["tmp_name"]);

            if ($size !== false) {
                $cargarFoto = $_FILES['foto_traje']['tmp_name'];
                $foto_traje = fopen($cargarFoto, 'rb');

                $insert = $cnnPDO->prepare(
                    'INSERT INTO inventario (nombre_traje, categoria_traje , precio_traje, foto_traje) 
                    VALUES (:nombre_traje, :categoria_traje, :precio_traje, :foto_traje) '
                );
                $insert->bindParam('nombre_traje', $nombre);
                $insert->bindParam('categoria_traje', $categoria);
                $insert->bindParam('precio_traje', $precio);
                $insert->bindParam('foto_traje', $foto_traje, PDO::PARAM_LOB);
                $insert->execute();

                // Obtener el ID del traje recién insertado
                $id_tt = $cnnPDO->lastInsertId();

                $insertt = $cnnPDO->prepare(
                    'INSERT INTO tallas_trajes (id_traje, talla , cantidad, disponibles) VALUES (?,?,?,?)  '
                );
                $insertt->execute([$id_tt, null, 0, 0]);
            }
        } else {
            echo ('error, falta subir una foto');
        }
    }
}
# Termina Código de registrar
#Codigo para buscar

if (isset($_POST['buscar']) && !empty($_POST['elemento'])) {
    $elemento = $_POST['elemento'];
    $busqueda = $cnnPDO->prepare('SELECT i.id_traje, i.nombre_traje, i.categoria_traje, i.precio_traje, i.foto_traje,t.id_tj, t.talla, t.cantidad
    FROM inventario i
    JOIN tallas_trajes t ON i.id_traje = t.id_traje
     WHERE i.nombre_traje LIKE ? 
           OR i.id_traje LIKE ? 
           OR t.talla LIKE ?
     ORDER BY t.id_tj, i.nombre_traje, t.talla');
    $busqueda->execute(["%$elemento%", "%$elemento%", "%$elemento%"]);
    $inventario = $busqueda->fetchAll();
} else {
    $select  = $cnnPDO->prepare('SELECT i.id_traje, i.nombre_traje, i.categoria_traje, i.precio_traje, i.foto_traje,t.id_tj, t.talla, t.cantidad
    FROM inventario i
    JOIN tallas_trajes t ON i.id_traje = t.id_traje
    ORDER BY t.id_tj, i.nombre_traje, t.talla');
    $select->execute();
    $inventario = $select->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="body-catalogo">
    <nav class="navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand title" href="admin_index.php">
                <img src="images/logo.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Stylen
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto pags">
                    <a href="admin_catalogo.php" class="btn btn-catalogo">Catálogo</a>
                    <a href="admin_agg_inventario.php" class="btn btn-regnew">Registrar Nuevo</a>
                    <a href="admin_agg.php" class="btn btn-favoritos">Agregar</a>
                    <li class="nav-item dropdown">
                        <a class="navbar-brand title bi bi-person-fill dropdown-toggle dropdown-admin" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item py-2 fw-bold" href="#">Admin</a></li>
                            <li><a class="dropdown-item" href="ayuda.php">Usuarios</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Cerrar Sesion</a></li>

                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <hr>

    <div class="container">
        <form class="d-flex busqueda justify-content-end" role="search" method="POST" action="">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="elemento">
            <button class="btn btn-outline-success" type="submit" name="buscar">Search</button>
        </form>

        <div class="row justify-content-around">

            <?php foreach ($inventario as $producto): ?>
                <div class="col-md-4"> 
                    <div class="card mb-3 custom-card">
                        <div class="row g-0">
                           
                            <div class="col-md-4">
                                <img src="data:image/png;base64,<?php echo base64_encode($producto['foto_traje']); ?>" class="img-fluid rounded-start custom-img" alt="Imagen del traje">
                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $producto['nombre_traje']; ?></h5>
                                    <div class="talla-cantidad justify-content-between" style="display: flex;">
                                        <p class="card-text" style="margin: 0;">Talla: <?php echo $producto['talla']; ?></p>
                                        <p class="card-text" style="margin: 0;">Cantidad: <?php echo $producto['cantidad']; ?></p>
                                    </div>
                                    <div class="talla-cantidad justify-content-between" style="display: flex;">
                                        <p style="margin: 0;"><?php echo ('$' . $producto['precio_traje']); ?></p>
                                        <p style="margin: 0;"><?php echo $producto['categoria_traje']; ?></p>
                                    </div>
                                    <?php echo 'id producto: ' . $producto['id_traje']; ?> <br>
                                    <?php echo 'id elemento: ' . $producto['id_tj']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</body>

</html>