<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    if (!isset($_SESSION["carrito"])) {
        $_SESSION["carrito"] = [];
    }

    $encontrado = false;
    foreach ($_SESSION["carrito"] as &$item) {
        if ($item["id"] == $id) {
            $item["cantidad"]++;
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        $_SESSION["carrito"][] = [
            "id" => $id,
            "nombre" => $nombre,
            "precio" => $precio,
            "cantidad" => 1
        ];
    }

    echo json_encode(["status" => "success", "message" => "Producto agregado al carrito"]);
    exit();
}
?>
