// ==========================================================================
// ♿ ADVANCED ACCESSIBILITY & UTILITIES - NUTRITION EXPRESS
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
    return action === 1 ? "Increasing text size" : "Decreasing text size";
}

function toggleDarkMode() {
    if (document.body.classList.contains("high-contrast-mode")) {
        document.body.classList.remove("high-contrast-mode");
        localStorage.setItem('highContrast', 'disabled');
    }
    
    document.body.classList.toggle("dark-mode");
    const isDark = document.body.classList.contains("dark-mode");
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
    return isDark ? "Dark mode enabled" : "Dark mode disabled";
}

function toggleContrast() { 
    if (document.body.classList.contains("dark-mode")) {
        document.body.classList.remove("dark-mode");
        localStorage.setItem('darkMode', 'disabled');
    }

    document.body.classList.toggle('high-contrast-mode'); 
    const isContrast = document.body.classList.contains('high-contrast-mode');
    localStorage.setItem('highContrast', isContrast ? 'enabled' : 'disabled');
    return isContrast ? "High contrast enabled" : "High contrast disabled";
}

function toggleDyslexia() { 
    document.body.classList.toggle("dyslexia-mode"); 
    const isDyslexia = document.body.classList.contains("dyslexia-mode");
    localStorage.setItem('dyslexia', isDyslexia ? 'enabled' : 'disabled');
    return isDyslexia ? "Dyslexia font enabled" : "Dyslexia font disabled";
}

function toggleLetterSpacing() { 
    document.body.classList.toggle('extra-spacing-mode'); 
    const isSpacing = document.body.classList.contains('extra-spacing-mode');
    localStorage.setItem('letterSpacing', isSpacing ? 'enabled' : 'disabled');
    return isSpacing ? "Increased letter spacing" : "Normal letter spacing";
}

function toggleFocusVisible() { 
    document.body.classList.toggle('focus-visible-mode'); 
    const isFocus = document.body.classList.contains('focus-visible-mode');
    localStorage.setItem('focusVisible', isFocus ? 'enabled' : 'disabled');
    return isFocus ? "Visible focus enabled" : "Visible focus disabled";
}

function resetAccessibility() {
    currentSize = 16;
    document.documentElement.style.fontSize = '16px';

    const zoomContainer = document.getElementById("zoomContainer");
    if (zoomContainer) {
        zoomContainer.classList.remove("active");
    }

    document.body.classList.remove(
        'dark-mode',
        'high-contrast-mode',
        'dyslexia-mode',
        'extra-spacing-mode',
        'focus-visible-mode'
    );

    localStorage.removeItem('fontSize');
    localStorage.removeItem('darkMode');
    localStorage.removeItem('highContrast');
    localStorage.removeItem('dyslexia');
    localStorage.removeItem('letterSpacing');
    localStorage.removeItem('focusVisible');

    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }
    return "Accessibility options reset";
}

// --- NUEVAS FUNCIONES DE ACCESIBILIDAD 100% HANDS-FREE ---

// 1. Control de Desplazamiento (Scroll por Voz)
function scrollPage(direction) {
    if (direction === 'down') {
        window.scrollBy({ top: 400, behavior: 'smooth' });
        return "Scrolling down";
    } else if (direction === 'up') {
        window.scrollBy({ top: -400, behavior: 'smooth' });
        return "Scrolling up";
    } else if (direction === 'top') {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return "Scrolling to top";
    } else if (direction === 'bottom') {
        window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        return "Scrolling to bottom";
    }
}

// 2. Lectura de Texto Seleccionado con el Mouse
function readSelectedText(currentLang = 'en-US') {
    const selectedText = window.getSelection().toString().trim();
    if (selectedText.length > 0) {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(selectedText);
        utterance.lang = currentLang;
        window.speechSynthesis.speak(utterance);
        return true;
    }
    return false;
}

// 3. Resumen y Lectura del Título Principal
function getPageSummary() {
    const mainTitle = document.querySelector('h1') ? document.querySelector('h1').innerText : document.title;
    return "You are on " + mainTitle;
}

// 4. Retroalimentación Auditiva (Audio Cue)
function playBeepSound() {
    try {
        const audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        const osc = audioCtx.createOscillator();
        const gain = audioCtx.createGain();
        osc.connect(gain);
        gain.connect(audioCtx.destination);
        osc.type = "sine";
        osc.frequency.value = 600;
        gain.gain.setValueAtTime(0.1, audioCtx.currentTime);
        osc.start();
        osc.stop(audioCtx.currentTime + 0.15);
    } catch (e) {
        console.log("Audio feedback not supported.");
    }
}

// 5. Cierre suave del widget flotante de Plan Favorito
function closeFloatingWidget() {
    const widget = document.getElementById('floatingPlanWidget');
    if (widget) {
        widget.style.opacity = '0';
        widget.style.transition = 'opacity 0.3s ease';
        setTimeout(() => {
            widget.style.display = 'none';
        }, 300);
    }
}

// Restore settings on load
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