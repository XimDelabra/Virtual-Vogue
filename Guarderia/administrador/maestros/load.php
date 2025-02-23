<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT * FROM maestros";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['matricula']}</td>
                <td>{$row['nombre']}</td>
                <td><img src='../{$row['foto']}' width='60' height='60' style='border-radius:5%;'></td>
                <td>{$row['sueldo']}</td>
                <td>{$row['celular']}</td>
                <td>{$row['password']}</td>
                <td>
                    <button class='btn btn-warning' id='edit-btn' data-matricula='{$row['matricula']}'>Editar</button>
                    <button class='btn btn-danger' id='delete-btn' data-matricula='{$row['matricula']}'>Eliminar</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay maestros</td></tr>";
}
$conn->close();
?>