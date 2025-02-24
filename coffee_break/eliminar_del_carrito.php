<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    if (isset($_SESSION["carrito"])) {
        foreach ($_SESSION["carrito"] as $index => $item) {
            if ($item["id"] == $id) {
                unset($_SESSION["carrito"][$index]);
                $_SESSION["carrito"] = array_values($_SESSION["carrito"]); // Reindexar array
                echo json_encode(["status" => "success", "message" => "Producto eliminado"]);
                exit();
            }
        }
    }

    echo json_encode(["status" => "error", "message" => "Producto no encontrado"]);
    exit();
}
?>
