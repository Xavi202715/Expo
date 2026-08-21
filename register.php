<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Express - Sign Up</title>

    <link rel="stylesheet" href="css/headfooter_boton.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.cdnfonts.com/css/opendyslexic" rel="stylesheet">


    <style>
        /* Dark Mode Rules */
body.dark-mode {
    background-color: #121212 !important;
    color: #e0e0e0 !important;
}

body.dark-mode .auth-left {
    background: linear-gradient(135deg, #1e1e1e 0%, #2a2a2a 100%) !important;
}

body.dark-mode .auth-right,
body.dark-mode .access-panel,
body.dark-mode .access-item {
    background-color: #1e1e1e !important;
    color: #ffffff !important;
    border-color: #333333 !important;
}

body.dark-mode .input-box {
    background-color: #2a2a2a !important;
    border-color: #444444 !important;
}

body.dark-mode input {
    color: #ffffff !important;
}

body.dark-mode h1,
body.dark-mode h2,
body.dark-mode .access-item span {
    color: #ffffff !important;
}

body.dark-mode .btn-social {
    background-color: #2a2a2a !important;
    color: #ffffff !important;
    border-color: #444444 !important;
}
 
        :root {
            --primary-green: #4b7f4b;
            --primary-green-hover: #3b663b;
            --accent-terracotta: #b56d3b;
            --accent-terracotta-hover: #96562c;
            --bg-light: #f9f5ef;
            --text-dark: #2c2a29;
            --text-muted: #666666;
            --border-color: #e0dcd5;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
            color: var(--text-dark);
        }

        .auth-container {
            display: flex;
            min-height: 100vh;
        }

        /* Branding Section */
        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, #f9f5ef 0%, #f0e7d8 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .auth-left .logo {
            width: 130px;
            height: auto;
            margin-bottom: 15px;
        }

        .auth-left h1 {
            font-size: 2.8rem;
            margin: 0;
            color: var(--text-dark);
        }

        .auth-left h1 span {
            color: var(--primary-green);
        }

        .auth-left .decoration {
            font-size: 1.2rem;
            color: var(--accent-terracotta);
            margin-top: 10px;
            font-weight: 600;
        }

        /* Form Section */
        .auth-right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px 80px;
            background-color: #ffffff;
        }

        .auth-right h2 {
            font-size: 2rem;
            margin-bottom: 25px;
            color: var(--text-dark);
        }

        .input-box {
            display: flex;
            align-items: center;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 18px;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        .input-box:focus-within {
            border-color: var(--accent-terracotta);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(181, 109, 59, 0.15);
        }

        .input-box i {
            color: var(--accent-terracotta);
            font-size: 1.1rem;
            width: 25px;
            text-align: center;
        }

        .input-box input {
            border: none;
            outline: none;
            flex: 1;
            padding-left: 10px;
            font-size: 0.95rem;
            background: transparent;
            color: var(--text-dark);
        }

        .input-box .toggle-password {
            cursor: pointer;
            color: var(--text-muted);
            transition: color 0.2s;
        }

        .input-box .toggle-password:hover {
            color: var(--accent-terracotta);
        }

        .btn-submit {
            width: 100%;
            background: var(--accent-terracotta);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.1s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: var(--accent-terracotta-hover);
        }

        .btn-submit:active {
            transform: scale(0.99);
        }

        /* Separator */
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .separator span {
            padding: 0 12px;
        }

        /* Social Buttons */
        .social-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-social {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #ffffff;
            color: var(--text-dark);
            border: 1px solid var(--border-color);
            padding: 12px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-social:hover {
            background-color: #f5f5f5;
            border-color: #cccccc;
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .register-link a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: var(--primary-green-hover);
            text-decoration: underline;
        }

        /* Accessibility Styles */
        .access-btn {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 55px;
            height: 55px;
            border: none;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            background: var(--primary-green);
            color: white;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s, background 0.2s;
        }

        .access-btn:hover {
            transform: scale(1.08);
            background: var(--primary-green-hover);
        }

        .access-panel {
            position: fixed;
            right: 20px;
            bottom: 85px;
            width: 310px;
            background: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: none;
            z-index: 999;
            border: 1px solid var(--border-color);
        }

        .access-panel.active {
            display: flex;
            flex-direction: column;
        }

        .access-panel h3 {
            margin: 0 0 15px 0;
            font-size: 1.1rem;
            text-align: center;
            color: var(--text-dark);
        }

        .accessibility-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .access-item {
            background: #fcfbfa;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            min-height: 85px;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            transition: background 0.2s;
        }

        .access-item:hover {
            background: #f5f1ea;
        }

        .access-item span {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .access-icon {
            font-size: 1.3rem;
            color: var(--accent-terracotta);
        }

        .text-icon {
            font-size: 1.4rem;
            font-weight: 800;
        }

        .letter-space {
            letter-spacing: 2px;
            font-weight: bold;
        }

        .zoom-buttons {
            display: none;
            gap: 6px;
        }

        .zoom-buttons.active {
            display: flex;
        }

        .zoom-buttons button {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1px solid var(--accent-terracotta);
            background: white;
            color: var(--accent-terracotta);
            font-weight: bold;
            cursor: pointer;
        }

        .panel-footer {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-align: center;
            margin-top: 15px;
        }

        /* Accessibility Modes */
        body.high-contrast-mode {
            background-color: #000000 !important;
            color: #ffffff !important;
        }

        body.high-contrast-mode .auth-left,
        body.high-contrast-mode .auth-right,
        body.high-contrast-mode .access-panel,
        body.high-contrast-mode .access-item {
            background-color: #111111 !important;
            color: #ffffff !important;
            border-color: #ffffff !important;
        }

        body.high-contrast-mode input {
            background: #000000 !important;
            color: #ffffff !important;
        }

        body.high-contrast-mode h1,
        body.high-contrast-mode h1 span,
        body.high-contrast-mode h2,
        body.high-contrast-mode .access-item span,
        body.high-contrast-mode .access-icon,
        body.high-contrast-mode .decoration {
            color: #ffffff !important;
        }

        body.dyslexia-mode,
        body.dyslexia-mode * {
            font-family: 'OpenDyslexic', sans-serif !important;
        }

        body.extra-spacing-mode * {
            letter-spacing: 2px !important;
            line-height: 1.8 !important;
        }

        body.focus-visible-mode *:focus {
            outline: 4px dashed var(--primary-green) !important;
            outline-offset: 3px !important;
        }

        /* Responsive Layout */
        @media (max-width: 850px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-left {
                padding: 40px 20px;
            }

            .auth-right {
                padding: 40px 25px;
            }
        }
    </style>
</head>
<body>

    <div class="auth-container">

        <!-- Left Column: Branding -->
        <div class="auth-left">
            <img src="img/logo.png" class="logo" alt="Nutrition Express Logo">
            <h1>Nutrition<span>Express</span></h1>
            <p class="decoration">
                <strong>Eat well, live better</strong>
            </p>
        </div>

        <!-- Right Column: Registration Form -->
        <div class="auth-right">
            <h2>Create Account</h2>

            <form id="RegisterForm" action="process_register.php" method="POST">
                <div class="input-box">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="nombre" id="nombre" placeholder="Full Name" required>
                </div>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" id="email" placeholder="Email Address" required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fa-regular fa-eye toggle-password" id="togglePassword"></i>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="confirm_password" id="confirm-password" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn-submit">Sign Up</button>
            </form>

            <div class="separator">
                <span>or continue with</span>
            </div>

            <div class="social-buttons">
                <button type="button" class="btn-social">
                    <i class="fa-brands fa-google" style="color: #ea4335;"></i>
                    Google
                </button>
                <button type="button" class="btn-social">
                    <i class="fa-brands fa-microsoft" style="color: #00a4ef;"></i>
                    Microsoft
                </button>
            </div>

            <p class="register-link">
                Already have an account? 
                <a href="login.php">Sign In</a>
            </p>
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
    
    <script src="js/register.js"></script>
    <script src="js/script.js"></script>
    <script src="js/asistente.js"></script>
</body>
</html>