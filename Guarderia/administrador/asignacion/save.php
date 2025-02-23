<?php
$conn = new mysqli("localhost", "root", "", "db_guarderia");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['matricula_m']) && isset($_POST['matricula_a'])) {
    $matriculaMaestro = $_POST['matricula_m'];
    $matriculaAlumno = $_POST['matricula_a'];

    // Consulta para verificar si la asignación ya existe
    $checkSql = $conn->prepare("SELECT * FROM asignacion WHERE matricula_m = ? AND matricula_a = ?");
    $checkSql->bind_param("ss", $matriculaMaestro, $matriculaAlumno);
    $checkSql->execute();
    $result = $checkSql->get_result();

    if ($result->num_rows > 0) {
        echo "duplicate"; 
    } else {
        $sql = $conn->prepare("INSERT INTO asignacion (matricula_m, matricula_a) VALUES (?, ?)");
        $sql->bind_param("ss", $matriculaMaestro, $matriculaAlumno);
    
        if ($sql->execute()) {
            echo "success"; 
        } else {
            echo "error"; 
        }
    
        $sql->close(); 
    }    

    $checkSql->close();
}
$conn->close();
?>

