<?php
// Configuración de la base de datos
$servidor = "localhost";
$usuario  = "root";
$password = "";
$base_datos = "nutricion_express";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Validar que los datos vengan por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tiene_ninos = isset($_POST['tiene_ninos']) ? $_POST['tiene_ninos'] : 'no';
    
    // Si no tiene niños, guardamos la edad como NULL
    $edad_nino = ($tiene_ninos === 'si' && isset($_POST['edad_nino'])) ? $_POST['edad_nino'] : null;

    // Preparar consulta para evitar Inyección SQL
    $stmt = $conexion->prepare("INSERT INTO progreso_juego (tiene_ninos, edad_nino) VALUES (?, ?)");
    $stmt->bind_param("ss", $tiene_ninos, $edad_nino);

    if ($stmt->execute()) {
        // Registro exitoso, aquí puedes redirigir a la siguiente etapa de tu juego
        echo "<h3>¡Progreso guardado con éxito! Cargando el juego...</h3>";
        // header("Location: siguiente_etapa.html"); 
    } else {
        echo "Error al guardar el progreso: " . $stmt->error;
    }

    $stmt->close();
}

$conexion->close();
?>