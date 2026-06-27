// ==========================================================================
// ♿ LÓGICA DE ACCESIBILIDAD RECOLECTADA DEL LOGIN PARA EL HOME
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
    if (event) event.stopPropagation(); // Evita que el evento cierre el panel principal
    const zoomContainer = document.getElementById("zoomContainer");
    if (zoomContainer) {
        zoomContainer.classList.toggle("active");
    }
}

/**
 * Controla el escalado dinámico del tamaño de fuente general (CSS Rem base)
 */
let currentSize = 16; 
function changeFontSize(action, event) {
    if (event) event.stopPropagation(); // Previene cierres inesperados
    
    if (action === 1 && currentSize < 24) {
        currentSize += 1;
    } else if (action === -1 && currentSize > 13) {
        currentSize -= 1;
    }
    
    // Cambia la raíz del documento afectando de forma armónica a la app
    document.documentElement.style.fontSize = currentSize + 'px';
}

/**
 * Alterna el modo de alto contraste agregando una clase al body
 */
function toggleContrast() { 
    document.body.classList.toggle('high-contrast-mode'); 
}

/**
 * Alterna la fuente adaptada para personas con dislexia
 */
function toggleDyslexia() { 
    document.body.classList.toggle("dyslexia-mode"); 
}

/**
 * Amplía el espaciado entre caracteres en todo el DOM
 */
function toggleLetterSpacing() { 
    document.body.classList.toggle('extra-spacing-mode'); 
}

/**
 * Forza los anillos de enfoque visual intensivo para navegación por tabulador
 */
function toggleFocusVisible() { 
    document.body.classList.toggle('focus-visible-mode'); 
}

/**
 * Lector de texto contextual utilizando la API de síntesis de voz nativa del navegador
 */
function speakText() {
    if (!('speechSynthesis' in window)) {
        alert("Tu navegador no soporta la característica de síntesis de voz.");
        return;
    }

    // Limpia la cola de lectura actual antes de empezar de nuevo
    window.speechSynthesis.cancel(); 

    // Texto personalizado y adaptado exclusivamente para tu página de Inicio (Home)
    const homeNarrative = "Bienvenido a Nutrition Express. Tu bienestar, sin complicaciones. Ofrecemos nutrición personalizada, acceso fácil y herramientas útiles para construir una vida más saludable.";

    const utterance = new SpeechSynthesisUtterance(homeNarrative);
    utterance.lang = 'es-ES'; // Establecido en español latinoamericano/español
    window.speechSynthesis.speak(utterance);
}