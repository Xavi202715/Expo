<?php
// editar-perfil.php
session_start();

// 1. Incluimos la conexión a la BD
require_once 'db.php';

// 2. Validamos sesión activa
if (!isset($_SESSION['usuario_correo'])) {
    header('Location: login.php');
    exit;
}

$correo_sesion = $_SESSION['usuario_correo'];

// 3. PROCESAR GUARDADO DE DATOS (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recibir y sanitizar campos
    $nombre       = trim($_POST['nombre'] ?? '');
    $sexo         = trim($_POST['sexo'] ?? '');
    $objetivo     = trim($_POST['objetivo'] ?? '');
    $actividad    = trim($_POST['actividad'] ?? '');
    $alimentacion = trim($_POST['alimentacion'] ?? '');
    $comidas      = trim($_POST['comidas'] ?? '');
    $favoritos    = trim($_POST['favoritos'] ?? '');
    $evitar       = trim($_POST['evitar'] ?? '');
    $condiciones  = trim($_POST['condiciones'] ?? '');
    $discapacidad = trim($_POST['discapacidad'] ?? '');

    // Numéricos (Aseguramos cadenas de número o vacíos limpios para bind)
    $edad     = (isset($_POST['edad']) && $_POST['edad'] !== '') ? intval($_POST['edad']) : 0;
    $peso     = (isset($_POST['peso']) && $_POST['peso'] !== '') ? floatval($_POST['peso']) : 0.0;
    $estatura = (isset($_POST['estatura']) && $_POST['estatura'] !== '') ? floatval($_POST['estatura']) : 0.0;

    // Manejo de foto de perfil
    $rutaFoto = null;
    if (isset($_FILES['nuevaFoto']) && $_FILES['nuevaFoto']['error'] === UPLOAD_ERR_OK) {
        $directorio = 'uploads/';
        if (!file_exists($directorio)) { 
            mkdir($directorio, 0755, true); 
        }
        $extension = pathinfo($_FILES['nuevaFoto']['name'], PATHINFO_EXTENSION);
        $rutaFoto = $directorio . time() . '_' . uniqid() . '.' . strtolower($extension);
        move_uploaded_file($_FILES['nuevaFoto']['tmp_name'], $rutaFoto);
    }

    // Consulta SQL y bind_param sin tipos flotantes incompatibles con NULL
    if ($rutaFoto) {
        $sql = "UPDATE usuarios SET nombre=?, edad=?, sexo=?, peso=?, estatura=?, objetivo=?, actividad=?, alimentacion=?, comidas=?, favoritos=?, evitar=?, condiciones=?, discapacidad=?, foto=? WHERE email=?";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sisddssssssssss", $nombre, $edad, $sexo, $peso, $estatura, $objetivo, $actividad, $alimentacion, $comidas, $favoritos, $evitar, $condiciones, $discapacidad, $rutaFoto, $correo_sesion);
            $stmt->execute();
        }
    } else {
        $sql = "UPDATE usuarios SET nombre=?, edad=?, sexo=?, peso=?, estatura=?, objetivo=?, actividad=?, alimentacion=?, comidas=?, favoritos=?, evitar=?, condiciones=?, discapacidad=? WHERE email=?";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("sisddsssssssss", $nombre, $edad, $sexo, $peso, $estatura, $objetivo, $actividad, $alimentacion, $comidas, $favoritos, $evitar, $condiciones, $discapacidad, $correo_sesion);
            $stmt->execute();
        }
    }

    $_SESSION['usuario_nombre'] = $nombre; // Actualizar nombre en sesión
    
    header('Location: perfil.php?status=success');
    exit;
}

// 4. OBTENER DATOS ACTUALES PARA RELLENAR LOS INPUTS
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $correo_sesion);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc() ?? [];
?>
  
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Nutrition Express</title>
    <!-- FontAwesome para Íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/editar-perfil.css">
</head>
<body>

   <header class="main-header">
        <a href="index.php" class="logo-area" id="logoBtn" style="text-decoration: none; color: inherit;">
            <img src="img/logo.png" alt="Nutrition Express Logo">
            <div class="logo-text">
                <span class="brand-title">Nutrition</span>
                <span class="brand-sub">Express</span>
            </div>
        </a>
        <nav class="nav-links">
            <a href="index.php">Home</a>
            <a href="expertos1.php">Experts</a>
            <a href="carpetas.php">Plans</a>
            <a href="calculadora.php">Calculator</a>
            <a href="servicios.php">Services</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php" class="active">Profile</a>
        </nav>
        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

    <!-- 2. CONTENIDO PRINCIPAL -->
    <main class="editar-container">
        
        <div class="encabezado-editar">
            <h1><i class="fa-solid fa-user-pen"></i> Configurar Perfil</h1>
            <p>Actualiza tu información personal, médica y de hábitos nutricionales.</p>
        </div>

        <form action="editar-perfil.php" method="POST" enctype="multipart/form-data" class="editar-form">
            
            <!-- TARJETA 1: FOTO Y DATOS BÁSICOS -->
            <div class="card">
                <h2><i class="fa-solid fa-id-card"></i> Información Personal</h2>
                
                <div class="avatar-upload-section">
                    <div class="avatar-preview-wrapper">
                        <img id="avatarPreview" src="<?php echo !empty($usuario['foto']) ? htmlspecialchars($usuario['foto']) : 'img/user.png'; ?>" alt="Foto de perfil">
                        <label for="nuevaFoto" class="btn-cambiar-foto" title="Cambiar Foto">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                    </div>
                    <input type="file" id="nuevaFoto" name="nuevaFoto" accept="image/*" style="display: none;" onchange="previewImage(this)">
                    <p class="hint-foto">Haz clic en la cámara para subir una nueva foto.</p>
                </div>

                <div class="form-grid">
                    <div class="input-group full-width">
                        <label for="nombre"><i class="fa-solid fa-user"></i> Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?>" required placeholder="Tu nombre y apellido">
                    </div>

                    <div class="input-group">
                        <label for="edad"><i class="fa-solid fa-calendar"></i> Edad:</label>
                        <input type="number" id="edad" name="edad" value="<?php echo htmlspecialchars($usuario['edad'] ?? ''); ?>" placeholder="Ej. 25">
                    </div>

                    <div class="input-group">
                        <label for="sexo"><i class="fa-solid fa-venus-mars"></i> Sexo:</label>
                        <select id="sexo" name="sexo">
                            <option value="">Seleccionar...</option>
                            <option value="Femenino" <?php echo ($usuario['sexo']??'')=='Femenino'?'selected':''; ?>>Femenino</option>
                            <option value="Masculino" <?php echo ($usuario['sexo']??'')=='Masculino'?'selected':''; ?>>Masculino</option>
                            <option value="Otro" <?php echo ($usuario['sexo']??'')=='Otro'?'selected':''; ?>>Otro</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TARJETA 2: DATOS FÍSICOS Y OBJETIVOS -->
            <div class="card">
                <h2><i class="fa-solid fa-weight-scale"></i> Parámetros Físicos y Objetivos</h2>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="peso"><i class="fa-solid fa-weight-hanging"></i> Peso (kg):</label>
                        <input type="number" step="0.1" id="peso" name="peso" value="<?php echo htmlspecialchars($usuario['peso'] ?? ''); ?>" placeholder="Ej. 70.5">
                    </div>

                    <div class="input-group">
                        <label for="estatura"><i class="fa-solid fa-ruler-vertical"></i> Estatura (m):</label>
                        <input type="number" step="0.01" id="estatura" name="estatura" value="<?php echo htmlspecialchars($usuario['estatura'] ?? ''); ?>" placeholder="Ej. 1.75">
                    </div>

                    <div class="input-group">
                        <label for="objetivo"><i class="fa-solid fa-bullseye"></i> Objetivo Principal:</label>
                        <input type="text" id="objetivo" name="objetivo" placeholder="Ej. Perder peso, Ganar masa muscular" value="<?php echo htmlspecialchars($usuario['objetivo'] ?? ''); ?>">
                    </div>

                    <div class="input-group">
                        <label for="actividad"><i class="fa-solid fa-person-running"></i> Nivel de Actividad:</label>
                        <select id="actividad" name="actividad">
                            <option value="">Seleccionar...</option>
                            <option value="Sedentaria" <?php echo ($usuario['actividad']??'')=='Sedentaria'?'selected':''; ?>>Sedentaria</option>
                            <option value="Ligera" <?php echo ($usuario['actividad']??'')=='Ligera'?'selected':''; ?>>Ligera (1-3 días/sem)</option>
                            <option value="Moderada" <?php echo ($usuario['actividad']??'')=='Moderada'?'selected':''; ?>>Moderada (3-5 días/sem)</option>
                            <option value="Intensa" <?php echo ($usuario['actividad']??'')=='Intensa'?'selected':''; ?>>Intensa (6-7 días/sem)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- TARJETA 3: PREFERENCIAS Y HÁBITOS -->
            <div class="card">
                <h2><i class="fa-solid fa-utensils"></i> Hábitos y Nutrición</h2>
                <div class="form-grid">
                    <div class="input-group">
                        <label for="alimentacion"><i class="fa-solid fa-apple-whole"></i> Tipo de Alimentación:</label>
                        <input type="text" id="alimentacion" name="alimentacion" placeholder="Ej. Omnívora, Vegetariana, Keto" value="<?php echo htmlspecialchars($usuario['alimentacion'] ?? ''); ?>">
                    </div>

                    <div class="input-group">
                        <label for="comidas"><i class="fa-solid fa-clock"></i> Comidas al día:</label>
                        <input type="text" id="comidas" name="comidas" placeholder="Ej. 3 comidas + 2 snacks" value="<?php echo htmlspecialchars($usuario['comidas'] ?? ''); ?>">
                    </div>

                    <div class="input-group full-width">
                        <label for="favoritos"><i class="fa-solid fa-heart"></i> Alimentos Favoritos:</label>
                        <textarea id="favoritos" name="favoritos" placeholder="Lista tus alimentos preferidos..."><?php echo htmlspecialchars($usuario['favoritos'] ?? ''); ?></textarea>
                    </div>

                    <div class="input-group full-width">
                        <label for="evitar"><i class="fa-solid fa-ban"></i> Alimentos a Evitar / Alergias:</label>
                        <textarea id="evitar" name="evitar" placeholder="Lista alimentos que te causen alergia o no te gusten..."><?php echo htmlspecialchars($usuario['evitar'] ?? ''); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- TARJETA 4: SALUD Y CONDICIONES -->
            <div class="card">
                <h2><i class="fa-solid fa-notes-medical"></i> Salud y Discapacidad</h2>
                <div class="form-grid">
                    <div class="input-group full-width">
                        <label for="condiciones"><i class="fa-solid fa-file-medical"></i> Condiciones Médicas / Enfermedades:</label>
                        <textarea id="condiciones" name="condiciones" placeholder="Ej. Diabetes, Hipertensión, Gastritis..."><?php echo htmlspecialchars($usuario['condiciones'] ?? ''); ?></textarea>
                    </div>

                    <div class="input-group full-width">
                        <label for="discapacidad"><i class="fa-solid fa-wheelchair"></i> Discapacidad / Limitación Física:</label>
                        <input type="text" id="discapacidad" name="discapacidad" value="<?php echo htmlspecialchars($usuario['discapacidad'] ?? ''); ?>" placeholder="Especifica si posees alguna limitación física">
                    </div>
                </div>
            </div>

            <!-- BOTONES DE ACCIÓN BARRA -->
            <div class="acciones-form">
                <a href="perfil.php" class="btn-cancelar"><i class="fa-solid fa-xmark"></i> Cancelar</a>
                <button type="submit" class="btn-guardar"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
            </div>

        </form>
    </main>

  <!-- FOOTER -->
    <footer class="main-footer">
        <div class="footer-top">
            <div class="footer-brand-column">
                <div class="newsletter-box">
                    <p><i class="fa-regular fa-envelope"></i> Receive healthy tips and recipes in your inbox</p>
                    <div class="input-group">
                        <input type="email" placeholder="Your email address">
                        <button><i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="footer-links-columns">
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <a href="index.php">Home</a>
                    <a href="expertos1.php">Experts</a>
                    <a href="carpetas.php">Recipes</a>
                    <a href="servicios.php">Services</a>
                </div>
                <div class="footer-col">
                    <h4>Services</h4>
                    <a href="servicios.php">Nutritional Consultation</a>
                    <a href="servicios.php">Sports Nutrition</a>
                    <a href="servicios.php">Pediatric Nutrition</a>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="footer-socials">
                        <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://youtube.com" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://tiktok.com" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Nutrition Express. All rights reserved.</p>
            <div class="footer-legal">
                <a href="AVISO_PRIVACIDAD.html">Privacy Notice</a>
                <a href="TERMINOS_CONDICIONES.html">Terms and Conditions</a>
            </div>
        </div>
    </footer>

    <!-- ACCESSIBILITY PANEL -->
    <button id="accessibilityBtn" class="access-btn" title="Accessibility Options" onclick="toggleAccessPanel()">♿</button>

    <div id="accessibilityPanel" class="access-panel">
        <h3>Quick Accessibility</h3>
        <div class="accessibility-grid">
            <div class="access-item" id="textAccessItem" onclick="toggleZoomButtons(event)">
                <div class="access-icon text-icon">A</div>
                <div class="zoom-buttons" id="zoomContainer">
                    <button type="button" onclick="changeFontSize(1, event)" title="Increase font size">+</button>
                    <button type="button" onclick="changeFontSize(-1, event)" title="Decrease font size">-</button>
                </div>
                <span>Large Text</span>
            </div>
            <div class="access-item" role="button" onclick="toggleContrast()">
                <div class="access-icon"><i class="fa-solid fa-circle-half-stroke"></i></div>
                <span style="font-size: 13px;">High Contrast</span>
            </div>
            <div class="access-item" role="button" onclick="toggleDarkMode()">
                <div class="access-icon"><i class="fa-solid fa-moon"></i></div>
                <span>Dark Mode</span>
            </div>
            <div class="access-item" role="button" onclick="resetAccessibility()">
                <div class="access-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <span>Reset All</span>
            </div>
            <div class="access-item" role="button" onclick="speakText()">
                <div class="access-icon"><i class="fa-solid fa-volume-high"></i></div>
                <span>Read Aloud</span>
            </div>
            <div class="access-item" role="button" onclick="toggleDyslexia()">
                <div class="access-icon"><i class="fa-solid fa-book-open"></i></div>
                <span>Dyslexia Mode</span>
            </div>
            <div class="access-item" role="button" onclick="toggleLetterSpacing()">
                <div class="access-icon letter-space">AAA</div>
                <span>More Spacing</span>
            </div>
            <div class="access-item" role="button" onclick="toggleFocusVisible()">
                <div class="access-icon"><i class="fa-solid fa-expand"></i></div>
                <span>Visible Focus</span>
            </div>
        </div>
        <p class="panel-footer">You can change these options at any time.</p>
    </div>

    <!-- 5. JAVASCRIPT LOCAL Y GLOBAL -->
    <script>
        // Vista previa instantánea de la nueva imagen seleccionada
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarPreview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Cargar tema previo si existía
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>

    <script src="js/editar-perfil.js"></script>
    <script src="js/asistente.js"></script>
    <script src="js/script.js"></script>

</body>
</html>