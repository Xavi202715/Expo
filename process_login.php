<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($email) && !empty($password)) {
        $stmt = $conexion->prepare("SELECT id, nombre, email, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($usuario = $resultado->fetch_assoc()) {
            // Verificar contraseña
            if (password_verify($password, $usuario['password']) || $password === $usuario['password']) {
                $_SESSION['usuario_id']     = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_correo'] = $usuario['email'];

                header("Location: perfil.php");
                exit;
            }
        }
    }
    
    header("Location: login.php?error=invalid_credentials");
    exit;
}
?>