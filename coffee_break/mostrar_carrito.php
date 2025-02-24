<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"])) {
    echo json_encode(["status" => "empty", "message" => "El carrito está vacío"]);
    exit();
}

echo json_encode($_SESSION["carrito"]);
exit();
?>
