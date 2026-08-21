<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutritionExpress - Home</title>
    <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            <a href="carpetas.php  ">Plans</a>
            <a href="calculadora.php">Calculator</a>
            <a href="servicios.php">Services</a>
            <a href="nosotros.php">About Us</a>
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
                <i class="fa-solid fa-users-viewfinder"></i>
                <h4>Non-discriminatory Care</h4>
            </div>
            <div class="value-item">
                <i class="fa-regular fa-comment-dots"></i>
                <h4>Clear and Accessible Language</h4>
            </div>
            <div class="value-item">
                <i class="fa-solid fa-seedling"></i>
                <h4>Vegetarian and Vegan Options</h4>
            </div>
            <div class="value-item">
                <i class="fa-solid fa-wheelchair"></i>
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
</body>
</html>