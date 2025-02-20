<?php
require 'db_conexion.php';
session_start();
$GLOBALS['$iptIdT'] = "";
$GLOBALS['$id_traje'] = "";
$GLOBALS['$iptTalla'] = "";
$GLOBALS['$iptCantidad'] = "";
$GLOBALS['$iptDisponibles'] = "";

# Inicia Código de Registrar

if (isset($_POST['regP'])) {
    $id = $_POST['id_traje'];
    $talla = $_POST['iptTalla'];
    $cantidad = $_POST['iptCantidad'];
    $disponibles = $_POST['iptDisponibles'];


    if (!empty($talla) && !empty($cantidad) && !empty($disponibles)) {

        $insert = $cnnPDO->prepare(
            'INSERT INTO tallas_trajes (id_traje, talla, cantidad, disponibles) 
                    VALUES (?,?,?,?) '
        );
        $insert->execute([$id, $talla, $cantidad, $disponibles]);
    }
}
# Termina Código de registrar

# Inicia Código de BUSCAR

if (isset($_POST['buscarP'])) {
    $id = $_POST['iptIdT'];

    if (!empty($id)) {

        $busqueda = $cnnPDO->prepare('SELECT * FROM tallas_trajes WHERE id_tj = ?');
        $busqueda->execute([$id]);
        $tallas = $busqueda->fetch();

        if ($busqueda) {
            $GLOBALS['$iptIdT'] = $id;
            $GLOBALS['$iptTalla'] = $tallas['talla'];
            $GLOBALS['$iptCantidad']  = $tallas['cantidad'];
            $GLOBALS['$iptDisponibles'] = $tallas['disponibles'];
        } else
            $GLOBALS['$iptIdT'] = "";
    } else {
        echo ('Rellenar todos los campos');
    }
}
# Termina Código de BUSCAR

# Inicia Código de EDITAR o MODIFICAR

if (isset($_POST['editarP'])) {
    $id = $_POST['iptIdT'];
    $talla = $_POST['iptTalla'];
    $cantidad = $_POST['iptCantidad'];
    $disponibles = $_POST['iptDisponibles'];


    if (!empty($id) && !empty($talla) && !empty($cantidad) && !empty($disponibles)) {

        $sql = $cnnPDO->prepare(
            'UPDATE tallas_trajes SET talla = ?, cantidad = ?, disponibles = ? WHERE id_tj = ?'
        );
        $sql->execute([$talla, $cantidad, $disponibles, $id]);
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
    <div class="container text-center">
        <h1 class="txt-registro2">Agrega una nueva talla para un traje</h1>
        <a href="" class="txt-login2">O busca una existente y editala</a>

        <div class="container c-registro">
            <form class="row g-3 f-registro" method="POST" action="">
                <div class="col-md-6">
                    <label for="" class="form-label">ID Elemento</label>
                    <input type="text" value="<?php echo $GLOBALS['$iptIdT']; ?>" class="form-control" id="iptIdT" name="iptIdT">
                </div>

                <div class="col-md-6">
                    <label for="" class="form-label">Talla:</label>
                    <input type="text" value="<?php echo $GLOBALS['$iptTalla']; ?>" class="form-control" id="iptTalla" name="iptTalla">
                </div>

                <div class="col-md-6">
                    <label for="" class="form-label">Cantidad:</label>
                    <input type="number" value="<?php echo $GLOBALS['$iptCantidad']; ?>" class="form-control" id="iptCantidad" name="iptCantidad" placeholder="Cantidad">
                </div>

                <div class="col-md-6">
                    <label for="" class="form-label">Dsiponibles:</label>
                    <input type="number" value="<?php echo $GLOBALS['$iptDisponibles']; ?>" class="form-control" id="iptDisponibles" name="iptDisponibles" placeholder="Disponibles">
                </div>

                <input type="hidden" value="<?php echo $GLOBALS['$id_traje']; ?>" class="form-control" id="id_traje" name="id_traje">
                <div class="col-12">
                    <button type="submit" class="btn btn-success" name="regP">Registrar Elemento</button>
                    <button type="submit" class="btn btn-primary" name="editarP">Actualizar Elemento</button>
                    <button type="submit" class="btn btn-warning" name="buscarP">Buscar Elemento (id)</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>