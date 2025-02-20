<?php
session_start();

if (isset($_POST['rentarAhora'])) {
    if (!empty($_POST['id_carrito'])) {
        
        $email = $_SESSION['email'];
        $id_carritos = $_POST['id_carrito'];  
        $id_trajes = $_POST['id_traje']; 
        $tallas = $_POST['talla'];
        $cantidades = $_POST['cantidad'];
        $total = $_POST['total'];   
    
        foreach ($id_carritos as $key => $id_carrito) {
            $id_traje = $id_trajes[$key];
            $talla = $tallas[$key];
            $cantidad = $cantidades[$key];

            $baja = $cnnPDO->prepare('UPDATE tallas_trajes SET disponibles = disponibles - ? WHERE id_traje = ? AND talla = ?');
            $baja->execute([$cantidad, $id_traje, $talla]);

            $renta = $cnnPDO->prepare('DELETE FROM carrito WHERE id_carrito = ?');
            $renta->execute([$id_carrito]);

            echo "<script>alert('Exito. Producto rentado!.');</script>";
        }
        
        
    } else{
        echo "<script>alert('Mensaje: No hay ningun producto en tu carrito.');</script>";
    }
}
?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form method="POST" action="">

            <?php
            // Recupera los detalles de los productos en el carrito
            $select_c = $cnnPDO->prepare('
            SELECT c.id_carrito, c.id_traje, c.talla, c.cantidad, t.nombre_traje, t.precio_traje, t.foto_traje 
            FROM carrito c
            INNER JOIN inventario t ON c.id_traje = t.id_traje
            WHERE c.email = ?
        ');
            $select_c->execute([$_SESSION['email']]);
            $detalles = $select_c->fetchAll();
            $totalCarrito = 0;
            ?>

            <div class="row">
                <?php $totalCarrito = 0; ?>
                <?php foreach ($detalles as $producto): ?>
                    <div class="col-md-12">
                        <div class="d-flex">
                            <img src="data:image/png;base64,<?php echo base64_encode($producto['foto_traje']); ?>" alt="Producto" class="img-fluid" style="width: 100px; height: 100px;">
                            <div class="ms-3">
                                <h5><?php echo $producto['nombre_traje']; ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p>
                                        Talla: <?php echo $producto['talla']; ?><br>
                                        Cantidad: <?php echo $producto['cantidad']; ?>
                                    </p>
                                    
                                        <input type="hidden" name="id_carrito_b" value="<?php echo $producto['id_carrito']; ?>">
                                        <button type="button" name="borrar" class="btn btn-danger bi bi-trash" onclick="eliminarDelCarrito(<?php echo $producto['id_carrito']; ?>)"></button>
                                    
                                    <input type="hidden" name="id_carrito[]" value="<?php echo $producto['id_carrito']; ?>">
                                    <input type="hidden" name="id_traje[]" value="<?php echo $producto['id_traje']; ?>">
                                    <input type="hidden" name="talla[]" value="<?php echo $producto['talla']; ?>">
                                    <input type="hidden" name="cantidad[]" value="<?php echo $producto['cantidad']; ?>">
                                </div>


                                <?php $total_producto = ($producto['precio_traje'] * $producto['cantidad']); ?>
                                <p>Total: $<?php echo $total_producto; ?></p>
                                <?php $totalCarrito += $total_producto;
                                ?>

                            </div>
                        </div>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>
                <p>Total a pagar: $<?php echo ($totalCarrito); ?></p>
                <input type="hidden" name="total" value="<?php echo $totalCarrito; ?>">
                <button type="submit" class="btn btn-success mt-3" name="rentarAhora"> Rentar</button>
        </form>   

    </div>
</div>

<script>
function eliminarDelCarrito(id_carrito) {
    if (confirm("¿Seguro que quieres eliminar este producto?")) {
        fetch("agg_car_fav.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "borrar=1&id_carrito=" + id_carrito
        })
        .then(response => response.text())
        .then(data => {
            alert("Producto eliminado");
            location.reload();
        });
    }
}
</script>