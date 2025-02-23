<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM alumnos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['matricula']}</td>
                <td>{$row['nombre']}</td>
                <td><img src='../{$row['foto']}' width='60' height='60' style='border-radius:5%;'></td>
                <td>{$row['edad']}</td>
                <td>{$row['direccion']}</td>
                <td>{$row['tutor']}</td>
                <td>{$row['celular']}</td>
                <td>{$row['tipo_sangre']}</td>
                <td>{$row['status']}</td>
                <td>
                    <button class='btn btn-warning' id='edit-btn' data-matricula='{$row['matricula']}'>Editar</button>
                    <button class='btn btn-danger' id='delete-btn' data-matricula='{$row['matricula']}'>Eliminar</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='10'>No hay alumnos</td></tr>";
}
$conn->close();
?>