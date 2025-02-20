<?php
require 'db_conexion.php';
include 'offcanvas-car.php';
include 'navbar.php';

#Codigo para buscar

if (isset($_POST['buscar']) && !empty($_POST['elemento'])) {
  $elemento = $_POST['elemento'];
  $busqueda = $cnnPDO->prepare('SELECT * FROM inventario WHERE nombre_traje LIKE ?');
  $busqueda->execute(["%$elemento%"]);
  $inventario = $busqueda->fetchAll();
} else {
  $select  = $cnnPDO->prepare('SELECT * FROM inventario');
  $select->execute();
  $inventario = $select->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stylen</title>
</head>

<body class="body-catalogo">

  <div class="container container-search">
    <form class="d-flex busqueda justify-content-end" role="search" method="POST" action="">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="elemento">
      <button class="btn btn-outline-success" type="submit" name="buscar">Search</button>
    </form>

    <div class="row justify-content-around">

      <?php foreach ($inventario as $producto): ?>
        <div class="col-md-3 ">
          <div class="card mx-auto d-block card-catalogo">
            <img src="data:image/png;base64,<?php echo base64_encode($producto['foto_traje']); ?>" class="img-fluid">
            <div class="card-body">
              <form method="POST" action="agg_car_fav.php">

                <?php if (isset($_SESSION['email'])): ?>
                  <button type="button" class="btn btn-carrito" data-bs-toggle="offcanvas" data-id="<?php echo $producto['id_traje']; ?>" data-bs-target="#offcanvas-<?php echo $producto['id_traje']; ?>" aria-controls="offcanvas-<?php echo $producto['id_traje']; ?>">CARRITO</button>
                <?php else: ?>
                  <a href="login.php" class="btn btn-carrito">CARRITO</a>
                <?php endif; ?>

                <?php if (isset($_SESSION['email'])):

                  $buscarfav = $cnnPDO->prepare('SELECT * FROM favoritos WHERE email = ? and id_traje = ?');
                  $buscarfav->execute([$_SESSION['email'], $producto['id_traje']]);
                  $countfav = $buscarfav->rowCount();

                  if ($countfav): ?>
                    <button type="submit" name="aggFav" class="btn bi bi-heart-fill btn-heart"></button>
                  <?php else: ?>
                    <button type="submit" name="aggFav" class="btn bi bi-heart btn-heart"></button>
                  <?php endif; ?>
                <?php else: ?>
                  <a href="login.php" class="btn bi bi-heart btn-heart "></a>
                <?php endif; ?>
                <input type="hidden" value="<?php echo $producto['id_traje']; ?>" name="id_traje" class="ipt-hidden "><br>
              </form>
            </div>
          </div>
          <div class="descripcion-card mt-2">
            <h6 class="nombre-card"><?php echo $producto['nombre_traje']; ?></h6>
            <p>Precio: <?php echo ('$' . $producto['precio_traje']); ?></p>
          </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-<?php echo $producto['id_traje']; ?>" aria-labelledby="offcanvas-<?php echo $producto['id_traje']; ?>Label">
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <form method="POST" action="agg_car_fav.php">

              <?php
              $select_t = $cnnPDO->prepare('SELECT * FROM tallas_trajes WHERE id_traje = ?');
              $select_t->execute([$producto['id_traje']]);
              $tallas = $select_t->fetchAll();
              ?>
              <h2>Producto: <?php echo $producto['nombre_traje']; ?></h2>
              <img src="data:image/png;base64,<?php echo base64_encode($producto['foto_traje']); ?>" class="img-fluid">
              <p>Escoge tu talla:</p>
              <select class="form-select" name="talla" required>
                <option value="">Selecciona una talla</option>
                <?php foreach ($tallas as $talla): ?>
                  <option value="<?php echo $talla['talla']; ?>"><?php echo $talla['talla']; ?></option>
                <?php endforeach; ?>
              </select>
              <p>Cantidad:</p> <input type="number" class="form-control" name="cantidad" required>
              <p>Precio Unitario: <?php echo ('$' . $producto['precio_traje']); ?></p>
              <input type="hidden" id="id_traje" name="id_traje" value="<?php echo $producto['id_traje']; ?>">
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