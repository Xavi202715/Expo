// ==========================================================================
// ♿ LÓGICA DE ACCESIBILIDAD CON PERSISTENCIA (LOCALSTORAGE)
// ==========================================================================

/**
 * Muestra u oculta la ventana emergente de accesibilidad
 */
function toggleAccessPanel() {
    const accessPanel = document.getElementById("accessibilityPanel");
    if (accessPanel) {
        accessPanel.classList.toggle("active");
    }
}

/**
 * Intercambia el icono estático "A" por los botones dinámicos "+" y "-"
 */
function toggleZoomButtons(event) {
    if (event) event.stopPropagation();
    const zoomContainer = document.getElementById("zoomContainer");
    if (zoomContainer) {
        zoomContainer.classList.toggle("active");
    }
}

/**
 * Controla el escalado dinámico del tamaño de fuente general (CSS Rem base)
 */
let currentSize = parseInt(localStorage.getItem('fontSize')) || 16; 

function changeFontSize(action, event) {
    if (event) event.stopPropagation();
    
    if (action === 1 && currentSize < 24) {
        currentSize += 1;
    } else if (action === -1 && currentSize > 13) {
        currentSize -= 1;
    }
    
    document.documentElement.style.fontSize = currentSize + 'px';
    localStorage.setItem('fontSize', currentSize); // Guardar preferencia
}

/**
 * Alterna el Modo Oscuro
 */
function toggleDarkMode() {
    document.body.classList.toggle("dark-mode");
    const isDark = document.body.classList.contains("dark-mode");
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled'); // Guardar
}

/**
 * Alterna Modo Alto Contraste
 */
function toggleContrast() { 
    document.body.classList.toggle('high-contrast-mode'); 
    const isContrast = document.body.classList.contains('high-contrast-mode');
    localStorage.setItem('highContrast', isContrast ? 'enabled' : 'disabled');
}

/**
 * Alterna Modo Dislexia
 */
function toggleDyslexia() { 
    document.body.classList.toggle("dyslexia-mode"); 
    const isDyslexia = document.body.classList.contains("dyslexia-mode");
    localStorage.setItem('dyslexia', isDyslexia ? 'enabled' : 'disabled');
}

/**
 * Alterna Espaciado de Letras
 */
function toggleLetterSpacing() { 
    document.body.classList.toggle('extra-spacing-mode'); 
    const isSpacing = document.body.classList.contains('extra-spacing-mode');
    localStorage.setItem('letterSpacing', isSpacing ? 'enabled' : 'disabled');
}

/**
 * Alterna Enfoque Visible
 */
function toggleFocusVisible() { 
    document.body.classList.toggle('focus-visible-mode'); 
    const isFocus = document.body.classList.contains('focus-visible-mode');
    localStorage.setItem('focusVisible', isFocus ? 'enabled' : 'disabled');
}

/**
 * Restablece todas las opciones de accesibilidad a su estado normal/por defecto
 */
function resetAccessibility() {
    // 1. Restablecer tamaño de fuente a 16px
    currentSize = 16;
    document.documentElement.style.fontSize = '16px';

    // 2. Remover todas las clases del body
    document.body.classList.remove(
        'dark-mode',
        'high-contrast-mode',
        'dyslexia-mode',
        'extra-spacing-mode',
        'focus-visible-mode'
    );

    // 3. Limpiar memoria local
    localStorage.removeItem('fontSize');
    localStorage.removeItem('darkMode');
    localStorage.removeItem('highContrast');
    localStorage.removeItem('dyslexia');
    localStorage.removeItem('letterSpacing');
    localStorage.removeItem('focusVisible');

    // 4. Detener lectura de voz si está activa
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }
}

/**
 * Lector de texto contextual
 */
function speakText() {
    if (!('speechSynthesis' in window)) {
        alert("Tu navegador no soporta la característica de síntesis de voz.");
        return;
    }

    window.speechSynthesis.cancel(); 

    const homeNarrative = "Bienvenido a Nutrition Express. Tu bienestar, sin complicaciones. Ofrecemos nutrición personalizada, acceso fácil y herramientas útiles para construir una vida más saludable.";

    const utterance = new SpeechSynthesisUtterance(homeNarrative);
    utterance.lang = 'es-ES';
    window.speechSynthesis.speak(utterance);
}

// ==========================================================================
// 🔄 CARGA AUTOMÁTICA DE PREFERENCIAS AL CAMBIAR DE PÁGINA
// ==========================================================================
(function loadAccessibilitySettings() {
    // 1. Cargar tamaño de fuente
    const savedSize = localStorage.getItem('fontSize');
    if (savedSize) {
        currentSize = parseInt(savedSize);
        document.documentElement.style.fontSize = savedSize + 'px';
    }

    // 2. Cargar Modo Oscuro
    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }

    // 3. Cargar Alto Contraste
    if (localStorage.getItem('highContrast') === 'enabled') {
        document.body.classList.add('high-contrast-mode');
    }

    // 4. Cargar Modo Dislexia
    if (localStorage.getItem('dyslexia') === 'enabled') {
        document.body.classList.add('dyslexia-mode');
    }

    // 5. Cargar Espaciado
    if (localStorage.getItem('letterSpacing') === 'enabled') {
        document.body.classList.add('extra-spacing-mode');
    }

    // 6. Cargar Enfoque Visible
    if (localStorage.getItem('focusVisible') === 'enabled') {
        document.body.classList.add('focus-visible-mode');
    }
})();