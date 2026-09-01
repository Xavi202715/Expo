<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriScan AI | Nutritional Analysis</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/calculadora.css">
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <meta name="page-context" content="You are on the Nutrition Calculator. Here you can upload food photos, speak, or type meals to analyze their macros with AI.">
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
            <a href="calculadora.php" class="active">Calculator</a>
            <a href="servicios.php">Community</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php">Profile</a>
        </nav>

        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

    <main class="app-container">
        <header class="app-header">
            <h1>NutriScan AI</h1>
            <p>Discover what's on your plate instantly or describe your meal.</p>
        </header>

        <!-- SECCIÓN DE SELECCIÓN POR PESTAÑAS (ACCESIBILIDAD) -->
        <div class="input-tabs" role="tablist" aria-label="Input Method Selection">
            <button class="tab-btn active" data-target="panel-image" role="tab" aria-selected="true" id="tab-image">
                📷 Photo / Camera
            </button>
            <button class="tab-btn" data-target="panel-text" role="tab" aria-selected="false" id="tab-text">
                ✍️ Text / Keyboard
            </button>
            <button class="tab-btn" data-target="panel-voice" role="tab" aria-selected="false" id="tab-voice">
                🎙️ Voice Input
            </button>
        </div>

        <!-- PANEL 1: FOTO / CÁMARA -->
        <section id="panel-image" class="tab-panel upload-section" role="tabpanel" aria-labelledby="tab-image">
            <label for="imageUpload" class="btn-upload" tabindex="0" role="button">
                <span class="icon">📸</span> Take Photo or Upload
            </label>
            <input type="file" id="imageUpload" accept="image/*" capture="environment">
        </section>

    <!-- PANEL 2: TEXTO / TECLADO CON MICRÓFONO INTEGRADO -->
<section id="panel-text" class="tab-panel hidden" role="tabpanel" aria-labelledby="tab-text">
    <div class="text-input-container">
        <label for="foodTextInput" style="font-weight: 500; font-size: 0.95rem; margin-bottom: 8px; display: block;">
            Describe your food or meal:
        </label>
        
        <!-- Envoltorio para la caja de texto y el botón de voz integrado -->
        <div class="input-with-mic-wrapper">
            <textarea id="foodTextInput" class="food-textarea" placeholder="e.g., A plate of grilled chicken breast with steamed broccoli..."></textarea>
            <button id="btnInlineMic" type="button" class="btn-inline-mic" title="Dictate meal by voice" aria-label="Dictate text">
                <i class="fa-solid fa-microphone"></i>
            </button>
        </div>

        <button id="btnAnalyzeText" class="btn-upload" type="button" style="margin-top: 15px;">
            ✨ Analyze Meal
        </button>
    </div>
</section>

        <!-- PANEL 3: VOZ -->
        <section id="panel-voice" class="tab-panel hidden" role="tabpanel" aria-labelledby="tab-voice">
            <div style="text-align: center;">
                <p style="margin-bottom: 15px; color: var(--text-muted);">Click the button below and describe what you are eating clearly:</p>
                <button id="btnVoiceRecord" class="btn-voice" type="button">
                    🎤 Dictate Food
                </button>
            </div>
        </section>

        <!-- INDICADOR DE CARGA / SPINNER -->
        <section class="loader-section hidden" id="loaderSection">
            <div class="spinner"></div>
            <p>AI is analyzing your meal...</p>
        </section>

        <!-- CONTENEDOR DE RESULTADOS -->
        <div class="content-grid">
            <section class="preview-section hidden" id="previewSection">
                <img id="imagePreview" alt="Food preview">
            </section>

            <section class="results-section hidden" id="resultsSection">
                <h2 id="foodName">Dish Name</h2>
                
                <div class="macros-grid">
                    <div class="macro-card">
                        <span class="macro-label">Calories</span>
                        <span class="macro-value" id="calValue">0 kcal</span>
                    </div>
                    <div class="macro-card">
                        <span class="macro-label">Protein</span>
                        <span class="macro-value" id="protValue">0 g</span>
                    </div>
                    <div class="macro-card">
                        <span class="macro-label">Fats</span>
                        <span class="macro-value" id="fatValue">0 g</span>
                    </div>
                </div>

                <div class="ingredients-box">
                    <h3>Detected ingredients:</h3>
                    <ul id="ingredientsList"></ul>
                </div>

                <!-- SECCIÓN DE RECOMENDACIONES DE LA IA -->
                <div class="recommendations-box" style="margin-top: 20px;">
                    <h3>💡 Healthy Recommendation / Substitutions:</h3>
                    <p id="recommendationsText">Loading recommendations...</p>
                </div>
            </section>
        </div>
    </main>

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

    <script src="js/artyom.window.min.js"></script>
    <script src="js/script.js"></script>

    <script src="js/calculadora.js"></script>
</body>
</html>