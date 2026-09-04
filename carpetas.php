<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutritional Plans | Nutrition Express</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/carpetas.css">
    <link rel="stylesheet" href="css/headfooter_boton.css">
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
            <a href="servicios.php">Community</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php">Profile</a>
        </nav>
        <a href="citas.php" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

<section class="hero-carousel">
    <input type="radio" name="slider" id="slide1" checked>
    <input type="radio" name="slider" id="slide2">
    <input type="radio" name="slider" id="slide3">

    <div class="slides-container">
        <div class="slide slide-1">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="hero-tag">JUST EAT IT.</span>
                <h1>Personalized Nutritional Plans</h1>
                <p>Discover the plan that best suits your needs and improve your eating habits to achieve a healthier life.</p>
                <button class="nike-btn">Get Started Now</button>
            </div>
        </div>

        <div class="slide slide-2">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="hero-tag">PUSH YOUR LIMITS.</span>
                <h1>Boost Your Performance</h1>
                <p>High-protein diets designed specifically for athletes and gym enthusiasts looking to build muscle mass.</p>
                <button class="nike-btn">View Fitness Plans</button>
            </div>
        </div>

        <div class="slide slide-3">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <span class="hero-tag">NATURAL BALANCE.</span>
                <h1>Mindful Nutrition</h1>
                <p>Learn to connect with fresh, organic foods. The perfect balance your body needs every day.</p>
                <button class="nike-btn">Explore Recipes</button>
            </div>
        </div>
    </div>

    <div class="carousel-dots">
        <label for="slide1" class="dot"></label>
        <label for="slide2" class="dot"></label>
        <label for="slide3" class="dot"></label>
    </div>
</section>

<section class="recommended">
    <h2>Your Recommended Plan</h2>
    <div class="recommended-card">
        <i class="fa-solid fa-star"></i>
        <div>
            <h3>Balanced Meal Plan</h3>
            <p>Ideal for maintaining complete nutrition, boosting daily energy, and developing healthy habits.</p>
        </div>
    </div>
</section>

<section class="plans-section">
    <h2>Available Plans</h2>
    <div class="plans-grid">
        
        <div class="plan-card">
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=600" alt="Balanced Nutrition">
            </div>
            <div class="card-body">
                <h3>Meal Plan</h3>
                <p>Balanced nutrition to maintain good overall health and consistent energy.</p>
                <div class="details">
                  
                </div>
                <button class="card-btn" onclick="window.location.href='catalogo.php'">View Plan</button>
            </div>
        </div>

        <div class="plan-card">
            <div class="card-image">
                <img src="https://bible5.com/wp-content/uploads/2024/10/musculo-1.jpg" alt="Muscle Gain">
            </div>
            <div class="card-body">
                <h3>Exercise</h3>
                <p>Access physical activity routines designed for adults, tailored to different fitness levels and goals.</p>
                <div class="details">
                
                </div>
                <button class="card-btn" onclick="window.location.href='catalogo_ejercicio.php'">View Plan</button>
            </div>
        </div>

        <div class="plan-card">
            <div class="card-image">
                <img src="https://images.unsplash.com/photo-1511690656952-34342bb7c2f2?q=80&w=600" alt="Weight Loss">
            </div>
            <div class="card-body">
                <h3>Rest</h3>
                <p>Discover the importance of good rest and find recommendations to improve your sleep quality, promote body recovery, and maintain a healthy lifestyle.</p>
                <div class="details">
                
                </div>
                <button class="card-btn" onclick="window.location.href='catalogo_descanso.php'">View Plan</button>
            </div>
        </div>

      

    </div>
</section>

<section class="benefits">
    <h2>Benefits of Following a Nutritional Plan</h2>
    <div class="benefits-grid">
        <div class="benefit-card">
            <i class="fa-solid fa-bolt"></i>
            <h3>More Energy</h3>
        </div>
        <div class="benefit-card">
            <i class="fa-solid fa-heart"></i>
            <h3>Better Health</h3>
        </div>
        <div class="benefit-card">
            <i class="fa-solid fa-brain"></i>
            <h3>Greater Focus</h3>
        </div>
        <div class="benefit-card">
            <i class="fa-solid fa-person-running"></i>
            <h3>Better Performance</h3>
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

          <!-- Botón dinámico Mute / Unmute Assistant -->
<div class="access-item" id="muteAssistantBtn" role="button" tabindex="0" onclick="toggleMuteAssistant()">
    <div class="access-icon"><i id="muteAssistantIcon" class="fa-solid fa-volume-xmark"></i></div>
    <span id="muteAssistantText">Mute Assistant</span>
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
    
    <script src="js/artyom.window.min.js"></script>
    <script src="js/asistente.js"></script>
    <script src="js/script.js"></script>
    <script src="js/carpetas.js"></script>

</body>
</html>