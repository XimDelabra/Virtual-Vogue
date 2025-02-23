<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener maestros
$maestrosOptions = "<option selected>Selecciona un maestro</option>"; // Opción por defecto
$maestros = $conn->query("SELECT matricula, nombre FROM maestros");
while ($row = $maestros->fetch_assoc()) {
    $maestrosOptions .= "<option value='{$row['matricula']}'>{$row['nombre']}</option>";
}

// Obtener alumnos
$alumnosOptions = "<option selected>Selecciona un alumno</option>"; // Opción por defecto
$alumnos = $conn->query("SELECT matricula, nombre FROM alumnos");
while ($row = $alumnos->fetch_assoc()) {
    $alumnosOptions .= "<option value='{$row['matricula']}'>{$row['nombre']}</option>";
}

// Crear el array de respuesta
$response = array(
    'maestros' => $maestrosOptions,
    'alumnos' => $alumnosOptions
);

echo json_encode($response);

$conn->close();
?>


