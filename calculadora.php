<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriScan AI | Nutritional Analysis</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/calculadora.css">
    <link rel="stylesheet" href="css/headfooter_boton.css"
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <header class="main-header">
        <a href="index.html" class="logo-area" id="logoBtn" style="text-decoration: none; color: inherit;">
            <img src="img/logo.png" alt="Nutrition Express Logo">
            <div class="logo-text">
                <span class="brand-title">Nutrition</span>
                <span class="brand-sub">Express</span>
            </div>
        </a>
        <nav class="nav-links">
            <a href="index.html">Home</a>
            <a href="expertos1.html">Experts</a>
            <a href="carpetas.html">Plans</a>
            <a href="calculadora.html" class="active">Calculator</a>
            <a href="servicios.html">Services</a>
            <a href="nosotros.html">About Us</a>
        </nav>
        <a href="citas.html" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

    <main class="app-container">
        <header class="app-header">
            <h1>NutriScan AI</h1>
            <p>Discover what's on your plate instantly.</p>
        </header>

        <section class="upload-section">
            <label for="imageUpload" class="btn-upload">
                <span class="icon">📸</span> Take Photo or Upload
            </label>
            <input type="file" id="imageUpload" accept="image/*" capture="environment">
        </section>

        <section class="preview-section hidden" id="previewSection">
            <img id="imagePreview" alt="Food preview">
        </section>

        <section class="loader-section hidden" id="loaderSection">
            <div class="spinner"></div>
            <p>AI is analyzing your meal...</p>
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
        </section>
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
                    <a href="index.html">Home</a>
                    <a href="expertos1.html">Experts</a>
                    <a href="carpetas.html">Recipes</a>
                    <a href="servicios.html">Services</a>
                </div>
                <div class="footer-col">
                    <h4>Services</h4>
                    <a href="servicios.html">Nutritional Consultation</a>
                    <a href="servicios.html">Sports Nutrition</a>
                    <a href="servicios.html">Pediatric Nutrition</a>
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
            <p>&copy; 2024 Nutrition Express. All rights reserved.</p>
            <div class="footer-legal">
                <a href="AVISO_PRIVACIDAD.html">Privacy Notice</a>
                <a href="TERMINOS_CONDICIONES.html">Terms and Conditions</a>
            </div>
        </div>
    </footer>

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
    <script src="js/asistente.js"></script>
    <script src="js/calculadora.js"></script>
</body>
</html>