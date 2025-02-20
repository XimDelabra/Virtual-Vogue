<?php
require 'db_conexion.php';
session_start();
$GLOBALS['$iptId'] = "";
$GLOBALS['$iptNombreT'] = "";
$GLOBALS['$iptPrecio'] = "";
$GLOBALS['$iptCategoria'] = "";

# Inicia Código de Registrar

if (isset($_POST['regP'])) {
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

# Inicia Código de BUSCAR

if (isset($_POST['buscarP'])) {
    $id = $_POST['iptId'];

    if (!empty($id)) {

        $busqueda = $cnnPDO->prepare('SELECT * FROM inventario WHERE id_traje = ?');
        $busqueda->execute([$id]);
        $traje = $busqueda->fetch();

        if ($busqueda) {
            $GLOBALS['$iptId'] = $id;
            $GLOBALS['$iptNombreT'] = $traje['nombre_traje'];
            $GLOBALS['$iptCategoria']  = $traje['categoria_traje'];
            $GLOBALS['$iptPrecio'] = $traje['precio_traje'];
        } else
            $GLOBALS['$iptId'] = "";
    } else {
        echo ('Rellenar todos los campos');
    }
}
# Termina Código de BUSCAR

# Inicia Código de EDITAR o MODIFICAR

if (isset($_POST['editarP'])) {
    $id = $_POST['iptId'];
    $nombre = $_POST['iptNombreT'];
    $categoria = $_POST['iptCategoria'];
    $precio = $_POST['iptPrecio'];


    if (!empty($id) && !empty($nombre) && !empty($precio) && !empty($categoria)) {
        if (isset($_FILES["foto_traje"]) && $_FILES["foto_traje"]["error"] === UPLOAD_ERR_OK) {
            $size = getimagesize($_FILES["foto_traje"]["tmp_name"]);

            if ($size !== false) {
                $cargarFoto = $_FILES['foto_traje']['tmp_name'];
                $foto_traje = fopen($cargarFoto, 'rb');

                $sql = $cnnPDO->prepare(
                    'UPDATE inventario SET nombre_traje = ?, categoria_traje = ?, precio_traje = ?, foto_traje = ?'
                );
                $sql->execute([$nombre, $categoria, $precio, $foto_traje, $id]);
            }
        } else {
            $sql = $cnnPDO->prepare(
                'UPDATE inventario SET nombre_traje = ?, categoria_traje = ?, precio_traje = ? WHERE id_traje = ?'
            );
            $sql->execute([$nombre, $categoria, $precio, $id]);
        }
    }
}
# Termina Código de EDITAR o MODIFICAR
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylen</title>
</head>

<body class="blogin">
    <nav class="navbar navbar-expand-lg">
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
                    <a href="admin_agg_inventario.php" class="btn btn-favoritos">Registrar Nuevo</a>
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
    <div class="container text-center">
        <h1 class="txt-registro2">REGISTRA UN NUEVO PRODUCTO</h1>
        <a href="" class="txt-login2">O busca uno existente y editalo</a>

        <div class="container c-registro">
            <form class="row g-3 f-registro" method="POST" action="" enctype="multipart/form-data">
                <div class="col-md-5">
                    <label for="" class="form-label">ID Producto</label>
                    <input type="text" value="<?php echo $GLOBALS['$iptId']; ?>" class="form-control" id="iptId" name="iptId" placeholder="(para buscar)">
                </div>

                <div class="col-md-7">
                    <label for="" class="form-label">Nombre del traje</label>
                    <input type="text" value="<?php echo $GLOBALS['$iptNombreT']; ?>" class="form-control" id="iptNombreT" name="iptNombreT">
                </div>
                <div class="col-md-5">
                    <label for="" class="form-label">Precio</label>
                    <input type="number" value="<?php echo $GLOBALS['$iptPrecio']; ?>" class="form-control" id="iptPrecio" name="iptPrecio">
                </div>
                <div class="col-md-7">
                    <label for="" class="form-label">Categoria</label>
                    <select class="form-select form-control" aria-label="Default select example" id="iptCategoria" name="iptCategoria">
                        <option disabled selected>Categoria</option>
                        <option value="1" <?php if ($GLOBALS['$iptCategoria'] == 'Casual') echo 'selected'; ?>>Casual</option>
                        <option value="2" <?php if ($GLOBALS['$iptCategoria'] == 'Formal') echo 'selected'; ?>>Formal</option>
                        <option value="3" <?php if ($GLOBALS['$iptCategoria'] == 'Semiformal') echo 'selected'; ?>>Semiformal</option>
                        <option value="4" <?php if ($GLOBALS['$iptCategoria'] == 'Elegante') echo 'selected'; ?>>Elegante</option>
                        <option value="5" <?php if ($GLOBALS['$iptCategoria'] == 'Exclusivo') echo 'selected'; ?>>Exclusivo</option>
                        <option value="6" <?php if ($GLOBALS['$iptCategoria'] == 'Niños') echo 'selected'; ?>>Niños</option>

                    </select>
                </div>
                <div class="col-12">
                    <label for="file" class="form-label">Foto del producto</label>
                    <input type="file" accept=".jpg, .jpeg, .png" name="foto_traje" class="form-control">
                </div>

                <div class="col-12">
                    <div class="actions md-6">
                        <button type="submit" class="btn btn-success" name="regP">Registrar Producto</button>
                        <button type="submit" class="btn btn-primary" name="editarP">Actualizar Producto</button>
                        <button type="submit" class="btn btn-warning" name="buscarP">Buscar Producto (id)</button>
                        <button type="submit" class="btn btn-danger" name="buscarP">Eliminar Producto</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</body>

</html>