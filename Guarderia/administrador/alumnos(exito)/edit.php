<?php 
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$matricula = $_POST['matricula'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$direccion = $_POST['direccion'];
$tutor = $_POST['tutor'];
$celular = $_POST['celular'];
$tipo_sangre = $_POST['tipo_sangre'];

$sql = "UPDATE alumnos SET nombre='$nombre', edad='$edad', direccion='$direccion', tutor='$tutor', celular='$celular', tipo_sangre='$tipo_sangre'";

// Verificar si el usuario subió una nueva imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $imagen_nombre = time() . "_" . basename($_FILES['foto']['name']); // Nombre único
    $imagen_temp = $_FILES['foto']['tmp_name'];
    $directorio_destino = "../uploads/" . $imagen_nombre;

    if (move_uploaded_file($imagen_temp, $directorio_destino)) {
        $imagen_url = "uploads/" . $imagen_nombre;
        $sql .= ", foto='$imagen_url'"; // Agregar la imagen a la consulta SQL
    } else {
        echo "Error al subir la imagen.";
        exit;
    }
}

$sql .= " WHERE matricula='$matricula'"; // Finalizar consulta
$conn->query($sql);
$conn->close();

?>


