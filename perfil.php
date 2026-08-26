<?php
// perfil.php
session_start();

// 1. INCLUIR LA CONEXIÓN A LA BASE DE DATOS
require_once 'db.php';

// 2. Validar que exista la sesión iniciada
if (!isset($_SESSION['usuario_correo'])) {
    header('Location: login.php');
    exit;
}

// 3. Obtener los datos reales del usuario desde la BD
$correo_sesion = $_SESSION['usuario_correo'];

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $correo_sesion);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    $usuario = [
        'nombre' => $_SESSION['usuario_nombre'] ?? 'Usuario',
        'email'  => $correo_sesion,
        'edad' => null, 'sexo' => null, 'peso' => null, 'estatura' => null,
        'objetivo' => null, 'actividad' => null, 'alimentacion' => null,
        'comidas' => null, 'favoritos' => null, 'evitar' => null,
        'condiciones' => null, 'discapacidad' => null, 'foto' => 'img/user.png'
    ];
}

// Función auxiliar para validar si un dato no está vacío y no es '0' o nulo
function tieneValor($val) {
    return isset($val) && trim((string)$val) !== '' && trim((string)$val) !== '0';
}

// 4. Calcular IMC si existen peso y estatura
$imc = 0;
$categoriaIMC = 'No registrado';
if (tieneValor($usuario['peso']) && tieneValor($usuario['estatura']) && floatval($usuario['estatura']) > 0) {
    $peso = floatval($usuario['peso']);
    $estatura = floatval($usuario['estatura']);
    $imc = round($peso / ($estatura * $estatura), 1);
    
    if ($imc < 18.5) $categoriaIMC = 'Bajo peso';
    elseif ($imc < 25) $categoriaIMC = 'Peso saludable';
    elseif ($imc < 30) $categoriaIMC = 'Sobrepeso';
    else $categoriaIMC = 'Obesidad';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Nutrition Express</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/perfil.css">
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

    <div class="overlay" id="overlay"></div>

    <main>
        <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div id="mensajeExito" class="alerta-exito">
                <i class="fa-solid fa-circle-check"></i> ¡Perfil actualizado con éxito!
            </div>
        <?php endif; ?>

        <!-- HEADER DEL PERFIL DINÁMICO -->
        <section class="perfil-header-card">
            <div class="foto-contenedor">
                <img src="<?php echo (!empty($usuario['foto']) && file_exists($usuario['foto'])) ? htmlspecialchars($usuario['foto']) : 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png'; ?>" alt="Foto de perfil">
            </div>
            <div class="info-principal">
                <h1><?php echo htmlspecialchars($usuario['nombre']); ?></h1>
                <p class="correo"><i class="fa-regular fa-envelope"></i> <?php echo htmlspecialchars($usuario['email']); ?></p>
                <div class="tags">
                    <span class="badge badge-meta">
                        <i class="fa-solid fa-bullseye"></i> 
                        <?php echo !empty($usuario['objetivo']) ? htmlspecialchars($usuario['objetivo']) : 'Sin objetivo fijado'; ?>
                    </span>
                    <span class="badge badge-dieta">
                        <i class="fa-solid fa-leaf"></i> 
                        <?php echo !empty($usuario['alimentacion']) ? htmlspecialchars($usuario['alimentacion']) : 'Sin tipo de dieta'; ?>
                    </span>
                </div>
            </div>
            <div class="accion-header">
                <a href="editar-perfil.php" class="btn-editar"><i class="fa-solid fa-pen-to-square"></i> Editar Perfil</a>
            </div>
        </section>

        <!-- GRID DE INFORMACIÓN REAL -->
        <div class="perfil-grid">
            
         <!-- DATOS PERSONALES Y FÍSICOS -->
<article class="card">
    <h2><i class="fa-solid fa-user"></i> Datos Personales</h2>
    <ul class="datos-lista">
        <li><strong>Edad</strong> <span><?php echo tieneValor($usuario['edad']) ? htmlspecialchars($usuario['edad']) . ' años' : '<i>No especificado</i>'; ?></span></li>
        <li><strong>Sexo</strong> <span><?php echo tieneValor($usuario['sexo']) ? htmlspecialchars($usuario['sexo']) : '<i>No especificado</i>'; ?></span></li>
        <li><strong>Peso</strong> <span><?php echo tieneValor($usuario['peso']) ? htmlspecialchars($usuario['peso']) . ' kg' : '<i>No especificado</i>'; ?></span></li>
        <li><strong>Estatura</strong> <span><?php echo tieneValor($usuario['estatura']) ? htmlspecialchars($usuario['estatura']) . ' m' : '<i>No especificado</i>'; ?></span></li>
        <li><strong>Actividad</strong> <span><?php echo tieneValor($usuario['actividad']) ? htmlspecialchars($usuario['actividad']) : '<i>No especificado</i>'; ?></span></li>
    </ul>
</article>
            <!-- RESUMEN DE SALUD / IMC -->
            <article class="card imc-card">
                <h2><i class="fa-solid fa-heart-pulse"></i> Estado Físico (IMC)</h2>
                <div class="imc-resumen">
                    <span class="imc-valor"><?php echo $imc > 0 ? $imc : '--'; ?></span>
                    <span class="imc-estado"><?php echo $categoriaIMC; ?></span>
                </div>
                <p class="imc-desc">
                    <?php echo $imc > 0 ? 'Índice calculado según tu peso y estatura registrados.' : 'Ingresa tu peso y estatura en "Editar Perfil" para calcular tu IMC automáticamente.'; ?>
                </p>
            </article>

            <!-- PREFERENCIAS ALIMENTICIAS -->
            <article class="card">
                <h2><i class="fa-solid fa-utensils"></i> Hábitos y Preferencias</h2>
                <ul class="datos-lista">
                    <li><strong>Frecuencia</strong> <span><?php echo !empty($usuario['comidas']) ? htmlspecialchars($usuario['comidas']) : '<i>No especificado</i>'; ?></span></li>
                    <li><strong>Alimentos Favoritos</strong> <span><?php echo !empty($usuario['favoritos']) ? htmlspecialchars($usuario['favoritos']) : '<i>Ninguno agregado</i>'; ?></span></li>
                    <li><strong>Alimentos a Evitar</strong> <span><?php echo !empty($usuario['evitar']) ? htmlspecialchars($usuario['evitar']) : '<i>Ninguno agregado</i>'; ?></span></li>
                </ul>
            </article>

            <!-- CONDICIONES DE SALUD -->
            <article class="card">
                <h2><i class="fa-solid fa-notes-medical"></i> Salud y Accesibilidad</h2>
                <ul class="datos-lista">
                    <li><strong>Condiciones Médicas</strong> <span><?php echo !empty($usuario['condiciones']) ? htmlspecialchars($usuario['condiciones']) : '<i>Ninguna reportada</i>'; ?></span></li>
                    <li><strong>Discapacidad / Limitación</strong> <span><?php echo !empty($usuario['discapacidad']) ? htmlspecialchars($usuario['discapacidad']) : '<i>Ninguna reportada</i>'; ?></span></li>
                </ul>
            </article>

        </div>
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

    <script src="js/perfil.js"></script>
    <script src="js/asistente.js"></script>
    <script src="js/script.js"></script>

    <!-- SCRIPT PARA TEMPORIZAR MENSAJE DE ÉXITO -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mensaje = document.getElementById('mensajeExito');
            
            if (mensaje) {
                // Desaparece gradualmente a los 3 segundos
                setTimeout(() => {
                    mensaje.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    mensaje.style.opacity = '0';
                    mensaje.style.transform = 'translateY(-10px)';
                    
                    // Se elimina del HTML al terminar la animación
                    setTimeout(() => {
                        mensaje.remove();
                    }, 500);
                }, 3000);

                // Quita "?status=success" de la URL sin recargar la página
                if (window.history.replaceState) {
                    const urlLimpia = window.location.protocol + "//" + window.location.host + window.location.pathname;
                    window.history.replaceState({ path: urlLimpia }, '', urlLimpia);
                }
            }
        });
    </script>

    <script src="js/perfil.js"></script>
    <script src="js/asistente.js"></script>
    <script src="js/script.js"></script>
</body>
</html>