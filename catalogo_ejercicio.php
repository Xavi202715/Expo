<?php
session_start();

// Rutinas con imágenes PNG transparentes
$routines = [
    // Categoría 1: Acondicionamiento General y Movilidad
    [
        'category_id' => 1,
        'category_title' => 'Conditioning and Mobility Routines',
        'category_class' => 'green-category',
        'cards' => [
            [
                'code' => 'EX-G1-01',
                'title' => 'Full Body Starter Routine',
                'description' => 'Low-impact movements to activate core strength and joint flexibility.',
                'condition' => 'ninguna',
                'level' => 'basico',
                'severity' => 1,
                'color' => 'green',
                'target_muscles' => 'Quadriceps, Core, Upper Back, Shoulders.',
                'duration' => '30 min/day',
                'frequency' => '3x / Weekly',
                'image' => 'img/piernas_superior.png'
            ],
            [
                'code' => 'EX-G2-01',
                'title' => 'Active Toning and Core',
                'description' => 'Progressive resistance training focused on functional stability.',
                'condition' => 'ninguna',
                'level' => 'intermedio',
                'severity' => 2,
                'color' => 'green',
                'target_muscles' => 'Abs, Glutes, Hamstrings, Lower Back.',
                'duration' => '45 min/day',
                'frequency' => '4x / Weekly',
                'image' => 'img/cuadritos.png'
            ],
            [
                'code' => 'EX-G1-02',
                'title' => 'Joint Protection & Low Impact',
                'description' => 'Gentle calorie-burning exercises designed to protect knees and hips.',
                'condition' => 'sobrepeso',
                'level' => 'basico',
                'severity' => 1,
                'color' => 'green',
                'target_muscles' => 'Legs, Glutes, Calves, Light Cardio.',
                'duration' => '35 min/day',
                'frequency' => '3x / Weekly',
                'image' => 'img/pantorrilla.png'
            ]
        ]
    ],
    // Categoría 2: Condición Específica de Salud
    [
        'category_id' => 2,
        'category_title' => 'Plans for Specific Conditions',
        'category_class' => 'orange-category',
        'cards' => [
            [
                'code' => 'EX-C1-01',
                'title' => 'Walking and Glycemic Endurance',
                'description' => 'Aerobic and light resistance exercises to optimize glucose uptake.',
                'condition' => 'diabetes',
                'level' => 'basico',
                'severity' => 1,
                'color' => 'orange',
                'target_muscles' => 'Calves, Hamstrings, Biceps, Core.',
                'duration' => '30 min/day',
                'frequency' => '5x / Weekly',
                'image' => 'img/biceps.png'
            ],
            [
                'code' => 'EX-C1-02',
                'title' => 'Controlled Cardiovascular Flow',
                'description' => 'Continuous moderate-intensity cardio to promote arterial circulation.',
                'condition' => 'hipertension',
                'level' => 'basico',
                'severity' => 1,
                'color' => 'orange',
                'target_muscles' => 'Cardiovascular System, Core, Glutes.',
                'duration' => '30 min/day',
                'frequency' => '4x / Weekly',
                'image' => 'img/gluteos.png'
            ]
        ]
    ],
    // Categoría 3: Alto Rendimiento
    [
        'category_id' => 3,
        'category_title' => 'Advanced Training & Intensity',
        'category_class' => 'red-category',
        'cards' => [
            [
                'code' => 'EX-A3-01',
                'title' => 'Hypertrophy and Muscle Strength',
                'description' => 'High-volume split training focused on progressive overload.',
                'condition' => 'ninguna',
                'level' => 'avanzado',
                'severity' => 3,
                'color' => 'red',
                'target_muscles' => 'Chest, Deltoids, Triceps, Back, Biceps.',
                'duration' => '60 min/day',
                'frequency' => '5x / Weekly',
                'image' => 'img/pecho.png'
            ]
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise and Fitness Plans | Nutrition Express</title>
    
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/catalogo_ejercicio.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
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
            <a href="carpetas.php" class="active">Plans</a>
            <a href="calculadora.php">Calculator</a>
            <a href="servicios.php">Services</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php">Profile</a>
        </nav>

        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i>
            Schedule Appointment
        </a>
    </header>

    <div class="container">

        <div class="top">
            <h1>Exercise and Workout Plans</h1>
            <p>Explore customized routines tailored to your target muscle groups, physical condition, and intensity level.</p>
        </div>

        <div class="filters">
            <input type="text" id="search" placeholder="Search routine or target muscle...">

            <select id="condition">
                <option value="all">Physical Condition (All)</option>
                <option value="ninguna">No Condition (General Conditioning)</option>
                <option value="sobrepeso">Low Impact / Weight Loss</option>
                <option value="diabetes">Glycemic Mobility / Cardio</option>
                <option value="hipertension">Controlled Blood Pressure</option>
                <option value="colesterol">Cardiovascular and Lipid Health</option>
            </select>

            <select id="level">
                <option value="all">Level (All)</option>
                <option value="basico">Beginner (Low Intensity)</option>
                <option value="intermedio">Intermediate (Moderate)</option>
                <option value="avanzado">Advanced (High Intensity)</option>
            </select>
        </div>

        <div class="sections-container" id="list">

            <?php foreach ($routines as $index => $category): ?>
                <section class="plan-section">
                    <h2 class="section-title <?= htmlspecialchars($category['category_class']) ?>">
                        <?= htmlspecialchars($category['category_title']) ?>
                    </h2>

                    <div class="cards-grid">
                        <?php foreach ($category['cards'] as $card): ?>
                            <div class="card" 
                                 data-condition="<?= htmlspecialchars($card['condition']) ?>" 
                                 data-level="<?= htmlspecialchars($card['level']) ?>" 
                                 data-severity="<?= htmlspecialchars($card['severity']) ?>">
                                 
                                <div class="card-top-bar">
                                    <div class="card-badge <?= htmlspecialchars($card['color']) ?>">
                                        <?= htmlspecialchars($card['code']) ?>
                                    </div>
                                    <button class="pin-btn" title="Pin Routine" onclick="togglePinCard(this)">
                                        <i class="fa-solid fa-thumbtack"></i>
                                    </button>
                                </div>

                                <div class="middle">
                                    <h3><?= htmlspecialchars($card['title']) ?></h3>
                                    <p><?= htmlspecialchars($card['description']) ?></p>
                                    
                                    <div class="workout-preview <?= htmlspecialchars($card['color']) ?>">
                                        <div class="body-silhouette-container">
                                            <img src="<?= htmlspecialchars($card['image']) ?>" 
                                                 alt="<?= htmlspecialchars($card['title']) ?>" 
                                                 class="muscle-img-png">
                                        </div>
                                        <div class="workout-details">
                                            <strong>Target Muscles</strong>
                                            <span><?= htmlspecialchars($card['target_muscles']) ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-info">
                                    <div><span>Duration</span><strong><?= htmlspecialchars($card['duration']) ?></strong></div>
                                    <div><span>Frequency</span><strong><?= htmlspecialchars($card['frequency']) ?></strong></div>
                                </div>

                                <div class="right">
                                    <button onclick="openPlan('<?= htmlspecialchars($card['code']) ?>')">View Routine</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <?php if ($index < count($routines) - 1): ?>
                    <hr class="section-divider">
                <?php endif; ?>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- ==========================================
     ACCESSIBILITY PANEL
========================================== -->
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

        <!-- Botón Modo Oscuro arreglado -->
        <div class="access-item" role="button" onclick="toggleDarkMode()">
            <div class="access-icon"><i class="fa-solid fa-moon"></i></div>
            <span>Dark Mode</span>
        </div>

        <!-- Botón Restablecer arreglado -->
        <div class="access-item" role="button" onclick="resetAccessibility()">
            <div class="access-icon"><i class="fa-solid fa-rotate-left"></i></div>
            <span>Reset All</span>
        </div>

        
            <div class="access-item" role="button" tabindex="0" onclick="readSelectedText()">
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
                    <a href="expertos.php">Experts</a>
                    <a href="recetas.php">Recipes</a>
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
            <p>&copy; <?= date('Y') ?> Nutrition Express. All rights reserved.</p>
            <div class="footer-legal">
                <a href="AVISO_PRIVACIDAD.html">Privacy Notice</a>
                <a href="TERMINOS_CONDICIONES.html">Terms and Conditions</a>
            </div>
        </div>
    </footer>

    <script src="js/catalogo.js"></script>
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>

    <script>
        function togglePinCard(btn) {
            const card = btn.closest('.card');
            card.classList.toggle('pinned');
        }

        function openPlan(planCode) {
            window.location.href = 'detalle_ejercicio.php?code=' + planCode;
        }
    </script>
</body>

</html>