// ==========================================================================
// 🎙️ ASISTENTE DE VOZ CORREGIDO - ENCIENDE MICRÓFONO AL INSTANTE
// ==========================================================================

const nutriAsistente = new Artyom();
window.nutriAsistente = nutriAsistente;

// 1. COMANDOS DE VOZ
const comandos = [
    {
        indexes: ["recetas", "comida", "cocinar", "ver recetas", "ir a recetas"],
        action: function() {
            ejecutarNavegacion("Abriendo recetas", "recetas.html");
        }
    },
    {
        indexes: ["perfil", "iniciar", "login", "mi cuenta", "agendar", "cita"],
        action: function() {
            ejecutarNavegacion("Abriendo perfil", "login.html");
        }
    },
    {
        indexes: ["expertos", "nutriólogos", "doctores", "ir a expertos"],
        action: function() {
            ejecutarNavegacion("Abriendo expertos", "expertos.html");
        }
    },
    {
        indexes: ["inicio", "home", "principal", "página principal", "volver"],
        action: function() {
            ejecutarNavegacion("Volviendo al inicio", "index.html");
        }
    },
    {
        indexes: ["alto contraste", "contraste", "cambiar color"],
        action: function() {
            if (typeof toggleContrast === "function") {
                const res = toggleContrast();
                nutriAsistente.say(res);
            }
        }
    },
    {
        indexes: ["modo dislexia", "letra dislexia"],
        action: function() {
            if (typeof toggleDyslexia === "function") {
                const res = toggleDyslexia();
                nutriAsistente.say(res);
            }
        }
    },
    {
        indexes: ["aumentar texto", "letra grande"],
        action: function() {
            if (typeof changeFontSize === "function") {
                changeFontSize(1);
                nutriAsistente.say("Letra más grande");
            }
        }
    },
    {
        indexes: ["reducir texto", "letra pequeña"],
        action: function() {
            if (typeof changeFontSize === "function") {
                changeFontSize(-1);
                nutriAsistente.say("Letra más pequeña");
            }
        }
    }
];

nutriAsistente.addCommands(comandos);

// 2. VINCULACIÓN AL BOTÓN ♿
window.addEventListener('DOMContentLoaded', () => {
    const btnAcceso = document.querySelector('.access-btn') || document.getElementById('accessibilityBtn');
    
    if (btnAcceso) {
        btnAcceso.addEventListener('click', (e) => {
            e.stopPropagation();
            activarAsistenteSeguro();
        });
        console.log("✅ Botón de accesibilidad detectado y listo.");
    }
});

/**
 * Enciende el micrófono garantizando que aparezca el punto rojo
 */
/**
 * Enciende el micrófono garantizando estabilidad y evitando errores infinitos de red
 */
function activarAsistenteSeguro() {
    // 1. Apagamos cualquier proceso previo para limpiar la memoria
    nutriAsistente.fatality(); 
    if (window.speechSynthesis) window.speechSynthesis.cancel();
    
    // Saludo inicial antes de abrir el micrófono para evitar ecos
    nutriAsistente.say("Asistente activo. Dime un comando.");
    
    // 2. Esperamos un segundo a que termine de hablar y encendemos el micrófono de forma controlada
    setTimeout(() => {
        nutriAsistente.initialize({
            lang: "es-ES",
            continuous: false, // <-- Cambiado a FALSE para evitar el bucle infinito de red de Google/Brave
            listen: true,      // Enciende el micrófono
            debug: false,      // Apagamos el debug para limpiar por completo tu consola de mensajes basura
            speed: 1
        }).then(() => {
            console.log("🎙️ Micrófono listo y escuchando comando de forma limpia.");
        }).catch((err) => {
            console.error("Error al iniciar micrófono:", err);
        });
    }, 1200);
}

/**
 * Navegación limpia
 */
function ejecutarNavegacion(mensajeVoz, urlDestino) {
    nutriAsistente.say(mensajeVoz);
    nutriAsistente.dontListen(); // Apaga el micrófono para cambiar de página limpio
    
    setTimeout(() => {
        window.location.href = urlDestino;
    }, 1500);
}