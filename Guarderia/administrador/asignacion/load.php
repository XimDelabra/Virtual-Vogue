<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$result = $conn->query("
    SELECT m.nombre AS nom_m, a.nombre AS nom_a, ag.id
    FROM asignacion ag
    JOIN maestros m ON ag.matricula_m = m.matricula
    JOIN alumnos a ON ag.matricula_a = a.matricula
");
//JOIN se usa para combinar filas de 2 o mas tablas

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['nom_m']}</td>
            <td>{$row['nom_a']}</td>
            <td>
                <button data-id='{$row['id']}' class='btn btn-danger btn-sm delete-btn'>Eliminar</button>
            </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='3'>No hay asignaciones</td></tr>";
}

$conn->close();
?>
