<?php
$conn = new mysqli("localhost", "root", "", "nutrition_express");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedUserName'], $_POST['feedMessage'])) {
    $stmt = $conn->prepare("INSERT INTO comentarios (nombre, mensaje) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['feedUserName'], $_POST['feedMessage']);
    $stmt->execute();
    $stmt->close();

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$resultado = $conn->query("SELECT * FROM comentarios ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community</title>
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="css/servicios.css">
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
            <a href="index.php">Home</a>
            <a href="expertos1.php">Experts</a>
            <a href="carpetas.php">Plans</a>
            <a href="calculadora.php">Calculator</a>
            <a href="servicios.php" class="active">Community</a>
            <a href="nosotros.php">About Us</a>
            <a href="perfil.php">Profile</a>
        </nav>
        <a href="citas.html" class="header-btn-schedule" id="headerScheduleBtn" style="text-align: center; text-decoration: none; display: inline-block;">
            <i class="fa-regular fa-calendar-days"></i> Schedule Appointment
        </a>
    </header>

<section class="hero">
        <div class="hero-text">
            <h1>Your journey,<span><br>together</span></h1>
            <p>Connect, share, learn, and stay motivated with people working toward healthier everyday habits.</p>
            <div class="hero-buttons">
                <a href="#challenges" class="btn-green-fill" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-trophy"></i> Explore Challenges
                </a>
            </div>
        </div>
        <div class="hero-image">
            <img src="img/chica con fruta.png" alt="Nutritionist">
        </div>
    </section>

    <main class="com-page">

        <!-- community challenges -->
        <section class="challenges-section" id="challenges">
            <div class="section-title-box">
                <h2>Community Challenges</h2>
                <p>Challenges you can complete to build consistent, sustainable healthy habits.</p>
            </div>
            
            <div class="challenges-grid">
                <!-- 7-Day Hydration Challenge -->
                <div class="challenge-card" data-id="1">
                    <div class="challenge-card-header">
                        <span class="challenge-badge tag-green">Hydration</span>
                        <i class="fa-solid fa-droplet challenge-icon"></i>
                    </div>
                    <h3>7-Day Hydration Challenge</h3>
                    <p>Drink at least 2.5L of water daily to boost energy and overall well-being.</p>
                    <div class="challenge-meta">
                        <i class="fa-solid fa-user-group"></i> 1,248 people joined
                    </div>
                    <button class="btn-challenge-join">Join Challenge <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <!-- 30-Day Movement Challenge -->
                <div class="challenge-card" data-id="2">
                    <div class="challenge-card-header">
                        <span class="challenge-badge tag-orange">Movement</span>
                        <i class="fa-solid fa-person-running challenge-icon"></i>
                    </div>
                    <h3>30-Day Movement Challenge</h3>
                    <p>Commit to 20 minutes of daily physical activity tailored to your level.</p>
                    <div class="challenge-meta">
                        <i class="fa-solid fa-user-group"></i> 3,410 people joined
                    </div>
                    <button class="btn-challenge-join">Join Challenge <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <!-- Healthy Breakfast Week -->
                <div class="challenge-card" data-id="3">
                    <div class="challenge-card-header">
                        <span class="challenge-badge tag-gold">Nutrition</span>
                        <i class="fa-solid fa-egg challenge-icon"></i>
                    </div>
                    <h3>Healthy Breakfast Week</h3>
                    <p>Fuel your mornings with balanced, protein- and fiber-rich nutrient choices.</p>
                    <div class="challenge-meta">
                        <i class="fa-solid fa-user-group"></i> 892 people joined
                    </div>
                    <button class="btn-challenge-join">Join Challenge <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <!-- Better Sleep Challenge -->
                <div class="challenge-card" data-id="4">
                    <div class="challenge-card-header">
                        <span class="challenge-badge tag-blue">Recovery</span>
                        <i class="fa-solid fa-moon challenge-icon"></i>
                    </div>
                    <h3>Better Sleep Challenge</h3>
                    <p>Optimize your evening routine for 7 to 8 hours of deep, restful sleep.</p>
                    <div class="challenge-meta">
                        <i class="fa-solid fa-user-group"></i> 2,150 people joined
                    </div>
                    <button class="btn-challenge-join">Join Challenge <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <!-- Mindful Eating Challenge -->
                <div class="challenge-card" data-id="5">
                    <div class="challenge-card-header">
                        <span class="challenge-badge tag-green">Mindfulness</span>
                        <i class="fa-solid fa-apple-whole challenge-icon"></i>
                    </div>
                    <h3>Mindful Eating Challenge</h3>
                    <p>Practice screen-free meals and tune in to your natural hunger cues.</p>
                    <div class="challenge-meta">
                        <i class="fa-solid fa-user-group"></i> 975 people joined
                    </div>
                    <button class="btn-challenge-join">Join Challenge <i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </section>

        <!-- success stories y community-->
        <section class="community-split-section">
            <!-- Success Stories -->
            <div class="stories-column">
                <h2>Success Stories</h2>
                <p class="subtitle">Real journeys from real community members.</p>
                
                <div class="story-card">
                    <div class="quote-mark">“</div>
                    <p class="story-quote">I stopped thinking about health as a short-term goal.</p>
                    <span class="story-author">— Hazael Bernal, Nutri member</span>
                    
                    <div class="story-metrics">
                        <div class="metric-pill"><strong>12</strong> weeks</div>
                        <div class="metric-pill"><strong>24</strong> workouts</div>
                        <div class="metric-pill"><strong>86%</strong> consistency</div>
                    </div>
                </div>

                <div class="story-card">
                    <div class="quote-mark">“</div>
                    <p class="story-quote">Creating small daily habits completely transformed my energy levels throughout the week.</p>
                    <span class="story-author">— Alessandra Ayala, Nutri member</span>
                    
                    <div class="story-metrics">
                        <div class="metric-pill"><strong>8</strong> weeks</div>
                        <div class="metric-pill"><strong>56</strong> meals shared</div>
                        <div class="metric-pill"><strong>92%</strong> consistency</div>
                    </div>
                </div>

                <p class="disclaimer">*Results reflect personal consistency and dedication. Individual experiences will vary.</p>
            </div>

            <!-- Community Feed -->
            <div class="feed-column">
                <div class="feed-header">
                    <h2>Community Feed</h2>
                    <span class="live-dot">● Live Updates</span>
                </div>
                
                <!-- Caja para interactuar / enviar comentarios -->
                <div class="feed-publish-box">
                    <input type="text" id="feedUserName" placeholder="Your name">
                    <textarea id="feedMessage" placeholder="Share your win or meal with the community..."></textarea>
                    <button id="publishBtn" class="btn-publish">Share Update!</button>
                </div>

                <div class="feed-list">
                    <div class="feed-item">
                        <div class="feed-avatar">M</div>
                        <div class="feed-content">
                            <p><strong>Maria</strong> completed the <strong>7-Day Hydration Challenge</strong></p>
                            <span class="feed-time">10m ago</span>
                        </div>
                    </div>

                    <div class="feed-item">
                        <div class="feed-avatar alt-1">J</div>
                        <div class="feed-content">
                            <p><strong>James</strong> shared a healthy breakfast</p>
                            <span class="feed-time">25m ago</span>
                        </div>
                    </div>

                    <div class="feed-item">
                        <div class="feed-avatar alt-2">S</div>
                        <div class="feed-content">
                            <p><strong>Sofia</strong> completed her weekly movement goal</p>
                            <span class="feed-time">1h ago</span>
                        </div>
                    </div>

                    <div class="feed-item">
                        <div class="feed-avatar alt-3">D</div>
                        <div class="feed-content">
                            <p><strong>David</strong> checked in for the <strong>Better Sleep Challenge</strong></p>
                            <span class="feed-time">2h ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4 & 5: WEEKLY INSPIRATION + POLLS & QUESTIONS -->
        <section class="inspiration-poll-container">
            <!-- Weekly Inspiration -->
            <div class="weekly-inspiration-card">
                <span class="tag-gold-pill">This Week's Focus</span>
                <h2>“Add one more vegetable to your day.”</h2>
                <div class="inspiration-body">
                    <h4>Why it matters:</h4>
                    <p>A simple extra daily serving of vegetables adds crucial fiber, antioxidants, and micronutrients to your system, supporting metabolic health without overwhelming routine changes.</p>
                </div>
                <a href="focuscomun.html" class="q-link link-gold">Learn More <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <!-- Polls & Questions -->
            <div class="community-poll-card">
                <h2>Polls & Questions</h2>
                <p class="poll-question">What is hardest for you to maintain?</p>
                
                <div class="poll-options">
                    <button class="poll-option-btn">Nutrition</button>
                    <button class="poll-option-btn">Exercise</button>
                    <button class="poll-option-btn">Sleep</button>
                    <button class="poll-option-btn active-option">Consistency</button>
                </div>

                <div class="poll-result-box">
                    <i class="fa-solid fa-chart-pie"></i>
                    <p><strong>62% of the Nutrition Express community</strong> chose consistency.</p>
                </div>
            </div>
        </section>

        <!-- SECTION 6: YOUR PROGRESS -->
        <section class="progress-section">
            <div class="progress-container-card">
                <div class="progress-left">
                    <h2>Your personal Journey</h2>
                    <p>Track your general progress across your lifestyle habits. Connect with tools you already use.</p>
                    <button class="btn-green-fill">View My Progress</button>
                </div>
                
                <div class="progress-right">
                    <!-- Nutrition -->
                    <div class="progress-bar-group">
                        <div class="bar-labels">
                            <span>Nutrition</span>
                            <span>80%</span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: 80%;"></div>
                        </div>
                    </div>

                    <!-- Movement -->
                    <div class="progress-bar-group">
                        <div class="bar-labels">
                            <span>Movement</span>
                            <span>60%</span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: 60%;"></div>
                        </div>
                    </div>

                    <!-- Recovery -->
                    <div class="progress-bar-group">
                        <div class="bar-labels">
                            <span>Recovery</span>
                            <span>90%</span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: 90%;"></div>
                        </div>
                    </div>

                    <!-- Consistency -->
                    <div class="progress-bar-group">
                        <div class="bar-labels">
                            <span>Consistency</span>
                            <span>70%</span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width: 70%;"></div>
                        </div>
                    </div>
                </div>
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

    <button id="accessibilityBtn" class="access-btn" title="Accessibility Options" onclick="toggleAccessPanel()">
        ♿
    </button>

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

              <!-- Botón dinámico Mute / Unmute Assistant -->
<div class="access-item" id="muteAssistantBtn" role="button" tabindex="0" onclick="toggleMuteAssistant()">
    <div class="access-icon"><i id="muteAssistantIcon" class="fa-solid fa-volume-xmark"></i></div>
    <span id="muteAssistantText">Mute Assistant</span>
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


<script src="js/artyom.window.min.js"></script>

<script src="js/script.js"></script>

<script src="js/asistente.js"></script>

<script src="js/community.js"></script>
</body>
</html>