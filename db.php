<?php
$host = "localhost";
$user = "root";     // Cambia por tu usuario de MySQL
$pass = "";         // Cambia por tu contraseña de MySQL
$db   = "nutrition_express";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
$conexion->set_charset("utf8mb4");
?>