const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");

if (togglePassword && password) {
    togglePassword.addEventListener("click", () => {
        if (password.type === "password") {
            password.type = "text";
            togglePassword.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            password.type = "password";
            togglePassword.classList.replace("fa-eye-slash", "fa-eye");
        }
    });
}

// MANEJO DEL LOGIN CON REDIRECCIÓN A PHP
const loginForm = document.getElementById("loginForm");

if (loginForm) {
    loginForm.addEventListener("submit", function(e) {
        e.preventDefault(); // Evita el envío tradicional por un segundo para validar

        const emailVal = document.getElementById("email").value;
        const passwordVal = document.getElementById("password").value;

        if (passwordVal.length < 6) {
            alert("La contraseña debe tener al menos 6 caracteres");
            return;
        }

        // Enviar el formulario directamente a process_login.php
        this.submit();
    });
}

// ==========================================================================
// 🛠️ CONTROLADORES DEL PANEL DE ACCESIBILIDAD REUTILIZADOS
// ==========================================================================

const accessPanel = document.getElementById("accessibilityPanel");

// Abre y cierra el menú lateral / flotante
function toggleAccessPanel() {
    if (accessPanel) {
        accessPanel.classList.toggle("active");
    }
}

// Muestra los botones + y - ocultando la letra "A"
function toggleZoomButtons(event) {
    const zoomContainer = document.getElementById('zoomContainer');
    const iconA = document.querySelector('.text-icon');
    
    if (zoomContainer) {
        zoomContainer.classList.toggle('active');
        if (iconA) {
            iconA.style.display = zoomContainer.classList.contains('active') ? 'none' : 'flex';
        }
    }
}

// Cambia el tamaño de fuente de todo el documento de forma proporcional
let currentSize = 16; 
function changeFontSize(action, event) {
    if (event) event.stopPropagation(); // Evita que se cierre el panel por propagación de click
    if (action === 1 && currentSize < 24) {
        currentSize += 1;
    } else if (action === -1 && currentSize > 13) {
        currentSize -= 1;
    }
    document.documentElement.style.fontSize = currentSize + 'px';
}

// Modo Alto Contraste
function toggleContrast() { 
    document.body.classList.toggle('high-contrast-mode'); 
}

// Modo Dislexia
function toggleDyslexia() {
    document.body.classList.toggle("dyslexia-mode");
}

// Más Espaciado de Texto
function toggleLetterSpacing() { 
    document.body.classList.toggle('extra-spacing-mode'); 
}

// Enfoque Altamente Visible
function toggleFocusVisible() { 
    document.body.classList.toggle('focus-visible-mode'); 
}

// Lector de pantalla (Texto a Voz) nativo optimizado para Login
function speakText() {
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel(); // Detiene cualquier lectura previa activa
        const welcomeText = "Bienvenido a Nutrition Express. Iniciar sesión. Introduce tu correo electrónico y tu contraseña para continuar.";
        const utterance = new SpeechSynthesisUtterance(welcomeText);
        utterance.lang = 'es-ES';
        window.speechSynthesis.speak(utterance);
    }
}