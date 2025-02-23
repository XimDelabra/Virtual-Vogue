<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida:". $conn->connect_error);
}

$matricula = $_POST['matricula'];
$sql = "SELECT matricula, nombre, edad, direccion, tutor, celular, tipo_sangre, foto FROM alumnos WHERE matricula = '$matricula'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

echo json_encode($user);

$conn->close();
?>