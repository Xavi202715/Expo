<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - NutritionExpress</title>

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">
</head>
<body>

    <!-- MAIN CONTAINER -->
    <main class="auth-wrapper">
        <div class="auth-container">

            <!-- LEFT SECTION (HERO / DECORATIVE) -->
            <div class="auth-left">
                <div class="auth-left-content">
                    <img src="img/logo.png" alt="Nutrition Express Logo" class="logo">
                    <h1>Nutrition<span>Express</span></h1>
                    <p class="tagline">Your well-being, our commitment.</p>
                    <div class="decoration-badge">
                        <i class="fa-solid fa-leaf"></i>
                        <span>Eat well, live better</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT SECTION (FORM) -->
            <div class="auth-right">
                <div class="form-header">
                    <h2>Welcome back! 👋</h2>
                    <p>Enter your details to access your account.</p>
                </div>

                <!-- FORMULARIO CORREGIDO CON ACTION, METHOD Y NAMES -->
                <form id="loginForm" action="process_login.php" method="POST">
                    <div class="input-group-custom">
                        <label for="email">Email Address</label>
                        <div class="input-box">
                            <i class="fa-regular fa-envelope input-icon"></i>
                            <input type="email" id="email" name="email" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="input-group-custom">
                        <label for="password">Password</label>
                        <div class="input-box">
                            <i class="fa-solid fa-lock input-icon"></i>
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <i class="fa-regular fa-eye toggle-password" id="togglePassword"></i>
                        </div>
                    </div>

                    <div class="options">
                        <label class="remember-me">
                            <input type="checkbox" id="rememberMe" name="rememberMe">
                            <span class="checkmark"></span>
                            Remember me
                        </label>
                        <a href="forgot-password.html" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Sign In</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="separator">
                    <span>or continue with</span>
                </div>

                <div class="social-buttons">
                    <button type="button" class="btn-social google">
                        <i class="fa-brands fa-google"></i>
                        <span>Google</span>
                    </button>
                    <button type="button" class="btn-social microsoft">
                        <i class="fa-brands fa-microsoft"></i>
                        <span>Microsoft</span>
                    </button>
                </div>

                <p class="register-link">
                    Don't have an account yet? <a href="register.php">Create account</a>
                </p>
            </div>

        </div>
    </main>

    <!-- FLOATING ACCESSIBILITY BUTTON & PANEL -->
    <button id="accessibilityBtn" class="access-btn" title="Accessibility Options" onclick="toggleAccessPanel()">
        ♿
    </button>

    <div id="accessibilityPanel" class="access-panel">
        <h3>Quick Accessibility</h3>

        <div class="accessibility-grid">
            <div class="access-item" id="textAccessItem" onclick="toggleZoomButtons(event)">
                <div class="access-icon text-icon">A</div>
                <div class="zoom-buttons" id="zoomContainer">
                    <button type="button" onclick="changeFontSize(1, event)" title="Increase text size">+</button>
                    <button type="button" onclick="changeFontSize(-1, event)" title="Decrease text size">-</button>
                </div>
                <span>Large Text</span>
            </div>

            <button type="button" class="access-item" onclick="toggleDarkMode()">
                <div class="access-icon"><i class="fa-solid fa-moon"></i></div>
                <span>Dark Mode</span>
            </button>

            <button type="button" class="access-item" onclick="toggleContrast()">
                <div class="access-icon"><i class="fa-solid fa-circle-half-stroke"></i></div>
                <span>High Contrast</span>
            </button>

            <button type="button" class="access-item" onclick="speakText()">
                <div class="access-icon"><i class="fa-solid fa-volume-high"></i></div>
                <span>Read Aloud</span>
            </button>

            <button type="button" class="access-item" onclick="toggleDyslexia()">
                <div class="access-icon"><i class="fa-solid fa-book-open"></i></div>
                <span>Dyslexia Mode</span>
            </button>

            <button type="button" class="access-item" onclick="toggleLetterSpacing()">
                <div class="access-icon letter-space">AAA</div>
                <span>More Spacing</span>
            </button>

            <button type="button" class="access-item" onclick="toggleFocusVisible()">
                <div class="access-icon"><i class="fa-solid fa-expand"></i></div>
                <span>Visible Focus</span>
            </button>

            <button type="button" class="access-item reset-item" onclick="resetAccessibility()">
                <div class="access-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <span>Reset</span>
            </button>
        </div>
        <p class="panel-footer">You can change these options at any time.</p>
    </div>

    <script src="js/login.js"></script>
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>
</body>
</html>