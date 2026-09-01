<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = trim($_POST['nombre'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($nombre) && !empty($email) && !empty($password)) {
        // 1. Verificar si el correo ya existe
        $checkStmt = $conexion->prepare("SELECT id FROM usuarios WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            header("Location: register.php?error=email_exists");
            exit;
        }
        $checkStmt->close();

        // 2. Encriptar contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // 3. Insertar nuevo usuario
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $passwordHash);

        if ($stmt->execute()) {
            $userId = $stmt->insert_id;

            // 4. Iniciar sesión automáticamente
            $_SESSION['usuario_id']     = $userId;
            $_SESSION['usuario_nombre'] = $nombre;
            $_SESSION['usuario_correo'] = $email;

            // 5. Redirigir directo al Perfil
            header("Location: perfil.php");
            exit;
        } else {
            header("Location: register.php?error=db_error");
            exit;
        }
    } else {
        header("Location: register.php?error=empty_fields");
        exit;
    }
}
?>