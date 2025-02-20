<?php
require 'cdn.html';

/* Conectar a una base de datos de MySQL Local */
$utf8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

/* Definir las variables para la conexión al PDO */
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_stylen');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

try {
    /* Conectar a una base de datos de MySQL Local */
    $cnnPDO = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME, DB_USER, DB_PASSWORD, $utf8);
} catch (PDOException $e) {
    // Lanza la excepción
    die("Error de conexión: " . $e->getMessage());
}
?>
