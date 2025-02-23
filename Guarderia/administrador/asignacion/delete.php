<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = $conn->prepare("DELETE FROM asignacion WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $sql->close();
    $conn->close();
}
?>
