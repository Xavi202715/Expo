<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($email) && !empty($password)) {
        // Consulta preparada para traer SOLO el usuario que coincide con el correo ingresado
        $stmt = $conexion->prepare("SELECT id, nombre, email, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $usuario = $resultado->fetch_assoc()) {
            
            // Verificación exacta de contraseña
            if (password_verify($password, $usuario['password']) || $password === $usuario['password']) {
                
                // Limpiamos datos anteriores para asegurar que la sesión sea fresca
                session_unset();

                // Guardamos LOS DATOS OBTENIDOS DE LA BASE DE DATOS para este correo específico
                $_SESSION['usuario_id']     = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_correo'] = $usuario['email']; // Asigna xavier.abigail2027@...

                header("Location: perfil.php");
                exit;
            }
        }
    }
    
    // Si la contraseña o el correo no coinciden
    header("Location: login.php?error=invalid_credentials");
    exit;
}
?>