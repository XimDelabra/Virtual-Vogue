<?php
session_start();

require_once 'db_conexion.php'; // Asegúrate de que este archivo contiene $conexion

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = trim($_POST['matricula']);
    $password = trim($_POST['password']);

    // Si en db_conexion.php ya tienes $conexion, NO es necesario crear otro new mysqli
    if (!$conexion) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Función para verificar credenciales en una tabla
    function verificarUsuario($conexion, $tabla, $usuario, $password) {
        $sql = "SELECT * FROM $tabla WHERE matricula = ? AND password = ?";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            die("Error en la consulta: " . $conexion->error);
        }
        $stmt->bind_param("ss", $usuario, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->num_rows > 0 ? $tabla : false;
    }

    // Listado de tablas a buscar
    $redirecciones = [
        "administradores" => "./administrador/alumnos/tablaAlumnos.php",
        "maestros" => "./Login_Maestro/cardAlumno.php",
        "alumnos" => "./Login_Alumno/pago.php"
    ];

    // Verifica en cada tabla
    foreach ($redirecciones as $tabla => $ruta) {
        if (verificarUsuario($conexion, $tabla, $usuario, $password)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: $ruta");
            exit();
        }
    }

    // Si no se encuentra en ninguna tabla
    $_SESSION['error'] = "Usuario o contraseña incorrectos";
    header("Location: index.php");
    exit();
}
?>



