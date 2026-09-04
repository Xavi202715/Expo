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
    document.body.classList.toggle("dark-mode");
    const isDark = document.body.classList.contains("dark-mode");
    localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
    return isDark ? "Dark mode enabled" : "Dark mode disabled";
}

// Función auxiliar para cambiar el texto y el icono dinámicamente
function updateMuteButtonUI(isMuted) {
    const textElem = document.getElementById("muteAssistantText");
    const iconElem = document.getElementById("muteAssistantIcon");

    if (textElem) {
        textElem.innerText = isMuted ? "Unmute Assistant" : "Mute Assistant";
    }

    if (iconElem) {
        if (isMuted) {
            iconElem.className = "fa-solid fa-volume-high";
        } else {
            iconElem.className = "fa-solid fa-volume-xmark";
        }
    }
}

// Mute Assistant: Alterna estado y actualiza UI
function toggleMuteAssistant() {
    const currentMute = localStorage.getItem('assistantMuted') === 'enabled';
    const newMuteState = !currentMute;
    
    localStorage.setItem('assistantMuted', newMuteState ? 'enabled' : 'disabled');
    updateMuteButtonUI(newMuteState);

    if (newMuteState) {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
        }
        return "Voice assistant muted";
    } else {
        return "Voice assistant enabled";
    }
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
        'dyslexia-mode',
        'extra-spacing-mode',
        'focus-visible-mode'
    );

    localStorage.removeItem('fontSize');
    localStorage.removeItem('darkMode');
    localStorage.removeItem('dyslexia');
    localStorage.removeItem('letterSpacing');
    localStorage.removeItem('focusVisible');
    localStorage.removeItem('assistantMuted');

    updateMuteButtonUI(false);

    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }
    return "Accessibility options reset";
}

// --------------------------------------------------------------------------
// CONTROLES HANDS-FREE Y UTILIDADES
// --------------------------------------------------------------------------

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

let lastSelectedText = "";

document.addEventListener("selectionchange", () => {
    const selection = window.getSelection().toString().trim();
    if (selection.length > 0) {
        lastSelectedText = selection;
    }
});

function readSelectedText(currentLang = 'en-US') {
    const currentSelection = window.getSelection().toString().trim();
    const textToRead = currentSelection || lastSelectedText;

    if (textToRead.length > 0) {
        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(textToRead);
            utterance.lang = currentLang;
            window.speechSynthesis.speak(utterance);
        }
        return true;
    } else {
        alert("Please select/highlight some text first!");
        return false;
    }
}

function getPageSummary() {
    const mainTitle = document.querySelector('h1') ? document.querySelector('h1').innerText : document.title;
    return "You are on " + mainTitle;
}

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

    if (localStorage.getItem('dyslexia') === 'enabled') {
        document.body.classList.add('dyslexia-mode');
    }

    if (localStorage.getItem('letterSpacing') === 'enabled') {
        document.body.classList.add('extra-spacing-mode');
    }

    if (localStorage.getItem('focusVisible') === 'enabled') {
        document.body.classList.add('focus-visible-mode');
    }

    const isMuted = localStorage.getItem('assistantMuted') === 'enabled';
    updateMuteButtonUI(isMuted);
})();