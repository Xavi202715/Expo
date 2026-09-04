<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balanced Eating Plan | Nutrition Express</title>
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">

    <style>
        /* Estilos para el botón Pin / Favorito en las cards */
        .card {
            position: relative;
            transition: transform 0.3s ease, border 0.3s ease;
        }

        .pin-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: transparent;
            border: none;
            color: #ccc;
            font-size: 16px;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
            z-index: 10;
        }

        .pin-btn:hover {
            color: #e63946;
            transform: scale(1.2);
        }

        /* Estado cuando la tarjeta está fijada */
        .card.pinned {
            border: 2px solid #e63946 !important;
            box-shadow: 0px 4px 15px rgba(230, 57, 70, 0.25);
        }

        .card.pinned .pin-btn {
            color: #e63946;
            transform: rotate(-45deg);
        }
    </style>
</head>

<body>

    <!-- ==========================================
         HEADER
    ========================================== -->
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

    <!-- ==========================================
         MAIN CONTAINER
    ========================================== -->
    <div class="container">

        <!-- TITLE -->
        <div class="top">
            <h1>Nutrition Plans</h1>
            <p>Explore nutritional plans tailored to your specific conditions, severity grade, and health goals</p>
        </div>

        <!-- FILTERS -->
        <div class="filters">
            <input type="text" id="search" placeholder="Search plan...">

            <select id="condition">
                <option value="all">Condition (All)</option>
                <option value="ninguna">No Condition</option>
                <option value="sobrepeso">Overweight</option>
                <option value="diabetes">Diabetes</option>
                <option value="hipertension">Hypertension</option>
                <option value="colesterol">High Cholesterol</option>
            </select>

            <select id="level">
                <option value="all">Level (All)</option>
                <option value="basico">Basic (Grade 1)</option>
                <option value="intermedio">Intermediate (Grade 2)</option>
                <option value="avanzado">Advanced (Grade 3)</option>
            </select>
        </div>

        <!-- PLANS CATALOG -->
        <div class="sections-container" id="list">

            <!-- =======================================================
                 CATEGORÍA 1: GENERAL AND PREVENTIVE PLANS (GREEN)
            ======================================================== -->
            <section class="plan-section">
                <h2 class="section-title green-category">General and Preventive Plans</h2>

                <div class="cards-grid">

                    <!-- AB-G1-01 -->
                    <div class="card" data-condition="ninguna" data-level="basico" data-severity="1">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab green">AB-G1-01</div>
                        <div class="middle">
                            <h3>General Balanced Nutrition</h3>
                            <p>Complete daily nutrition to establish healthy eating habits.</p>
                            <div class="meal-preview green">
                                <strong>Meal idea</strong>
                                <span>Vegetables, whole grains, eggs, and lean chicken breast.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>30 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-G1-01')">View Plan</button>
                        </div>
                    </div>

                    <!-- AB-G2-01 -->
                    <div class="card" data-condition="ninguna" data-level="intermedio" data-severity="2">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab green">AB-G2-01</div>
                        <div class="middle">
                            <h3>Active Lifestyle & Longevity</h3>
                            <p>Optimal macro distribution for daily energy and vitality.</p>
                            <div class="meal-preview green">
                                <strong>Meal idea</strong>
                                <span>Quinoa bowl, wild salmon, mixed greens, and walnuts.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>45 days</strong></div>
                            <div><span>Follow-up</span><strong>Bi-weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-G2-01')">View Plan</button>
                        </div>
                    </div>

                    <!-- AB-G1-02 -->
                    <div class="card" data-condition="sobrepeso" data-level="basico" data-severity="1">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab green">AB-G1-02</div>
                        <div class="middle">
                            <h3>Weight Management Starter</h3>
                            <p>Portion control guide for healthy weight reduction.</p>
                            <div class="meal-preview green">
                                <strong>Meal idea</strong>
                                <span>Steamed greens, grilled chicken, quinoa, and avocado.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>30 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-G1-02')">View Plan</button>
                        </div>
                    </div>

                    <!-- AB-G2-02 -->
                    <div class="card" data-condition="sobrepeso" data-level="intermedio" data-severity="2">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab green">AB-G2-02</div>
                        <div class="middle">
                            <h3>Metabolic Reset & Fat Loss</h3>
                            <p>Caloric deficit plan focused on satiety and muscle retention.</p>
                            <div class="meal-preview green">
                                <strong>Meal idea</strong>
                                <span>Turkey breast, roasted asparagus, cauliflower rice, and berries.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>45 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-G2-02')">View Plan</button>
                        </div>
                    </div>

                </div>
            </section>

            <hr class="section-divider">

            <!-- =======================================================
                 CATEGORÍA 2: CONDITION CONTROL PLANS (ORANGE)
            ======================================================== -->
            <section class="plan-section">
                <h2 class="section-title orange-category">Condition Control Plans</h2>

                <div class="cards-grid">

                    <!-- AB-C1-01 -->
                    <div class="card" data-condition="diabetes" data-level="basico" data-severity="1">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab orange">AB-C1-01</div>
                        <div class="middle">
                            <h3>Beginner Glycemic Care</h3>
                            <p>Simple food swaps designed to prevent blood sugar spikes.</p>
                            <div class="meal-preview orange">
                                <strong>Meal idea</strong>
                                <span>Oatmeal with chia seeds, boiled eggs, and cucumber slices.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>30 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-C1-01')">View Plan</button>
                        </div>
                    </div>

                    <!-- AB-C2-01 -->
                    <div class="card" data-condition="diabetes" data-level="intermedio" data-severity="2">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab orange">AB-C2-01</div>
                        <div class="middle">
                            <h3>Type 2 Diabetes Control</h3>
                            <p>Glucose level management with low-glycemic index meals.</p>
                            <div class="meal-preview orange">
                                <strong>Meal idea</strong>
                                <span>Grilled fish, leafy green salad, lentils, and cinnamon tea.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>45 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-C2-01')">View Plan</button>
                        </div>
                    </div>

                   

                    <!-- AB-C1-03 -->
                    <div class="card" data-condition="colesterol" data-level="basico" data-severity="1">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab orange">AB-C1-03</div>
                        <div class="middle">
                            <h3>Saturated Fat Reduction</h3>
                            <p>Gentle transition to low-saturated fat and clean cooking oils.</p>
                            <div class="meal-preview orange">
                                <strong>Meal idea</strong>
                                <span>Steamed white fish, olive oil salad dressing, and berries.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>30 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-C1-03')">View Plan</button>
                        </div>
                    </div>

                    <!-- AB-C2-03 -->
                    <div class="card" data-condition="colesterol" data-level="intermedio" data-severity="2">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab orange">AB-C2-03</div>
                        <div class="middle">
                            <h3>Lipid Balance & Heart Health</h3>
                            <p>Soluble fiber and healthy fats focus to support normal cholesterol.</p>
                            <div class="meal-preview orange">
                                <strong>Meal idea</strong>
                                <span>Oats with flaxseed, grilled salmon, and avocado salad.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>45 days</strong></div>
                            <div><span>Follow-up</span><strong>Bi-weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-C2-03')">View Plan</button>
                        </div>
                    </div>

                </div>
            </section>

            <hr class="section-divider">

            <!-- =======================================================
                 CATEGORÍA 3: ADVANCED PERFORMANCE PLANS (RED)
            ======================================================== -->
            <section class="plan-section">
                <h2 class="section-title red-category">Advanced & Intensive Plans</h2>

                <div class="cards-grid">

                   
                    <!-- AB-A3-02 -->
                    <div class="card" data-condition="sobrepeso" data-level="avanzado" data-severity="3">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab red">AB-A3-02</div>
                        <div class="middle">
                            <h3>Advanced Body Composition</h3>
                            <p>Carbohydrate cycling and protein focus for body recomposition.</p>
                            <div class="meal-preview red">
                                <strong>Meal idea</strong>
                                <span>Seared tuna steak, sautéed kale, pumpkin seeds, and green tea.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>60 days</strong></div>
                            <div><span>Follow-up</span><strong>Weekly</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-A3-04')">View Plan</button>
                        </div>
                    </div>

                    <!-- AB-A3-03 -->
                    <div class="card" data-condition="diabetes" data-level="avanzado" data-severity="3">
                        <button class="pin-btn" title="Pin Plan" onclick="togglePinCard(this)">
                            <i class="fa-solid fa-thumbtack"></i>
                        </button>
                        <div class="left ab red">AB-A3-03</div>
                        <div class="middle">
                            <h3>Advanced Insulin Sensitivity</h3>
                            <p>Strict low-glycemic load protocol for long-term glucose stability.</p>
                            <div class="meal-preview red">
                                <strong>Meal idea</strong>
                                <span>Baked cod, sautéed kale, bell peppers, and raw almonds.</span>
                            </div>
                        </div>
                        <div class="card-info">
                            <div><span>Duration</span><strong>60 days</strong></div>
                            <div><span>Follow-up</span><strong>Twice a week</strong></div>
                        </div>
                        <div class="right">
                            <button onclick="openPlan('AB-A3-03')">View Plan</button>
                        </div>
                    </div>

                   
                </div>
            </section>

        </div>
    </div>

    <!-- ==========================================
         FOOTER
    ========================================== -->
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
            <p>&copy; 2026 Nutrition Express. All rights reserved.</p>
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

    <!-- ==========================================
         SCRIPTS
    ========================================== -->
    <script src="js/catalogo.js"></script>
    <script src="js/artyom.window.min.js"></script>
    <script src="js/asistente.js"></script>
    <script src="js/script.js"></script>

    <script>
        function togglePinCard(button) {
            const card = button.closest('.card');
            const grid = card.parentElement;

            card.classList.toggle('pinned');

            if (card.classList.contains('pinned')) {
                grid.prepend(card);
            } else {
                grid.appendChild(card);
            }
        }
    </script>

</body>
</html>