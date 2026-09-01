// ==========================================================================
// 🎙️ ULTRA-FAST ACCESSIBLE ASSISTANT WITH FULL QUICK ACCESSIBILITY CONTROL
// ==========================================================================

const GEMINI_KEY = "AQ.Ab8RN6J67tH1irzTGxB8Ub9IV9kxN5w5hzGLR71X14HDIEkY_g"; 
const GEMINI_ENDPOINT = `https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=${GEMINI_KEY}`;

let recognitionAssistant = null;
let isAssistantEnabled = true;
let isProcessing = false;

// Mapeo directo de navegación local
const NAV_MAP = {
    "home": "index.php",
    "main": "index.php",
    "index": "index.php",
    "expert": "expertos1.php",
    "experts": "expertos1.php",
    "doctor": "expertos1.php",
    "doctors": "expertos1.php",
    "plan": "carpetas.php",
    "plans": "carpetas.php",
    "catalog": "carpetas.php",
    "calculator": "calculadora.php",
    "calories": "calculadora.php",
    "service": "servicios.php",
    "services": "servicios.php",
    "about": "nosotros.php",
    "about us": "nosotros.php",
    "profile": "perfil.php",
    "my account": "perfil.php",
    "account": "perfil.php",
    "appointment": "citas.php",
    "appointments": "citas.php",
    "booking": "citas.php",
    "food": "catalogo.php",
    "meals": "catalogo.php",
    "exercise": "catalogo_ejercicio.php",
    "movement": "catalogo_ejercicio.php",
    "sleep": "catalogo_descanso.php",
    "rest": "catalogo_descanso.php"
};

window.addEventListener('DOMContentLoaded', () => {
    initAlwaysOnAssistant();

    // Bienvenida contextual al ingresar
    setTimeout(() => {
        announceCurrentPage();
    }, 800);

    const btnAcceso = document.querySelector('.access-btn') || document.getElementById('accessibilityBtn');
    if (btnAcceso) {
        btnAcceso.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleAssistantState();
        });
    }
});

function announceCurrentPage() {
    const contextMeta = document.querySelector('meta[name="page-context"]');
    if (contextMeta && contextMeta.content) {
        responderVoz(contextMeta.content);
    } else {
        responderVoz(`You are currently on ${document.title || "Nutrition Express"}`);
    }
}

function initAlwaysOnAssistant() {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) return;

    recognitionAssistant = new SpeechRecognition();
    recognitionAssistant.lang = 'en-US';
    recognitionAssistant.continuous = true;
    recognitionAssistant.interimResults = false;

    recognitionAssistant.onstart = () => setMicVisualStatus(true);

    recognitionAssistant.onresult = async (event) => {
        const lastIndex = event.results.length - 1;
        const rawTranscript = event.results[lastIndex][0].transcript.trim().toLowerCase();

        if (!rawTranscript || isProcessing) return;

        console.log("🗣️ User said:", rawTranscript);
        isProcessing = true;

        // 1. Detección Local Instantánea (Comandos de Accesibilidad + Navegación + Scroll)
        const handledLocally = handleFastLocalCommands(rawTranscript);

        // 2. Si es una instrucción compleja, consulta con Gemini
        if (!handledLocally) {
            setMicVisualStatus(false, true);
            await processIntentWithAI(rawTranscript);
        }

        isProcessing = false;
        setMicVisualStatus(true);
    };

    recognitionAssistant.onerror = () => setMicVisualStatus(false);

    recognitionAssistant.onend = () => {
        if (isAssistantEnabled) {
            setTimeout(() => {
                try { recognitionAssistant.start(); } catch (e) {}
            }, 300);
        }
    };

    try { recognitionAssistant.start(); } catch (e) {}
}

// MANEJO INSTANTÁNEO LOCAL (0 ms de espera)
function handleFastLocalCommands(text) {
    // ----------------------------------------------------------------------
    // 🎛️ CONTROLES DEL MENU "QUICK ACCESSIBILITY"
    // ----------------------------------------------------------------------

    // 1. Large Text (Texto Grande)
    if (text.includes("large text") || text.includes("big text") || text.includes("increase text") || text.includes("bigger font")) {
        if (typeof toggleLargeText === "function") toggleLargeText();
        else document.body.classList.toggle('large-text');
        responderVoz("Toggling large text mode.");
        return true;
    }

    // 2. High Contrast (Alto Contraste)
    if (text.includes("high contrast") || text.includes("contrast mode") || text.includes("contrast")) {
        if (typeof toggleContrast === "function") toggleContrast();
        else document.body.classList.toggle('high-contrast');
        responderVoz("Toggling high contrast mode.");
        return true;
    }

    // 3. Dark Mode (Modo Oscuro)
    if (text.includes("dark mode") || text.includes("night mode") || text.includes("lights off") || text.includes("dark theme")) {
        if (typeof toggleDarkMode === "function") toggleDarkMode(true);
        else document.body.classList.add('dark-theme');
        responderVoz("Switching to dark mode.");
        return true;
    }

    if (text.includes("light mode") || text.includes("day mode") || text.includes("lights on") || text.includes("light theme")) {
        if (typeof toggleDarkMode === "function") toggleDarkMode(false);
        else document.body.classList.remove('dark-theme');
        responderVoz("Switching to light mode.");
        return true;
    }

    // 4. Reset All (Restablecer todo)
    if (text.includes("reset all") || text.includes("reset settings") || text.includes("reset accessibility") || text.includes("clear options")) {
        if (typeof resetAccessibility === "function") resetAccessibility();
        else {
            document.body.classList.remove('dark-theme', 'high-contrast', 'large-text', 'dyslexia-font', 'more-spacing', 'visible-focus');
        }
        responderVoz("Resetting all accessibility settings to default.");
        return true;
    }

    // 5. Read Aloud (Leer Página / Contenido)
    if (text.includes("read aloud") || text.includes("read page") || text.includes("read screen") || text.includes("speak page")) {
        if (typeof readPageAloud === "function") {
            readPageAloud();
        } else {
            const pageText = document.querySelector('main') ? document.querySelector('main').innerText : document.body.innerText;
            responderVoz(pageText.substring(0, 300) + "...");
        }
        return true;
    }

    // 6. Dyslexia Mode (Fuente para Dislexia)
    if (text.includes("dyslexia") || text.includes("dyslexic") || text.includes("dyslexia mode") || text.includes("dyslexia font")) {
        if (typeof toggleDyslexiaMode === "function") toggleDyslexiaMode();
        else document.body.classList.toggle('dyslexia-font');
        responderVoz("Toggling dyslexia friendly font.");
        return true;
    }

    // 7. More Spacing (Más Espaciado AAA)
    if (text.includes("more spacing") || text.includes("spacing") || text.includes("increase spacing") || text.includes("triple a")) {
        if (typeof toggleMoreSpacing === "function") toggleMoreSpacing();
        else document.body.classList.toggle('more-spacing');
        responderVoz("Toggling text spacing.");
        return true;
    }

    // 8. Visible Focus (Enfoque Visible)
    if (text.includes("visible focus") || text.includes("focus mode") || text.includes("highlight focus") || text.includes("outline focus")) {
        if (typeof toggleVisibleFocus === "function") toggleVisibleFocus();
        else document.body.classList.toggle('visible-focus');
        responderVoz("Toggling visible outline focus.");
        return true;
    }

    // ----------------------------------------------------------------------
    // 🧭 INFORMACIÓN, NAVEGACIÓN Y SCROLL
    // ----------------------------------------------------------------------

    // Ubicación
    if (text.includes("where am i") || text.includes("what page") || text.includes("location")) {
        announceCurrentPage();
        return true;
    }

    // Buscador de navegación
    for (const [key, targetUrl] of Object.entries(NAV_MAP)) {
        if (text.includes(key)) {
            ejecutarNavegacion(`Opening ${key}`, targetUrl);
            return true;
        }
    }

    // Scrolls
    if (text.includes("scroll down") || text.includes("go down")) {
        const factor = (text.includes("double") || text.includes("two") || text.includes("2")) ? 2 : 1;
        window.scrollBy({ top: 400 * factor, behavior: 'smooth' });
        responderVoz(factor > 1 ? "Scrolling down twice." : "Scrolling down.");
        return true;
    }

    if (text.includes("scroll up") || text.includes("go up")) {
        const factor = (text.includes("double") || text.includes("two") || text.includes("2")) ? 2 : 1;
        window.scrollBy({ top: -400 * factor, behavior: 'smooth' });
        responderVoz(factor > 1 ? "Scrolling up twice." : "Scrolling up.");
        return true;
    }

    return false;
}

// PROCESADOR CON GEMINI PARA FRASES MÁS LIBRES
async function processIntentWithAI(userText) {
    const systemPrompt = `
    You are Kizi, an energetic, helpful accessibility assistant for Nutrition Express.
    Map the user's intent to one of the available actions.

    ACCESSIBILITY ACTIONS:
    - "LARGE_TEXT": User wants larger text, bigger size.
    - "HIGH_CONTRAST": User wants contrast, sharp mode.
    - "DARK_MODE": User wants dark mode, night theme.
    - "LIGHT_MODE": User wants light mode, day theme.
    - "RESET_ALL": User wants to reset settings.
    - "READ_ALOUD": User wants page content read aloud.
    - "DYSLEXIA_MODE": User wants dyslexia friendly mode or font.
    - "MORE_SPACING": User wants extra spacing or AAA spacing.
    - "VISIBLE_FOCUS": User wants visible outline focus.

    NAVIGATION TARGET MAPPING:
    - Home -> "index.php"
    - Experts -> "expertos1.php"
    - Plans -> "carpetas.php"
    - Calculator -> "calculadora.php"
    - Services -> "servicios.php"
    - About Us -> "nosotros.php"
    - Profile -> "perfil.php"
    - Appointments -> "citas.php"
    - Food -> "catalogo.php"
    - Movement -> "catalogo_ejercicio.php"
    - Sleep -> "catalogo_descanso.php"

    RESPOND STRICTLY WITH RAW JSON:
    {
        "action": "ACTION_NAME" or "NAVIGATE" or "UNKNOWN",
        "target": "target_filename.php" or null,
        "speech_response": "Short energetic response in English stating what you are doing."
    }
    `;

    try {
        const response = await fetch(GEMINI_ENDPOINT, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                contents: [{ parts: [{ text: systemPrompt }, { text: `User speech: "${userText}"` }] }]
            })
        });

        const data = await response.json();
        const cleanJson = data.candidates[0].content.parts[0].text.replace(/```json/g, '').replace(/```/g, '').trim();
        const parsed = JSON.parse(cleanJson);

        if (parsed.speech_response) {
            responderVoz(parsed.speech_response);
        }

        switch (parsed.action) {
            case "LARGE_TEXT":
                if (typeof toggleLargeText === "function") toggleLargeText();
                else document.body.classList.toggle('large-text');
                break;
            case "HIGH_CONTRAST":
                if (typeof toggleContrast === "function") toggleContrast();
                else document.body.classList.toggle('high-contrast');
                break;
            case "DARK_MODE":
                if (typeof toggleDarkMode === "function") toggleDarkMode(true);
                else document.body.classList.add('dark-theme');
                break;
            case "LIGHT_MODE":
                if (typeof toggleDarkMode === "function") toggleDarkMode(false);
                else document.body.classList.remove('dark-theme');
                break;
            case "RESET_ALL":
                if (typeof resetAccessibility === "function") resetAccessibility();
                break;
            case "READ_ALOUD":
                if (typeof readPageAloud === "function") readPageAloud();
                break;
            case "DYSLEXIA_MODE":
                if (typeof toggleDyslexiaMode === "function") toggleDyslexiaMode();
                else document.body.classList.toggle('dyslexia-font');
                break;
            case "MORE_SPACING":
                if (typeof toggleMoreSpacing === "function") toggleMoreSpacing();
                else document.body.classList.toggle('more-spacing');
                break;
            case "VISIBLE_FOCUS":
                if (typeof toggleVisibleFocus === "function") toggleVisibleFocus();
                else document.body.classList.toggle('visible-focus');
                break;
            case "NAVIGATE":
                if (parsed.target) {
                    setTimeout(() => { window.location.href = parsed.target; }, 1000);
                }
                break;
        }
    } catch (err) {
        console.error("AI Error:", err);
        responderVoz("I didn't capture that clearly. Try asking to enable dark mode, large text, or go to profile.");
    }
}

// AUXILIARES
function ejecutarNavegacion(mensajeVoz, urlDestino) {
    responderVoz(mensajeVoz);
    setTimeout(() => {
        window.location.href = urlDestino;
    }, 1000);
}

function responderVoz(mensaje) {
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(mensaje);
        utterance.lang = 'en-US';
        utterance.rate = 1.05;
        utterance.pitch = 1.1;
        window.speechSynthesis.speak(utterance);
    }
}

function toggleAssistantState() {
    isAssistantEnabled = !isAssistantEnabled;
    if (isAssistantEnabled) {
        try { recognitionAssistant.start(); } catch (e) {}
        responderVoz("Assistant enabled.");
    } else {
        if (recognitionAssistant) recognitionAssistant.stop();
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        setMicVisualStatus(false);
    }
}

function setMicVisualStatus(isActive, isProcessing = false) {
    const btnAcceso = document.querySelector('.access-btn') || document.getElementById('accessibilityBtn');
    if (!btnAcceso) return;

    if (isProcessing) {
        btnAcceso.style.boxShadow = "0 0 0 5px #f39c12, 0 0 15px #f39c12";
    } else if (isActive) {
        btnAcceso.style.boxShadow = "0 0 0 5px #2ecc71, 0 0 15px #2ecc71";
    } else {
        btnAcceso.style.boxShadow = "";
    }
}