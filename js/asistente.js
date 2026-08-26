// ==========================================================================
// 🎙️ FULLY ACCESSIBLE CONTINUOUS VOICE ASSISTANT - NUTRITION EXPRESS
// ==========================================================================

const nutriAsistente = new Artyom();
window.nutriAsistente = nutriAsistente;

let currentLanguage = "en-US";
let isAssistantActive = false;

// 1. DICCIONARIO DE COMANDOS ROBUSTO (INGLÉS, ESPAÑOL Y SPANGLISH)
const comandos = [
    // --- NAVEGACIÓN GENERAL (.php) ---
    {
        indexes: ["recipes", "recipe", "food", "cook", "view recipes", "go to recipes", "recetas", "resipis", "recipis"],
        action: function() {
            ejecutarNavegacion("Opening recipes", "recetas.php");
        }
    },
    {
        indexes: ["profile", "login", "my account", "book appointment", "appointments", "cita", "agendar", "apointmens"],
        action: function() {
            ejecutarNavegacion("Opening appointments", "citas.php");
        }
    },
    {
        indexes: ["experts", "expert", "nutritionists", "doctors", "go to experts", "expertos"],
        action: function() {
            ejecutarNavegacion("Opening experts list", "expertos1.php");
        }
    },
    {
        indexes: ["home", "main page", "go back", "homepage", "inicio", "jom", "jum"],
        action: function() {
            ejecutarNavegacion("Returning home", "index.php");
        }
    },
    {
        indexes: ["calculator", "calculate", "calories", "macros", "calculadora", "calculaitor"],
        action: function() {
            ejecutarNavegacion("Opening calculator", "calculadora.php");
        }
    },
    {
        indexes: ["plans", "catalog", "view plans", "planes", "catalog"],
        action: function() {
            ejecutarNavegacion("Opening plans catalog", "carpetas.php");
        }
    },

    // --- ACCESO DIRECTO A PLANES ---
    {
        indexes: ["plan one", "plan 1", "balanced nutrition", "plan uno", "plan wan"],
        action: function() {
            ejecutarNavegacion("Opening General Balanced Nutrition plan", "plAB01.php");
        }
    },
    {
        indexes: ["plan two", "plan 2", "weight management", "starter plan", "plan dos", "plan tu"],
        action: function() {
            ejecutarNavegacion("Opening Weight Management Starter plan", "plAB02.php");
        }
    },

    // --- DESPLAZAMIENTO FLUIDO (SCROLL HANDS-FREE) ---
    {
        indexes: ["scroll down", "go down", "bajar", "escro daun", "escrol dan", "scrow down", "escro dan", "daun"],
        action: function() {
            if (typeof scrollPage === "function") scrollPage('down');
        }
    },
    {
        indexes: ["scroll up", "go up", "subir", "escro ap", "escrol ap", "scrow up", "ap"],
        action: function() {
            if (typeof scrollPage === "function") scrollPage('up');
        }
    },
    {
        indexes: ["scroll to top", "top of page", "ir arriba", "ir hasta arriba", "top"],
        action: function() {
            if (typeof scrollPage === "function") scrollPage('top');
        }
    },
    {
        indexes: ["scroll to bottom", "bottom of page", "ir abajo", "ir hasta abajo", "botom"],
        action: function() {
            if (typeof scrollPage === "function") scrollPage('bottom');
        }
    },

    // --- ACCESIBILIDAD Y MODOS ---
    {
        indexes: ["dark mode", "enable dark mode", "modo oscuro", "darc mod", "dar mod"],
        action: function() {
            if (typeof toggleDarkMode === "function") toggleDarkMode();
        }
    },
    {
        indexes: ["high contrast", "contrast", "alto contraste", "jai contras"],
        action: function() {
            if (typeof toggleContrast === "function") toggleContrast();
        }
    },
    {
        indexes: ["dyslexia mode", "dyslexia font", "modo dislexia", "dislexia"],
        action: function() {
            if (typeof toggleDyslexia === "function") toggleDyslexia();
        }
    },
    {
        indexes: ["increase text", "bigger font", "aumentar texto", "incris text"],
        action: function() {
            if (typeof changeFontSize === "function") changeFontSize(1);
        }
    },
    {
        indexes: ["decrease text", "smaller font", "reducir texto", "dicris text"],
        action: function() {
            if (typeof changeFontSize === "function") changeFontSize(-1);
        }
    },
    {
        indexes: ["reset accessibility", "reset settings", "restablecer", "riset"],
        action: function() {
            if (typeof resetAccessibility === "function") resetAccessibility();
        }
    },

    // --- LECTURA Y HERRAMIENTAS ---
    {
        indexes: ["read selection", "read text", "read this", "leer seleccion"],
        action: function() {
            if (typeof readSelectedText === "function") {
                const hasRead = readSelectedText(currentLanguage);
                if (!hasRead) {
                    nutriAsistente.say("Please highlight some text first.");
                }
            }
        }
    },
    {
        indexes: ["where am i", "summary", "read summary", "donde estoy"],
        action: function() {
            if (typeof getPageSummary === "function") {
                nutriAsistente.say(getPageSummary());
            }
        }
    },

    // --- DESACTIVACIÓN POR VOZ ---
    {
        indexes: ["stop listening", "turn off assistant", "apagar asistente", "silencio", "stop"],
        action: function() {
            desactivarAsistente();
        }
    }
];

nutriAsistente.addCommands(comandos);

// 2. DETECCIÓN FLEXIBLE (WILDCARDS)
nutriAsistente.addCommands({
    indexes: ["go to *", "open *", "show me *", "ir a *", "abrir *"],
    smart: true,
    action: function(i, wildcard) {
        const query = wildcard.toLowerCase().trim();

        if (query.includes("recipe") || query.includes("receta") || query.includes("food")) {
            ejecutarNavegacion("Opening recipes", "recetas.php");
        } else if (query.includes("expert") || query.includes("experto") || query.includes("doctor")) {
            ejecutarNavegacion("Opening experts", "expertos1.php");
        } else if (query.includes("calculator") || query.includes("calculadora")) {
            ejecutarNavegacion("Opening calculator", "calculadora.php");
        } else if (query.includes("plan") || query.includes("catalog")) {
            ejecutarNavegacion("Opening catalog", "carpetas.php");
        } else if (query.includes("appointment") || query.includes("cita")) {
            ejecutarNavegacion("Opening appointments", "citas.php");
        } else {
            ejecutarNavegacion("Opening home", "index.php");
        }
    }
});

// 3. VINCULACIÓN AL BOTÓN DE ACCESIBILIDAD (TOGGLE ON/OFF)
window.addEventListener('DOMContentLoaded', () => {
    const btnAcceso = document.querySelector('.access-btn') || document.getElementById('accessibilityBtn');
    
    if (btnAcceso) {
        btnAcceso.addEventListener('click', (e) => {
            e.stopPropagation();
            if (isAssistantActive) {
                desactivarAsistente();
            } else {
                activarAsistenteContinuo();
            }
        });
        console.log("✅ Botón de accesibilidad vinculado correctamente.");
    }
});

/**
 * Activa la escucha continua garantizando que el navegador hable primero e inicie el micrófono sin bloqueos
 */
function activarAsistenteContinuo() {
    nutriAsistente.fatality();
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }

    isAssistantActive = true;
    setMicVisualStatus(true);

    if (typeof playBeepSound === "function") {
        playBeepSound();
    }

    // Saludo inicial directo con SpeechSynthesis
    const saludo = currentLanguage === "en-US" ? "I am listening" : "Te escucho";
    const utterance = new SpeechSynthesisUtterance(saludo);
    utterance.lang = currentLanguage;
    
    // Encender micrófono justo al terminar de hablar
    utterance.onend = function() {
        iniciarArtyomDirecto();
    };

    // Si falla la síntesis de voz, iniciar el micrófono directamente
    utterance.onerror = function() {
        iniciarArtyomDirecto();
    };

    window.speechSynthesis.speak(utterance);
}

/**
 * Inicialización segura de Artyom
 */
function iniciarArtyomDirecto() {
    nutriAsistente.initialize({
        lang: currentLanguage,
        continuous: true,     // Escucha activa y permanente
        listen: true,
        debug: true,          // Ver lo que captura en la consola (F12)
        speed: 1
    }).then(() => {
        console.log("🎙️ Micrófono en escucha continua.");
    }).catch((err) => {
        console.error("Error al iniciar el micrófono:", err);
        desactivarAsistente();
    });
}

/**
 * Apaga el asistente
 */
function desactivarAsistente() {
    isAssistantActive = false;
    nutriAsistente.fatality();
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
    }
    setMicVisualStatus(false);
    console.log("🛑 Asistente apagado.");
}

/**
 * Borde verde brillante alrededor del botón cuando el micrófono escucha
 */
function setMicVisualStatus(isActive) {
    const btnAcceso = document.querySelector('.access-btn') || document.getElementById('accessibilityBtn');
    if (btnAcceso) {
        if (isActive) {
            btnAcceso.style.boxShadow = "0 0 0 5px #2ecc71, 0 0 15px #2ecc71";
        } else {
            btnAcceso.style.boxShadow = "";
        }
    }
}

/**
 * Navegación limpia
 */
function ejecutarNavegacion(mensajeVoz, urlDestino) {
    nutriAsistente.say(mensajeVoz);
    desactivarAsistente();
    
    setTimeout(() => {
        window.location.href = urlDestino;
    }, 1200);
}