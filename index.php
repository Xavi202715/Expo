<?php
session_start();
require_once 'db.php'; // Tu conexión a la BD

$showReminder = false;
$userName = '';

// Evaluamos si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    try {
        // Consultar si el usuario tiene recordatorio o plan activo
        $stmt = $pdo->prepare("SELECT name, active_reminder FROM usuarios WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && isset($user['active_reminder']) && (int)$user['active_reminder'] === 1) {
            $showReminder = true;
            $userName = $user['name'] ?? 'Usuario';
        }
    } catch (PDOException $e) {
        // Registrar error en log sin interrumpir la experiencia del usuario
        error_log("Error en consulta index.php: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutritionExpress - Home</title>
    
    <!-- Hojas de Estilos -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/headfooter_boton.css">
    
    <!-- Fuentes y CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="page-context" content="You are on the Home Page. Here you can explore nutrition services, view daily tips, and schedule appointments.">
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
            <a href="index.php" class="active">Home</a>
            <a href="expertos1.php">Experts</a>
            <a href="carpetas.php">Plans</a>
            <a href="calculadora.php">Calculator</a>
            <a href="servicios.php">Services</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php">Profile</a>
        </nav>
        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

    <section class="hero-container">
        <div class="organic-shape shape-terracotta"></div>
        <div class="organic-shape shape-green"></div>
        <div class="organic-shape shape-cream-blob"></div>

        <div class="hero-left">
            <h1>Your Well-being,<br>Hassle-Free</h1>
            <p class="hero-subtitle">Personalized nutrition, easy access, and tools for a healthier life.</p>
            <div class="hero-actions">
                <a href="citas.php" class="btn-green-fill" style="text-decoration: none; display: inline-block; text-align: center;">
                    <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
                </a>
                <a href="tips.php" class="btn-outline-dark" style="text-decoration: none; display: inline-block; text-align: center;">
                    <i class="fa-solid fa-utensils"></i> View Tips
                </a>
            </div>
            <div class="hero-badges">
                <div class="badge-item"><i class="fa-solid fa-users"></i> <span>Inclusive<br>Care</span></div>
                <div class="badge-item"><i class="fa-solid fa-arrows-spin"></i> <span>Personalized<br>Plans</span></div>
                <div class="badge-item"><i class="fa-solid fa-award"></i> <span>Certified<br>Experts</span></div>
            </div>
        </div>

        <div class="hero-right-frame">
            <img src="img/mujerplato.jpg" alt="Nutrition Express" class="hero-main-img">
        </div>
    </section>

    <section class="quick-cards-section">
        <div class="q-card">
            <div class="q-icon-box box-orange">
                <i class="fa-regular fa-user"></i>
            </div>
            <div class="q-card-text">
                <h3>Experts</h3>
                <p>Meet our certified nutritionists.</p>
                <a href="expertos1.php" class="q-link link-orange" style="text-decoration: none; display: inline-block;">Learn More &rarr;</a>
            </div>
        </div>

        <div class="q-card">
            <div class="q-icon-box box-green">
                <i class="fa-solid fa-bowl-rice"></i>
            </div>
            <div class="q-card-text">
                <h3>Plans</h3>
                <p>Delicious recipes, exercises, and stress management.</p>
                <a href="carpetas.php" class="q-link link-green" style="text-decoration: none; display: inline-block;">Explore Recipes &rarr;</a>
            </div>
        </div>

        <div class="q-card">
            <div class="q-icon-box box-gold">
                <i class="fa-regular fa-calendar"></i>
            </div>
            <div class="q-card-text">
                <h3>Schedule Appointment</h3>
                <p>Book your consultation quickly and securely.</p>
                <a href="citas.php" class="q-link link-gold" style="text-decoration: none; display: inline-block;">Book Now &rarr;</a>
            </div>
        </div>

        <div class="q-card">
            <div class="q-icon-box box-blue">
                <i class="fa-regular fa-book"></i>
            </div>
            <div class="q-card-text">
                <h3>Resources</h3>
                <p>Guides, tips, and tools for your well-being.</p>
                <a href="recursos.php" class="q-link link-blue" style="text-decoration: none; display: inline-block;">View Resources &rarr;</a>
            </div>
        </div>
    </section>

    <section class="experts-section-container">
        <div class="experts-left-text">
            <h2>Our Experts</h2>
            <p>Nutrition professionals ready to guide you on your path to a healthier life.</p>
            <a href="expertos1.php" class="btn-green-fill" style="text-decoration: none; display: inline-block; text-align: center;">
                <i class="fa-solid fa-users"></i> Meet Everyone
            </a>
        </div>

        <div class="experts-cards-container">
            <div class="doctor-card">
                <div class="doctor-img-box">
                    <img src="img/doctora.webp" alt="Dr. Andrea López">
                </div>
                <div class="doctor-info">
                    <h3>Dr. Andrea López</h3>
                    <span class="specialty">Clinical Nutritionist</span>
                    <p class="desc"><i class="fa-solid fa-stethoscope"></i> Specialist in clinical nutrition and chronic diseases.</p>
                </div>
            </div>
            <div class="doctor-card">
                <div class="doctor-img-box">
                    <img src="img/doctor.avif" alt="Carlos Ramírez, B.S.">
                </div>
                <div class="doctor-info">
                    <h3>Carlos Ramírez, B.S.</h3>
                    <span class="specialty">Sports Nutritionist</span>
                    <p class="desc"><i class="fa-solid fa-dumbbell"></i> Specialist in sports nutrition and athletic performance.</p>
                </div>
            </div>
            <div class="doctor-card">
                <div class="doctor-img-box">
                    <img src="img/doctor2.avif" alt="Sofía Herrera, M.Sc.">
                </div>
                <div class="doctor-info">
                    <h3>Sofía Herrera, M.Sc.</h3>
                    <span class="specialty">Pediatric Nutritionist</span>
                    <p class="desc"><i class="fa-solid fa-child"></i> Specialist in child nutrition and development.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="recipes-section">
        <div class="recipes-header">
            <div>
                <h2>Featured Plans</h2>
                <p class="recipes-subtitle">Healthy ideas for every moment of the day.</p>
            </div>
            <a href="carpetas.php" class="view-all-link" style="text-decoration: none;">View All Plans &rarr;</a>
        </div>

        <div class="recipes-horizontal-list">
            <a href="DETALLE_RECETA_SMOOTHIE.html" class="recipe-horizontal-card" style="text-decoration: none; color: inherit; display: flex;">
                <div class="recipe-img-container">
                    <img src="img/smothie.webp" alt="Smoothie bowl">
                </div>
                <div class="recipe-content-container">
                    <span class="recipe-tag tag-breakfast">Breakfast</span>
                    <h3>Berry Smoothie Bowl</h3>
                    <span class="recipe-duration"><i class="fa-regular fa-clock"></i> 20 min</span>
                </div>
            </a>

            <a href="DETALLE_RECETA_ENSALADA.html" class="recipe-horizontal-card" style="text-decoration: none; color: inherit; display: flex;">
                <div class="recipe-img-container">
                    <img src="img/ensaladagarbanzos.webp" alt="Quinoa salad">
                </div>
                <div class="recipe-content-container">
                    <span class="recipe-tag tag-lunch">Lunch</span>
                    <h3>Quinoa and Chickpea Salad</h3>
                    <span class="recipe-duration"><i class="fa-regular fa-clock"></i> 30 min</span>
                </div>
            </a>

            <a href="DETALLE_RECETA_SOPA.html" class="recipe-horizontal-card" style="text-decoration: none; color: inherit; display: flex;">
                <div class="recipe-img-container">
                    <img src="img/lentejas.jpg" alt="Lentil soup">
                </div>
                <div class="recipe-content-container">
                    <span class="recipe-tag tag-dinner">Dinner</span>
                    <h3>Lentil Soup with Vegetables</h3>
                    <span class="recipe-duration"><i class="fa-regular fa-clock"></i> 40 min</span>
                </div>
            </a>
        </div>
    </section>

    <section class="cta-blue-banner">
        <div class="cta-left">
            <div class="cta-icon-circle"><i class="fa-regular fa-calendar-check"></i></div>
            <div class="cta-titles">
                <h2>Schedule Your Appointment Today</h2>
                <p>In-person or online consultation. Choose what best suits your needs.</p>
            </div>
        </div>
        <a href="citas.php" class="btn-white-cta" style="text-decoration: none; display: inline-block; text-align: center;">
            Book Now
        </a>
    </section>

    <section class="values-section">
        <h2>Nutrition for Everyone</h2>
        <p class="values-main-sub">At Nutrition Express, we believe in inclusive, accessible, and respectful care. Everyone is welcome.</p>
        
        <div class="values-grid">
            <div class="value-item">
                <div class="value-icon-box"><i class="fa-solid fa-users"></i></div>
                <h4>Non-discriminatory Care</h4>
            </div>
            <div class="value-item">
                <div class="value-icon-box"><i class="fa-solid fa-comments"></i></div>
                <h4>Clear and Accessible Language</h4>
            </div>
            <div class="value-item">
                <div class="value-icon-box"><i class="fa-solid fa-leaf"></i></div>
                <h4>Vegetarian and Vegan Options</h4>
            </div>
            <div class="value-item">
                <div class="value-icon-box"><i class="fa-solid fa-wheelchair"></i></div>
                <h4>Accommodations for Special Needs</h4>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-top">
            <div class="footer-brand-column">
                <div class="newsletter-box">
                    <p><i class="fa-regular fa-envelope"></i> Receive healthy tips and recipes in your inbox</p>
                    <div class="input-group">
                        <input type="email" placeholder="Your email address" aria-label="Your email address">
                        <button type="button" aria-label="Subscribe"><i class="fa-solid fa-arrow-right"></i></button>
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
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Nutrition Express. All rights reserved.</p>
            <div class="footer-legal">
                <a href="AVISO_PRIVACIDAD.html">Privacy Notice</a>
                <a href="TERMINOS_CONDICIONES.html">Terms and Conditions</a>
            </div>
        </div>
    </footer>

    <!-- Panel de Accesibilidad -->
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

            <div class="access-item" role="button" tabindex="0" onclick="toggleContrast()">
                <div class="access-icon"><i class="fa-solid fa-circle-half-stroke"></i></div>
                <span style="font-size: 13px;">High Contrast</span>
            </div>

            <div class="access-item" role="button" tabindex="0" onclick="toggleDarkMode()">
                <div class="access-icon"><i class="fa-solid fa-moon"></i></div>
                <span>Dark Mode</span>
            </div>

            <div class="access-item" role="button" tabindex="0" onclick="resetAccessibility()">
                <div class="access-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <span>Reset All</span>
            </div>

            <div class="access-item" role="button" tabindex="0" onclick="readSelectedText()">
    <div class="access-icon"><i class="fa-solid fa-volume-high"></i></div>
    <span>Read Aloud</span>
</div>

            <div class="access-item" role="button" tabindex="0" onclick="toggleDyslexia()">
                <div class="access-icon"><i class="fa-solid fa-book-open"></i></div>
                <span>Dyslexia Mode</span>
            </div>

            <div class="access-item" role="button" tabindex="0" onclick="toggleLetterSpacing()">
                <div class="access-icon letter-space">AAA</div>
                <span>More Spacing</span>
            </div>

            <div class="access-item" role="button" tabindex="0" onclick="toggleFocusVisible()">
                <div class="access-icon"><i class="fa-solid fa-expand"></i></div>
                <span>Visible Focus</span>
            </div>
        </div>
        <p class="panel-footer">You can change these options at any time.</p>
    </div>

    <!-- Modal de Recordatorio PHP -->
    <?php if ($showReminder): ?>
    <div id="reminderModal" class="reminder-modal-overlay active">
        <div class="reminder-modal-card">
            <div class="reminder-modal-icon">
                <i class="fa-solid fa-bell-concierge"></i>
            </div>
            <h3>¡Hola, <?php echo htmlspecialchars($userName, ENT_QUOTES, 'UTF-8'); ?>!</h3>
            <p>Tienes un plan de nutrición o avance pendiente. ¿Deseas continuar donde lo dejaste?</p>
            
            <div class="reminder-modal-actions">
                <a href="carpetas.php" class="btn-reminder-continue">
                    <i class="fa-solid fa-arrow-right"></i> Ver Mis Planes
                </a>
                <button type="button" class="btn-reminder-close" onclick="dismissReminderBD()">
                    Cerrar y no mostrar más
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Scripts de la Aplicación -->
    <script>
    function dismissReminderBD() {
        fetch('api/dismiss_reminder.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modal = document.getElementById("reminderModal");
                if (modal) modal.classList.remove("active");
            } else {
                console.warn('No se pudo desactivar el recordatorio en BD.');
            }
        })
        .catch(error => console.error('Error al actualizar recordatorio:', error));
    }
    </script>
    <script src="js/artyom.window.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>
</body>
</html>