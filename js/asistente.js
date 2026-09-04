// ==========================================================================
// 🎙️ ULTRA-FAST ACCESSIBLE ASSISTANT (NUTRITION EDITION)
// ==========================================================================

const GEMINI_KEY = "AQ.Ab8RN6J67tH1irzTGxB8Ub9IV9kxN5w5hzGLR71X14HDIEkY_g"; 
const GEMINI_ENDPOINT = `https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=${GEMINI_KEY}`;

let recognitionAssistant = null;
let isAssistantEnabled = true;
let isProcessing = false;
let captionTimeout = null;
let isInitialPromptActive = false;
let isSpaceKeyPressed = false;

// Configuración de la Palabra Clave Universal y Variantes por mala pronunciación
const WAKE_WORDS = ["assistant", "asistente", "asis", "assistant", "system", "sisten", "attendant"];

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
    initSpacebarListener();

    if (!sessionStorage.getItem('assistantAskedThisSession')) {
        sessionStorage.setItem('assistantAskedThisSession', 'true');
        isInitialPromptActive = true;
        setTimeout(() => {
            responderVoz("Welcome! To give commands, always say 'Assistant' first, or hold the spacebar to talk without noise. Would you like to enable the assistant? Say yes or no.");
        }, 1000);
    } else {
        setTimeout(() => {
            announceCurrentPage();
        }, 800);
    }

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

// Lógica de micrófono continuo
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

        if (!rawTranscript || isProcessing || rawTranscript.length < 2) return;

        console.log("🗣️ Escuchado en ambiente:", rawTranscript);

        // Flujo inicial de activación
        if (isInitialPromptActive) {
            isInitialPromptActive = false;
            if (rawTranscript.includes("yes") || rawTranscript.includes("yeah") || rawTranscript.includes("sure") || rawTranscript.includes("si")) {
                isAssistantEnabled = true;
                responderVoz("Assistant enabled! Remember to say Assistant before your command or hold spacebar.");
            } else if (rawTranscript.includes("no") || rawTranscript.includes("nope")) {
                isAssistantEnabled = false;
                if (recognitionAssistant) recognitionAssistant.stop();
                responderVoz("Voice assistant disabled.");
                return;
            }
            return;
        }

        if (!isAssistantEnabled) return;

        // Si se presionó la barra espaciadora, no requiere decir la palabra clave
        let hasWakeWord = isSpaceKeyPressed; 
        let cleanCommand = rawTranscript;

        if (!hasWakeWord) {
            // Verificar si contiene la palabra clave directa o fonéticamente cercana
            for (let word of WAKE_WORDS) {
                if (rawTranscript.includes(word)) {
                    hasWakeWord = true;
                    cleanCommand = rawTranscript.replace(new RegExp(word, 'gi'), '').trim();
                    break;
                }
            }

            // Detección tolerante a mala pronunciación (Fuzzy Match) en la primera palabra
            if (!hasWakeWord) {
                const firstWord = rawTranscript.split(" ")[0];
                if (isSimilarWord(firstWord, "assistant") || isSimilarWord(firstWord, "asistente")) {
                    hasWakeWord = true;
                    cleanCommand = rawTranscript.replace(firstWord, '').trim();
                }
            }
        }

        // Si fue ruido ambiental de la clase y no dijo "Assistant" ni usó la barra espaciadora, lo ignora
        if (!hasWakeWord) {
            console.log("🤫 Ignorado (Ruido o voz de fondo sin la palabra Assistant):", rawTranscript);
            return;
        }

        isProcessing = true;

        // Procesa comandos rápido con tolerancia a errores de pronunciación
        const handledLocally = handleFastLocalCommands(cleanCommand.length > 0 ? cleanCommand : rawTranscript);

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

// CONTROL CON BARRA ESPACIADORA (Push-to-Talk para salones ruidosos)
function initSpacebarListener() {
    window.addEventListener('keydown', (e) => {
        const activeTag = document.activeElement ? document.activeElement.tagName : '';
        
        // Evita interferir si estás escribiendo en un input o cuadro de texto
        if (e.code === 'Space' && !['INPUT', 'TEXTAREA'].includes(activeTag) && !isSpaceKeyPressed && isAssistantEnabled) {
            isSpaceKeyPressed = true;
            setMicVisualStatus(true, true);
            showCaption("🎙️ Escuchando... (Barra Espaciadora Presionada)");
        }
    });

    window.addEventListener('keyup', (e) => {
        if (e.code === 'Space' && isSpaceKeyPressed) {
            isSpaceKeyPressed = false;
            setMicVisualStatus(true, false);
        }
    });
}

// TOLERANCIA A MALA PRONUNCIACIÓN (Algoritmo Levenshtein Distance)
function isSimilarWord(a, b) {
    if (!a || !b) return false;
    const matrix = [];
    for (let i = 0; i <= b.length; i++) matrix[i] = [i];
    for (let j = 0; j <= a.length; j++) matrix[0][j] = j;

    for (let i = 1; i <= b.length; i++) {
        for (let j = 1; j <= a.length; j++) {
            if (b.charAt(i - 1) === a.charAt(j - 1)) {
                matrix[i][j] = matrix[i - 1][j - 1];
            } else {
                matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, Math.min(matrix[i][j - 1] + 1, matrix[i - 1][j] + 1));
            }
        }
    }
    // Permite hasta 2 errores de letras/acentos de diferencia
    return matrix[b.length][a.length] <= 2;
}

// MANEJO INSTANTÁNEO LOCAL (Con flexibilidad de lenguaje)
function handleFastLocalCommands(text) {
    // 0. Detener voz de inmediato
    if (text === "stop" || text.includes("stop") || text.includes("silence") || text.includes("shut up") || text.includes("calla")) {
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        hideCaption();
        return true;
    }

    // 1. Mostrar/Ocultar Modal de Comandos
    if (text.includes("show command") || text.includes("view command") || text.includes("open command") || text.includes("help") || text.includes("command")) {
        toggleCommandsModal(true);
        responderVoz("Showing voice commands.");
        return true;
    }

    if (text.includes("close command") || text.includes("hide command") || text.includes("close list")) {
        toggleCommandsModal(false);
        responderVoz("Closing commands modal.");
        return true;
    }

    // 2. Abrir/Cerrar Panel de Accesibilidad
    if (text.includes("accessibility") || text.includes("panel")) {
        const accessPanel = document.getElementById("accessibilityPanel");
        if (accessPanel) {
            if (typeof toggleAccessPanel === "function") toggleAccessPanel();
        }
        responderVoz("Toggling accessibility panel.");
        return true;
    }

    // 3. Selección en desplegables
    if (text.includes("select") || text.includes("choose") || text.includes("pick")) {
        const optionToSelect = text.replace(/(select|choose|pick)\s+/gi, '').trim();
        const activeSelect = document.activeElement && document.activeElement.tagName === 'SELECT'
            ? document.activeElement
            : document.querySelector('select');

        if (activeSelect && optionToSelect) {
            selectOptionByText(activeSelect, optionToSelect);
            responderVoz(`Selected ${optionToSelect}`);
            return true;
        }
    }

    // 4. Auto-llenado de campos
    if (text.includes("write") || text.includes("type") || text.includes("put") || text.includes("set")) {
        const handledInput = fillFormFieldByVoice(text);
        if (handledInput) return true;
    }

    // 5. Clics e interacción con botones (Mandar / Enviar / Click)
    if (text.includes("click") || text.includes("press") || text.includes("touch") || text.includes("send") || text.includes("submit") || text.includes("mandar") || text.includes("enviar")) {
        let buttonTarget = text.replace(/(click|press|touch|tap|the|button|send|submit)\s+/gi, '').trim();
        if (!buttonTarget || text.includes("send") || text.includes("submit") || text.includes("mandar") || text.includes("enviar")) {
            buttonTarget = "send";
        }
        const clicked = clickButtonByText(buttonTarget) || clickButtonByText("submit") || clickButtonByText("enviar");
        if (clicked) {
            responderVoz("Submitting form.");
            return true;
        }
    }

    // 6. Siguiente campo
    if (text.includes("next") || text.includes("skip")) {
        focusNextInput(document.activeElement);
        responderVoz("Moving to next field.");
        return true;
    }

    // 7. Zoom / Tamaño de fuente
    if (text.includes("zoom in") || text.includes("larger") || text.includes("big text") || text.includes("increase")) {
        if (typeof changeFontSize === "function") changeFontSize(1);
        responderVoz("Increasing text size.");
        return true;
    }

    if (text.includes("zoom out") || text.includes("smaller") || text.includes("decrease")) {
        if (typeof changeFontSize === "function") changeFontSize(-1);
        responderVoz("Decreasing text size.");
        return true;
    }

    // 8. Silenciar / Mute
    if (text.includes("mute") || text.includes("silence")) {
        if (typeof toggleMuteAssistant === "function") toggleMuteAssistant();
        responderVoz("Muting voice assistant.");
        return true;
    }

    // 9. Temas
    if (text.includes("dark mode") || text.includes("night")) {
        if (typeof toggleDarkMode === "function") toggleDarkMode();
        responderVoz("Switching to dark mode.");
        return true;
    }

    if (text.includes("light mode") || text.includes("day")) {
        if (typeof toggleDarkMode === "function") toggleDarkMode();
        responderVoz("Switching to light mode.");
        return true;
    }

    // 10. Desplazamiento / Scroll
    if (text.includes("down")) {
        if (typeof scrollPage === "function") scrollPage('down');
        else window.scrollBy({ top: 400, behavior: 'smooth' });
        responderVoz("Scrolling down.");
        return true;
    }

    if (text.includes("up")) {
        if (typeof scrollPage === "function") scrollPage('up');
        else window.scrollBy({ top: -400, behavior: 'smooth' });
        responderVoz("Scrolling up.");
        return true;
    }

    // 11. Ubicación y Navegación
    if (text.includes("where am i") || text.includes("location") || text.includes("where")) {
        announceCurrentPage();
        return true;
    }

    for (const [key, targetUrl] of Object.entries(NAV_MAP)) {
        if (text.includes(key)) {
            ejecutarNavegacion(`Opening ${key}`, targetUrl);
            return true;
        }
    }

    return false;
}

// AUTO-LLENADO DE FORMULARIOS POR VOZ
function fillFormFieldByVoice(text) {
    const activeEl = document.activeElement;
    const match = text.match(/(?:write|type|put|set)\s+(.+?)(?:\s+in\s+(.+))?$/i);
    if (!match) return false;

    const valueToFill = match[1].trim();
    const targetFieldName = match[2] ? match[2].trim().toLowerCase() : null;

    let targetInput = null;

    if (targetFieldName) {
        const inputs = Array.from(document.querySelectorAll('input, textarea'));
        targetInput = inputs.find(input => {
            const name = (input.name || '').toLowerCase();
            const id = (input.id || '').toLowerCase();
            const placeholder = (input.placeholder || '').toLowerCase();
            const label = (input.getAttribute('aria-label') || '').toLowerCase();
            return name.includes(targetFieldName) || id.includes(targetFieldName) || placeholder.includes(targetFieldName) || label.includes(targetFieldName);
        });
    } else if (activeEl && (activeEl.tagName === "INPUT" || activeEl.tagName === "TEXTAREA")) {
        targetInput = activeEl;
    } else {
        targetInput = document.querySelector('input:not([type="hidden"]), textarea');
    }

    if (targetInput) {
        setInputValue(targetInput, valueToFill);
        responderVoz(`Entered ${valueToFill}`);
        return true;
    }

    return false;
}

// PROCESADOR INTELIGENTE DE GEMINI (Comprensión avanzada)
async function processIntentWithAI(userText) {
    const systemPrompt = `
    You are Kizi, an energetic accessibility assistant. Map the user's spoken intent to an action.
    Note: The user may have poor English pronunciation or accents. Be broad and tolerant in mapping.

    ACCESSIBILITY & FORM ACTIONS:
    - "LARGE_TEXT": User wants larger text/zoom.
    - "MUTE_ASSISTANT": User wants to mute.
    - "DARK_MODE": User wants dark mode.
    - "RESET_ALL": User wants reset settings.
    - "READ_ALOUD": User wants page content read.
    - "DYSLEXIA_MODE": User wants dyslexia font.
    - "MORE_SPACING": User wants text spacing.
    - "VISIBLE_FOCUS": User wants focus outline.
    - "OPEN_PANEL": User wants accessibility panel.
    - "SHOW_COMMANDS": User wants command list.
    - "CLICK_BUTTON": User wants to submit, send, or click a button. Extract button name in "value".
    - "SELECT_OPTION": User wants to select dropdown option. Extract option in "value".
    - "NEXT_FIELD": User wants to jump to next input field.

    NAVIGATION TARGET MAPPING:
    - Home -> "index.php", Experts -> "expertos1.php", Plans -> "carpetas.php"
    - Calculator -> "calculadora.php", Services -> "servicios.php", About Us -> "nosotros.php"
    - Profile -> "perfil.php", Appointments -> "citas.php", Food -> "catalogo.php"

    RESPOND STRICTLY WITH RAW JSON:
    {
        "action": "ACTION_NAME" or "NAVIGATE" or "UNKNOWN",
        "target": "target_filename.php" or null,
        "value": "string value or null",
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
                if (typeof changeFontSize === "function") changeFontSize(1);
                break;
            case "MUTE_ASSISTANT":
                if (typeof toggleMuteAssistant === "function") toggleMuteAssistant();
                break;
            case "DARK_MODE":
                if (typeof toggleDarkMode === "function") toggleDarkMode();
                break;
            case "RESET_ALL":
                if (typeof resetAccessibility === "function") resetAccessibility();
                break;
            case "READ_ALOUD":
                if (typeof readSelectedText === "function") readSelectedText();
                break;
            case "SHOW_COMMANDS":
                toggleCommandsModal(true);
                break;
            case "CLICK_BUTTON":
                if (parsed.value) clickButtonByText(parsed.value);
                else clickButtonByText("send");
                break;
            case "SELECT_OPTION":
                const selectElement = document.activeElement && document.activeElement.tagName === 'SELECT'
                    ? document.activeElement
                    : document.querySelector('select');
                if (selectElement && parsed.value) selectOptionByText(selectElement, parsed.value);
                break;
            case "NEXT_FIELD":
                focusNextInput(document.activeElement);
                break;
            case "NAVIGATE":
                if (parsed.target) {
                    setTimeout(() => { window.location.href = parsed.target; }, 1000);
                }
                break;
        }
    } catch (err) {
        console.error("AI Error:", err);
        responderVoz("I didn't capture that clearly. Remember to say 'Assistant' before your command.");
    }
}

// MODAL DE COMANDOS ESTILO VERDE
function toggleCommandsModal(show) {
    let modal = document.getElementById('commandsModalOverlay');

    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'commandsModalOverlay';
        modal.className = 'commands-modal-overlay';
        modal.innerHTML = `
            <div class="commands-modal-card">
                <button class="commands-modal-close" onclick="toggleCommandsModal(false)">&times;</button>
                <h3>🎙️ Voice Commands</h3>
                <p style="font-size: 0.85rem; color: #27ae60; margin-bottom: 10px;">💡 Say <b>"Assistant"</b> first or hold <b>Spacebar</b> to talk.</p>
                <div class="commands-list">
                    <div class="command-item"><span>Show list</span> <code>"Assistant show commands"</code></div>
                    <div class="command-item"><span>Write value</span> <code>"Assistant write [value] in [field]"</code></div>
                    <div class="command-item"><span>Select option</span> <code>"Assistant select [option]"</code></div>
                    <div class="command-item"><span>Submit / Send</span> <code>"Assistant click send"</code></div>
                    <div class="command-item"><span>Next field</span> <code>"Assistant next"</code></div>
                    <div class="command-item"><span>Stop speech</span> <code>"Assistant stop"</code></div>
                    <div class="command-item"><span>Zoom in/out</span> <code>"Assistant zoom in / zoom out"</code></div>
                    <div class="command-item"><span>Toggle theme</span> <code>"Assistant dark mode"</code></div>
                    <div class="command-item"><span>Mute voice</span> <code>"Assistant mute"</code></div>
                    <div class="command-item"><span>Scroll screen</span> <code>"Assistant scroll down"</code></div>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
    }

    if (show) {
        modal.classList.add('active');
    } else {
        modal.classList.remove('active');
    }
}

// SUBTÍTULOS Y SÍNTESIS DE VOZ
function showCaption(text) {
    let banner = document.getElementById('assistantCaptionBanner');
    
    if (!banner) {
        banner = document.createElement('div');
        banner.id = 'assistantCaptionBanner';
        banner.className = 'assistant-caption-banner';
        banner.innerHTML = `<span class="caption-icon"></span><span id="captionText"></span>`;
        document.body.appendChild(banner);
    }

    const captionText = document.getElementById('captionText');
    captionText.textContent = text;
    banner.classList.add('visible');

    if (captionTimeout) clearTimeout(captionTimeout);

    const displayDuration = Math.max(3500, text.length * 80); 
    captionTimeout = setTimeout(() => {
        banner.classList.remove('visible');
    }, displayDuration);
}

function hideCaption() {
    const banner = document.getElementById('assistantCaptionBanner');
    if (banner) banner.classList.remove('visible');
}

function responderVoz(mensaje) {
    showCaption(mensaje);

    if (localStorage.getItem('assistantMuted') === 'enabled') {
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        return;
    }

    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(mensaje);
        utterance.lang = 'en-US';
        utterance.rate = 1.0;
        utterance.pitch = 1.1;

        utterance.onend = () => {
            hideCaption();
        };

        window.speechSynthesis.speak(utterance);
    }
}

function ejecutarNavegacion(mensajeVoz, urlDestino) {
    responderVoz(mensajeVoz);
    setTimeout(() => {
        window.location.href = urlDestino;
    }, 1000);
}

function toggleAssistantState() {
    isAssistantEnabled = !isAssistantEnabled;
    if (isAssistantEnabled) {
        try { recognitionAssistant.start(); } catch (e) {}
        responderVoz("Assistant enabled.");
    } else {
        if (recognitionAssistant) recognitionAssistant.stop();
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        hideCaption();
        setMicVisualStatus(false);
    }
}

function setMicVisualStatus(isActive, isProcessing = false) {
    const btnAcceso = document.querySelector('.access-btn') || document.getElementById('accessibilityBtn');
    if (!btnAcceso) return;

    if (isProcessing) {
        btnAcceso.style.boxShadow = "0 0 0 5px #27ae60, 0 0 15px #27ae60";
    } else if (isActive) {
        btnAcceso.style.boxShadow = "0 0 0 5px #2ecc71, 0 0 15px #2ecc71";
    } else {
        btnAcceso.style.boxShadow = "";
    }
}

// ASISTENCIA UNIVERSAL DE INTERACCIÓN DE DOM
function setInputValue(element, value) {
    if (!element) return;
    element.focus();
    element.value = value;
    element.dispatchEvent(new Event('input', { bubbles: true }));
    element.dispatchEvent(new Event('change', { bubbles: true }));
}

function selectOptionByText(selectElement, textToMatch) {
    if (!selectElement) return;
    const search = textToMatch.toLowerCase();
    
    for (let option of selectElement.options) {
        if (option.text.toLowerCase().includes(search) || option.value.toLowerCase().includes(search)) {
            selectElement.value = option.value;
            selectElement.dispatchEvent(new Event('change', { bubbles: true }));
            break;
        }
    }
}

function clickButtonByText(textToMatch) {
    const search = textToMatch.toLowerCase();
    const clickables = document.querySelectorAll('button, input[type="button"], input[type="submit"], a, .btn');
    
    for (let el of clickables) {
        if (el.innerText?.toLowerCase().includes(search) || el.value?.toLowerCase().includes(search)) {
            el.click();
            return true;
        }
    }
    return false;
}

function focusNextInput(currentElement) {
    const inputs = Array.from(document.querySelectorAll('input, select, textarea, button'));
    const index = inputs.indexOf(currentElement);
    if (index > -1 && index < inputs.length - 1) {
        inputs[index + 1].focus();
    }
}