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

// Verificar si la matrícula ya existe
$check_sql = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
$result = $conn->query($check_sql);

if ($result->num_rows == 0) { // Solo inserta si no existe la matrícula
    
    $imagen_url = "uploads/default.png"; // Imagen por defecto en caso de que no suban foto

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $imagen_nombre = time() . "_" . basename($_FILES['foto']['name']); // Nombre único para evitar conflictos
        $imagen_temp = $_FILES['foto']['tmp_name'];
        $directorio_destino = "../uploads/" . $imagen_nombre;

        if (move_uploaded_file($imagen_temp, $directorio_destino)) {
            $imagen_url = "uploads/" . $imagen_nombre; // Ruta para almacenar en la BD
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    }

    $sql = "INSERT INTO alumnos (matricula, nombre, edad, direccion, tutor, celular, tipo_sangre, foto) VALUES ('$matricula', '$nombre', '$edad', '$direccion', '$tutor', '$celular','$tipo_sangre','$imagen_url')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error al registrar: " . $conn->error;
    }
} else {
    echo "La matrícula ya existe";
}

$conn->close();
?>

