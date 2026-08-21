
const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");

togglePassword.addEventListener("click", () => {
  if (password.type === "password") {
    password.type = "text";
    togglePassword.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    password.type = "password";
    togglePassword.classList.replace("fa-eye-slash", "fa-eye");
  }
});



const accessPanel = document.getElementById("accessibilityPanel");

// Abre y cierra el menú lateral / flotante
function toggleAccessPanel() {
    accessPanel.classList.toggle("active");
}

// Muestra los botones + y - ocultando la letra "A"
function toggleZoomButtons(event) {
    const zoomContainer = document.getElementById('zoomContainer');
    const iconA = document.querySelector('.text-icon');
    
    zoomContainer.classList.toggle('active');
    
    if (zoomContainer.classList.contains('active')) {
        iconA.style.display = 'none';
    } else {
        iconA.style.display = 'flex';
    }
}

// Cambia el tamaño de fuente de todo el documento de forma proporcional
let currentSize = 16; 
function changeFontSize(action, event) {
    event.stopPropagation(); // Evita que se cierre el panel por propagación de click
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
    window.speechSynthesis.cancel(); // Detiene cualquier lectura previa activa
    const welcomeText = "Bienvenido a Nutrition Express. Registrarse. Introduce tu correo electrónico, tu nombre y tu contraseña para continuar.";
    const utterance = new SpeechSynthesisUtterance(welcomeText);
    utterance.lang = 'es-ES';
    window.speechSynthesis.speak(utterance);
}