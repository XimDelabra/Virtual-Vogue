<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$matricula = $_POST['matricula'];
$sql = "DELETE FROM alumnos WHERE matricula = '$matricula'";
$conn->query($sql);

$conn->close();
?>
