<?php
require 'db_conexion.php';
include 'offcanvas-car.php';
include 'navbar.php';

# Inicia Código de borrar de Favorito

if (isset($_POST['quitFav'])) {
  $id = $_POST['id_traje'];
  $email = $_SESSION['email'];

  
    $delete = $cnnPDO->prepare('DELETE FROM favoritos WHERE email = ? AND id_traje = ? ');
    $delete->execute([$email, $id]);
  
}

if (isset($_POST['buscarfav']) && !empty($_POST['elemento'])) {
  $elemento = $_POST['elemento'];
  $busqueda = $cnnPDO->prepare('SELECT * FROM inventario INNER JOIN favoritos ON inventario.id_traje = favoritos.id_traje 
                            WHERE favoritos.email = ? AND nombre_traje LIKE ? ');
  $busqueda->execute([$_SESSION['email'], "%$elemento%"]);
  $favoritos = $busqueda->fetchAll();
} else {
  $query = $cnnPDO->prepare('SELECT * FROM inventario INNER JOIN favoritos ON inventario.id_traje = favoritos.id_traje 
                            WHERE favoritos.email = ?');
  $query->execute([$_SESSION['email']]);
  $favoritos = $query->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stylen</title>
</head>

<body class="body-fav">
  <div class="container container-search">
    <form class="d-flex busqueda justify-content-end" role="search" method="POST" action="">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="elemento">
      <button class="btn btn-outline-success" type="submit" name="buscarfav">Search</button>
    </form>

    <div class="row justify-content-around">
      <?php foreach ($favoritos as $favorito): ?>
        <div class="col-md-3 ">
          <div class="card mx-auto d-block card-catalogo">
            <img src="data:image/png;base64,<?php echo base64_encode($favorito['foto_traje']); ?>" class="img-fluid">
            <div class="card-body">
              <form method="POST" action="">

                <button type="button" class="btn btn-carrito" data-bs-toggle="offcanvas" data-id="<?php echo $favorito['id_traje']; ?>" data-bs-target="#offcanvas-<?php echo $favorito['id_traje']; ?>" aria-controls="offcanvas-<?php echo $favorito['id_traje']; ?>">CARRITO</button>
                <button type="submit" name="quitFav" class="btn bi bi-heart-fill btn-heart"></button>

                <input type="hidden" value="<?php echo $favorito['id_traje']; ?>" name="id_traje" class="ipt-hidden ">
              </form>
            </div>
          </div>
          <div class="descripcion-card">
            <h6 class="nombre-card"><?php echo $favorito['nombre_traje']; ?></h6>
            <p>Precio: <?php echo ('$' . $favorito['precio_traje']); ?></p>
          </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-<?php echo $favorito['id_traje']; ?>" aria-labelledby="offcanvas-<?php echo $favorito['id_traje']; ?>Label">
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="agg_car_fav.php">

              <?php
              $select_t = $cnnPDO->prepare('SELECT * FROM tallas_trajes WHERE id_traje = ?');
              $select_t->execute([$favorito['id_traje']]);
              $tallas = $select_t->fetchAll();
              ?>
              <h2>Producto: <?php echo $favorito['nombre_traje']; ?></h2>
              <img src="data:image/png;base64,<?php echo base64_encode($favorito['foto_traje']); ?>" class="img-fluid">
              <p>Escoge tu talla:</p>
              <select class="form-select" name="talla" required>
                <option value="">Selecciona una talla</option>
                <?php foreach ($tallas as $talla): ?>
                  <option value="<?php echo $talla['talla']; ?>"><?php echo $talla['talla']; ?></option>
                <?php endforeach; ?>
              </select>
              <p>Cantidad:</p> <input type="number" class="form-control" name="cantidad">
              <p>Precio Unitario: <?php echo ('$' . $favorito['precio_traje']); ?></p>
              <input type="hidden" id="id_traje" name="id_traje" value="<?php echo $favorito['id_traje']; ?>">
              <input type="hidden" id="disponible" name="disponible" value="<?php echo $talla['disponibles']; ?>">

              <button type="submit" class="btn btn-success mt-3" name="aggCar"> Agregar al carrito</button>

            </form>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>


</html>