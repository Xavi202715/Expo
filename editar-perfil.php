<?php
// editar-perfil.php
session_start();

// 1. Incluimos tu conexión oficial (usa $conexion)
require_once 'db.php';

// 2. Validamos sesión activa
if (!isset($_SESSION['usuario_correo'])) {
    header('Location: login.php');
    exit;
}

$correo_sesion = $_SESSION['usuario_correo'];

// 3. PROCESAR GUARDADO DE DATOS (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre       = $_POST['nombre'] ?? '';
    $edad         = !empty($_POST['edad']) ? intval($_POST['edad']) : NULL;
    $sexo         = $_POST['sexo'] ?? '';
    $peso         = !empty($_POST['peso']) ? floatval($_POST['peso']) : NULL;
    $estatura     = !empty($_POST['estatura']) ? floatval($_POST['estatura']) : NULL;
    $objetivo     = $_POST['objetivo'] ?? '';
    $actividad    = $_POST['actividad'] ?? '';
    $alimentacion = $_POST['alimentacion'] ?? '';
    $comidas      = $_POST['comidas'] ?? '';
    $favoritos    = $_POST['favoritos'] ?? '';
    $evitar       = $_POST['evitar'] ?? '';
    $condiciones  = $_POST['condiciones'] ?? '';
    $discapacidad = $_POST['discapacidad'] ?? '';

    // Manejo de foto de perfil
    $rutaFoto = NULL;
    if (isset($_FILES['nuevaFoto']) && $_FILES['nuevaFoto']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'uploads/';
        if (!file_exists($directorio)) { 
            mkdir($directorio, 0777, true); 
        }
        $rutaFoto = $directorio . time() . '_' . basename($_FILES['nuevaFoto']['name']);
        move_uploaded_file($_FILES['nuevaFoto']['tmp_name'], $rutaFoto);
    }

    // Actualización en MySQL (corregido a WHERE email = ?)
    if ($rutaFoto) {
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre=?, edad=?, sexo=?, peso=?, estatura=?, objetivo=?, actividad=?, alimentacion=?, comidas=?, favoritos=?, evitar=?, condiciones=?, discapacidad=?, foto=? WHERE email=?");
        $stmt->bind_param("sisddssssssssss", $nombre, $edad, $sexo, $peso, $estatura, $objetivo, $actividad, $alimentacion, $comidas, $favoritos, $evitar, $condiciones, $discapacidad, $rutaFoto, $correo_sesion);
    } else {
        $stmt = $conexion->prepare("UPDATE usuarios SET nombre=?, edad=?, sexo=?, peso=?, estatura=?, objetivo=?, actividad=?, alimentacion=?, comidas=?, favoritos=?, evitar=?, condiciones=?, discapacidad=? WHERE email=?");
        $stmt->bind_param("sisddsssssssss", $nombre, $edad, $sexo, $peso, $estatura, $objetivo, $actividad, $alimentacion, $comidas, $favoritos, $evitar, $condiciones, $discapacidad, $correo_sesion);
    }

    $stmt->execute();
    $_SESSION['usuario_nombre'] = $nombre; // Actualizar nombre en sesión
    
    header('Location: perfil.php?status=success');
    exit;
}

// 4. OBTENER DATOS ACTUALES PARA RELLENAR LOS INPUTS
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $correo_sesion);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Nutrition Express</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/editar-perfil.css">
</head>
<body>

    <header class="main-header">
        <a href="index.php" class="logo-area" style="text-decoration: none; color: inherit;">
            <img src="img/logo.png" alt="Nutrition Express Logo">
            <div class="logo-text">
                <span class="brand-title">Nutrition</span>
                <span class="brand-sub">Express</span>
            </div>
        </a>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="perfil.php" class="active">Profile</a>
        </nav>
    </header>

    <main style="width: 90%; max-width: 900px; margin: 40px auto;">
        <h1 style="text-align: center; margin-bottom: 20px; color: #BE8C4A;">Completa / Edita tu Perfil</h1>

        <form action="editar-perfil.php" method="POST" enctype="multipart/form-data" class="card" style="background:#fff; padding:30px; border-radius:15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            
            <!-- Foto -->
            <div style="text-align:center; margin-bottom: 20px;">
                <img src="<?php echo !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : 'img/user.png'; ?>" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #5A8D63;">
                <br><br>
                <input type="file" name="nuevaFoto" accept="image/*">
            </div>

            <!-- Datos Básicos -->
            <h3>Información Personal</h3>
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?>" required style="width:100%; padding:10px; margin-bottom:15px;">

            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Edad:</label>
                    <input type="number" name="edad" value="<?php echo htmlspecialchars($usuario['edad'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:15px;">
                </div>
                <div style="flex: 1;">
                    <label>Sexo:</label>
                    <select name="sexo" style="width:100%; padding:10px; margin-bottom:15px;">
                        <option value="">Seleccionar</option>
                        <option value="Femenino" <?php echo ($usuario['sexo']??'')=='Femenino'?'selected':''; ?>>Femenino</option>
                        <option value="Masculino" <?php echo ($usuario['sexo']??'')=='Masculino'?'selected':''; ?>>Masculino</option>
                        <option value="Otro" <?php echo ($usuario['sexo']??'')=='Otro'?'selected':''; ?>>Otro</option>
                    </select>
                </div>
            </div>

            <!-- Datos Físicos -->
            <h3>Datos Físicos y Objetivos</h3>
            <div style="display: flex; gap: 15px;">
                <div style="flex: 1;">
                    <label>Peso (kg):</label>
                    <input type="number" step="0.1" name="peso" value="<?php echo htmlspecialchars($usuario['peso'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:15px;">
                </div>
                <div style="flex: 1;">
                    <label>Estatura (m - Ej: 1.70):</label>
                    <input type="number" step="0.01" name="estatura" value="<?php echo htmlspecialchars($usuario['estatura'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:15px;">
                </div>
            </div>

            <label>Objetivo Principal:</label>
            <input type="text" name="objetivo" placeholder="Ej. Perder peso, Ganar masa muscular" value="<?php echo htmlspecialchars($usuario['objetivo'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Alimentación:</label>
            <input type="text" name="alimentacion" placeholder="Ej. Omnívora, Vegetariana, Keto" value="<?php echo htmlspecialchars($usuario['alimentacion'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Comidas al día:</label>
            <input type="text" name="comidas" placeholder="Ej. 3 comidas" value="<?php echo htmlspecialchars($usuario['comidas'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:15px;">

            <label>Alimentos Favoritos:</label>
            <textarea name="favoritos" style="width:100%; padding:10px; margin-bottom:15px;"><?php echo htmlspecialchars($usuario['favoritos'] ?? ''); ?></textarea>

            <label>Alimentos a Evitar / Alergias:</label>
            <textarea name="evitar" style="width:100%; padding:10px; margin-bottom:15px;"><?php echo htmlspecialchars($usuario['evitar'] ?? ''); ?></textarea>

            <label>Condiciones Médicas:</label>
            <textarea name="condiciones" style="width:100%; padding:10px; margin-bottom:15px;"><?php echo htmlspecialchars($usuario['condiciones'] ?? ''); ?></textarea>

            <label>Discapacidad / Limitación:</label>
            <input type="text" name="discapacidad" value="<?php echo htmlspecialchars($usuario['discapacidad'] ?? ''); ?>" style="width:100%; padding:10px; margin-bottom:20px;">

            <div style="text-align: center;">
                <a href="perfil.php" style="padding: 10px 20px; background: #ccc; text-decoration: none; color: #333; border-radius: 5px; margin-right: 10px;">Cancelar</a>
                <button type="submit" style="padding: 10px 25px; background: #5A8D63; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Guardar Datos</button>
            </div>
        </form>
    </main>

</body>
</html>