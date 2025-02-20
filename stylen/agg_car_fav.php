<?php
require 'db_conexion.php';
session_start();
# Inicia Código de Agregar al carrito

if (isset($_POST['aggCar'])) {
    $id = $_POST['id_traje'];
    $email = $_SESSION['email'];
    $talla = $_POST['talla'];
    $cantidad = $_POST['cantidad'];
    $disponible = $_POST['disponible'];

    if (!empty($cantidad)  && !empty($talla)) {
        if (!($cantidad <= 0)) {
            if ($cantidad <= $disponible) {
                $select2 = $cnnPDO->prepare('SELECT * FROM carrito WHERE email = ? AND id_traje = ? AND talla = ?');
                $select2->execute([$email, $id, $talla]);
                $count = $select2->rowCount();
                if ($count) {
                    $update = $cnnPDO->prepare('UPDATE carrito SET cantidad = cantidad + ? WHERE email = ? AND id_traje = ? AND talla = ?');
                    $update->execute([$cantidad, $email, $id, $talla]);
                    echo ('Cantidad actualizada en el carrito');
                    header("Location: catalogo.php");
                } else {
                    $insert = $cnnPDO->prepare('INSERT INTO carrito (email,id_traje, talla, cantidad) VALUES (?,?,?,?) ');
                    $insert->execute([$email, $id, $talla, $cantidad]);
                    echo ('Producto agregado al carrito');
                    header("Location: catalogo.php");
                }
            } else {
                echo "<script>alert('Mensaje: La cantidad escogida supera la cantidad disponible de prendas.');</script>";
            }
        } else {
            echo "<script>alert('Mensaje: Escoja una cantidad valida.');</script>";
        }
    } else {
        echo "<script>alert('Mensaje: Rellene todos los campos.');</script>";
    }
};


# Inicia Código de Agregar Favorito

if (isset($_POST['aggFav'])) {
    $id = $_POST['id_traje'];
    $email = $_SESSION['email'];

    $select = $cnnPDO->prepare('SELECT * FROM favoritos WHERE email = ? AND id_traje = ?');
    $select->execute([$email, $id]);
    $count = $select->rowCount();
    if ($count) {
        $delete = $cnnPDO->prepare('DELETE FROM favoritos WHERE email = ? AND id_traje = ? ');
        $delete->execute([$email, $id]);
        echo "<script>
        alert('Mensaje: Producto eliminado de favoritos.');
        window.location.href = 'favoritos.php';
      </script>";
exit();

    } else {
        $insert = $cnnPDO->prepare('INSERT INTO favoritos (email,id_traje) VALUES (?,?) ');
        $insert->execute([$email, $id]);
        echo "<script>
        alert('Mensaje: Producto agregado a favoritos.');
        window.location.href = 'favoritos.php';
      </script>";
exit();

    }
};

#Codigo para borrar del carrito
if (isset($_POST['borrar'])) {
    $id = $_POST['id_carrito'];

    $delete = $cnnPDO->prepare('DELETE FROM carrito WHERE id_carrito = ?');
    $delete->execute([$id]);
    header("Location: catalogo.php");
}


