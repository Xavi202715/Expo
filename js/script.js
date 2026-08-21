// ==========================================================================
// ♿ LÓGICA DE ACCESIBILIDAD CON PERSISTENCIA Y RESOLUCIÓN DE CONFLICTOS
// ==========================================================================

function toggleAccessPanel() {
    const accessPanel = document.getElementById("accessibilityPanel");
    if (accessPanel) {
        accessPanel.classList.toggle("active");
    }
}

function toggleZoomButtons(event) {
    if (event) event.stopPropagation();
    const zoomContainer = document.getElementById("zoomContainer");
    if (zoomContainer) {
        zoomContainer.classList.toggle("active");
    }
}

let currentSize = parseInt(localStorage.getItem('fontSize')) || 16; 

function changeFontSize(action, event) {
    if (event) event.stopPropagation();
    
    if (action === 1 && currentSize < 24) {
        currentSize += 1;
    } else if (action === -1 && currentSize > 13) {
        currentSize -= 1;
    }
    
    document.documentElement.style.fontSize = currentSize + 'px';
    localStorage.setItem('fontSize', currentSize);
}

/**
 * Alterna Modo Oscuro (Remueve Alto Contraste para evitar conflictos)
 */
function toggleDarkMode() {
    if (document.body.classList.contains("high-contrast-mode")) {
        document.body.classList.remove("high-contrast-mode");
        localStorage.setItem('highContrast', 'disabled');
    }
    
    document.body.classList.toggle("dark-mode");
    const isDark = document.body.classList.contains("dark-mode");
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
}

/**
 * Alterna Alto Contraste (Remueve Modo Oscuro para evitar conflictos)
 */
function toggleContrast() { 
    if (document.body.classList.contains("dark-mode")) {
        document.body.classList.remove("dark-mode");
        localStorage.setItem('darkMode', 'disabled');
    }

    document.body.classList.toggle('high-contrast-mode'); 
    const isContrast = document.body.classList.contains('high-contrast-mode');
    localStorage.setItem('highContrast', isContrast ? 'enabled' : 'disabled');
}

function toggleDyslexia() { 
    document.body.classList.toggle("dyslexia-mode"); 
    const isDyslexia = document.body.classList.contains("dyslexia-mode");
    localStorage.setItem('dyslexia', isDyslexia ? 'enabled' : 'disabled');
}

function toggleLetterSpacing() { 
    document.body.classList.toggle('extra-spacing-mode'); 
    const isSpacing = document.body.classList.contains('extra-spacing-mode');
    localStorage.setItem('letterSpacing', isSpacing ? 'enabled' : 'disabled');
}

function toggleFocusVisible() { 
    document.body.classList.toggle('focus-visible-mode'); 
    const isFocus = document.body.classList.contains('focus-visible-mode');
    localStorage.setItem('focusVisible', isFocus ? 'enabled' : 'disabled');
}

/**
 * Restablece completamente el entorno visual e interfaz
 */
function resetAccessibility() {
    // 1. Restablecer tamaño de fuente
    currentSize = 16;
    document.documentElement.style.fontSize = '16px';

    // 2. Ocultar sub-menús activos
    const zoomContainer = document.getElementById("zoomContainer");
    if (zoomContainer) {
        zoomContainer.classList.remove("active");
    }

    // 3. Remover clases globales
    document.body.classList.remove(
        'dark-mode',
        'high-contrast-mode',
        'dyslexia-mode',
        'extra-spacing-mode',
        'focus-visible-mode'
    );

    // 4. Vaciar persistencia de almacenamiento
    localStorage.removeItem('fontSize');
    localStorage.removeItem('darkMode');
    localStorage.removeItem('highContrast');
    localStorage.removeItem('dyslexia');
    localStorage.removeItem('letterSpacing');
    localStorage.removeItem('focusVisible');

    // 5. Detener síntesis de voz activa
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }
}

function speakText() {
    if (!('speechSynthesis' in window)) {
        alert("Tu navegador no soporta síntesis de voz.");
        return;
    }

    window.speechSynthesis.cancel(); 
    const narrative = "Welcome to Nutrition Express. Eat well, live better.";
    const utterance = new SpeechSynthesisUtterance(narrative);
    utterance.lang = 'en-US';
    window.speechSynthesis.speak(utterance);
}

// Carga de configuración guardada al iniciar
(function loadAccessibilitySettings() {
    const savedSize = localStorage.getItem('fontSize');
    if (savedSize) {
        currentSize = parseInt(savedSize);
        document.documentElement.style.fontSize = savedSize + 'px';
    }

    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
    }

    if (localStorage.getItem('highContrast') === 'enabled') {
        document.body.classList.add('high-contrast-mode');
    }

    if (localStorage.getItem('dyslexia') === 'enabled') {
        document.body.classList.add('dyslexia-mode');
    }

    if (localStorage.getItem('letterSpacing') === 'enabled') {
        document.body.classList.add('extra-spacing-mode');
    }

    if (localStorage.getItem('focusVisible') === 'enabled') {
        document.body.classList.add('focus-visible-mode');
    }
})();