<?php
session_start();
require_once 'db.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Obtener datos actualizados del usuario desde la BD
$userId = $_SESSION['user_id'];
$stmt = $conexion->prepare("SELECT nombre, email, creado_en FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - NutritionExpress</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .profile-card {
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            max-width: 500px;
            margin: 50px auto;
            text-align: center;
        }
        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #3a6b45;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 15px;
        }
        .profile-info {
            text-align: left;
            margin: 20px 0;
        }
        .profile-info div {
            margin-bottom: 12px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }
        .btn-logout {
            display: inline-block;
            background: #d32f2f;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <main class="auth-wrapper">
        <div class="profile-card">
            <div class="profile-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <h2>User Profile</h2>
            <p>Welcome to your control panel.</p>

            <div class="profile-info">
                <div><strong>Name:</strong> <?php echo htmlspecialchars($usuario['nombre']); ?></div>
                <div><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></div>
                <div><strong>Member Since:</strong> <?php echo date("F j, Y", strtotime($usuario['creado_en'])); ?></div>
            </div>

            <a href="logout.php" class="btn-logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
        </div>
    </main>

</body>
</html>