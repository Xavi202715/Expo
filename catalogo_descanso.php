<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleep & Recovery Plans</title>
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/catalogo_descanso.css">
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
    <!-- Encabezado Centrado -->
    <div class="top">
        <h1>Sleep & Rest Plans</h1>
        <p>Discover the importance of good rest and find recommendations to improve your sleep quality, promote body recovery, and maintain a healthy lifestyle.</p>
    </div>

    <!-- Filtros de búsqueda y categoría -->
    <div class="filters">
        <input type="text" id="searchInput" placeholder="Search rest plan (e.g. Sleep Hygiene, Melatonin Boost)...">
        <select id="durationFilter">
            <option value="">All Durations</option>
            <option value="7">7 Days</option>
            <option value="14">14 Days</option>
            <option value="30">30 Days</option>
        </select>
        <select id="levelFilter">
            <option value="">All Intensity Levels</option>
            <option value="light">Light Rest</option>
            <option value="moderate">Deep Recovery</option>
            <option value="full">Total Reset</option>
        </select>
    </div>

    <!-- Contenedor de Secciones -->
    <div class="sections-container">
        
        <!-- SECCIÓN 1: SLEEP HYGIENE (VERDE) -->
        <div class="plan-section">
            <div class="section-title green-category">
                <h2>Sleep Hygiene & Night Routines</h2>
            </div>
            
            <div class="cards-grid">
                
                <!-- Card 1 -->
                <div class="card">
                    <button class="pin-btn" onclick="togglePinCard(this)" title="Save plan">★</button>
                    <div class="left green">R-01</div>
                    
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1541781774459-bb2af2f05b55?q=80&w=600&auto=format&fit=crop" alt="Night Routine">
                    </div>

                    <div class="middle">
                        <h3>Deep Sleep Protocol</h3>
                        <p>Optimized evening habits designed to reduce blue light exposure and prepare your mind for uninterrupted sleep.</p>
                        
                        <div class="meal-preview green">
                            <strong>Key Evening Habit:</strong>
                            <span>30-min digital detox & warm herbal tea before bed.</span>
                        </div>
                    </div>

                    <div class="card-info">
                        <div>
                            <span>Target Sleep</span>
                            <strong>8 Hours</strong>
                        </div>
                        <div>
                            <span>Duration</span>
                            <strong>14 Days</strong>
                        </div>
                    </div>

                    <div class="right">
                        <button class="btn-green" onclick="openPlan('R-01')">View Plan</button>
                    </div>
                </div>

                <!-- Card 2 (Imagen Corregida) -->
                <div class="card">
                    <button class="pin-btn" onclick="togglePinCard(this)" title="Save plan">★</button>
                    <div class="left green">R-02</div>
                    
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600&auto=format&fit=crop" alt="Circadian Rhythm Alignment">
                    </div>

                    <div class="middle">
                        <h3>Circadian Sync</h3>
                        <p>Align your sleep-wake cycle with natural sunlight exposure to fix erratic sleep schedules effortlessly.</p>
                        
                        <div class="meal-preview green">
                            <strong>Key Evening Habit:</strong>
                            <span>Morning light exposure within 30 min of waking up.</span>
                        </div>
                    </div>

                    <div class="card-info">
                        <div>
                            <span>Target Sleep</span>
                            <strong>7.5 Hours</strong>
                        </div>
                        <div>
                            <span>Duration</span>
                            <strong>21 Days</strong>
                        </div>
                    </div>

                    <div class="right">
                        <button class="btn-green" onclick="openPlan('R-02')">View Plan</button>
                    </div>
                </div>

            </div>
        </div>

        <hr class="section-divider">

        <!-- SECCIÓN 2: MUSCLE & ACTIVE RECOVERY (AMARILLO/NARANJA) -->
        <div class="plan-section">
            <div class="section-title orange-category">
                <h2>Active Body Recovery</h2>
            </div>
            
            <div class="cards-grid">
                
                <!-- Card 3 -->
                <div class="card">
                    <button class="pin-btn" onclick="togglePinCard(this)" title="Save plan">★</button>
                    <div class="left orange">REC-01</div>
                    
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?q=80&w=600&auto=format&fit=crop" alt="Yoga and Stretching">
                    </div>

                    <div class="middle">
                        <h3>Post-Workout Reset</h3>
                        <p>Gentle mobility routines and restorative stretching tailored to lower cortisol levels and repair sore muscles.</p>
                        
                        <div class="meal-preview orange">
                            <strong>Key Recovery Tool:</strong>
                            <span>15-min evening yoga + magnesium supplementation.</span>
                        </div>
                    </div>

                    <div class="card-info">
                        <div>
                            <span>Focus</span>
                            <strong>Muscle Repair</strong>
                        </div>
                        <div>
                            <span>Duration</span>
                            <strong>7 Days</strong>
                        </div>
                    </div>

                    <div class="right">
                        <button class="btn-orange" onclick="openPlan('REC-01')">View Plan</button>
                    </div>
                </div>

            </div>
        </div>

        <hr class="section-divider">

        <!-- SECCIÓN 3: TOTAL RESET / SEVERELY FATIGUED (ROJO) -->
        <div class="plan-section">
            <div class="section-title red-category">
                <h2>High Intensity Rest & Burnout Reset</h2>
            </div>
            
            <div class="cards-grid">
                
                <!-- Card 4 (Rojo) -->
                <div class="card">
                    <button class="pin-btn" onclick="togglePinCard(this)" title="Save plan">★</button>
                    <div class="left red">RST-01</div>
                    
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?q=80&w=600&auto=format&fit=crop" alt="Burnout Recovery">
                    </div>

                    <div class="middle">
                        <h3>Burnout & Nervous System Reset</h3>
                        <p>Intensive recovery protocol designed for extreme exhaustion, stress management, and chronic fatigue reboot.</p>
                        
                        <div class="meal-preview red">
                            <strong>Key Protocol:</strong>
                            <span>Non-Sleep Deep Rest (NSDR) & strict sensory deprivation.</span>
                        </div>
                    </div>

                    <div class="card-info">
                        <div>
                            <span>Intensity</span>
                            <strong>Total Reset</strong>
                        </div>
                        <div>
                            <span>Duration</span>
                            <strong>30 Days</strong>
                        </div>
                    </div>

                    <div class="right">
                        <button class="btn-red" onclick="openPlan('RST-01')">View Plan</button>
                    </div>
                </div>

                <!-- Card 5 (Rojo) -->
                <div class="card">
                    <button class="pin-btn" onclick="togglePinCard(this)" title="Save plan">★</button>
                    <div class="left red">RST-02</div>
                    
                    <div class="card-image">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=600&auto=format&fit=crop" alt="Deep Sleep Restoration">
                    </div>

                    <div class="middle">
                        <h3>Insomnia Overhaul</h3>
                        <p>A cognitive sleep restructuring program to break negative sleep associations and restore natural REM cycles.</p>
                        
                        <div class="meal-preview red">
                            <strong>Key Protocol:</strong>
                            <span>Sleep restriction therapy & progressive relaxation.</span>
                        </div>
                    </div>

                    <div class="card-info">
                        <div>
                            <span>Intensity</span>
                            <strong>Advanced</strong>
                        </div>
                        <div>
                            <span>Duration</span>
                            <strong>14 Days</strong>
                        </div>
                    </div>

                    <div class="right">
                        <button class="btn-red" onclick="openPlan('RST-02')">View Plan</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

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

          <!-- Botón dinámico Mute / Unmute Assistant -->
<div class="access-item" id="muteAssistantBtn" role="button" tabindex="0" onclick="toggleMuteAssistant()">
    <div class="access-icon"><i id="muteAssistantIcon" class="fa-solid fa-volume-xmark"></i></div>
    <span id="muteAssistantText">Mute Assistant</span>
</div>

        <div class="access-item" role="button" onclick="toggleDarkMode()">
            <div class="access-icon"><i class="fa-solid fa-moon"></i></div>
            <span>Dark Mode</span>
        </div>

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

    <script src="js/catalogo_descanso.js"></script>
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>

    <script>
        function togglePinCard(btn) {
            const card = btn.closest('.card');
            card.classList.toggle('pinned');
        }

        function openPlan(planCode) {
            window.location.href = 'detalle_descanso.php?code=' + planCode;
        }
    </script>

</body>
</html>