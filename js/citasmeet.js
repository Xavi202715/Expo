// Selección de elementos de la interfaz
const userVideo = document.getElementById('userVideo');
const subtitlesBox = document.getElementById('subtitlesBox');
const btnMic = document.getElementById('btnMic');
const btnCam = document.getElementById('btnCam');
const btnLeave = document.getElementById('btnLeave');

// 1. Activar las cámaras web de manera nativa
async function initCamera() {
    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: true,
            audio: true
        });
        // Asignamos el flujo de video a nuestra pantalla "Tú"
        userVideo.srcObject = stream;
    } catch (error) {
        console.error("Error al acceder a la cámara o micrófono:", error);
        subtitlesBox.innerHTML += `<p style="color: #a34828;">[Error]: No se pudo acceder a la cámara. Revisa los permisos.</p>`;
    }
}

// 2. Simulador de interpretación en tiempo real (Simulación del comportamiento de la IA)
function startInterpretationSimulation() {
    const dialogosSimulados = [
        "**Experto**: Hola, buenos días. ¿Cómo has estado con tu plan alimenticio?",
        "**Intérprete IA (Tú)**: Buenos días, he estado siguiendo las porciones de verduras correctamente.",
        "**Experto**: Excelente. Hoy ajustaremos los carbohidratos complejos para mejorar tu energía.",
        "**Intérprete IA (Tú)**: Perfecto, me gustaría añadir más opciones de legumbres si es posible."
    ];

    let index = 0;
    setInterval(() => {
        if (index < dialogosSimulados.length) {
            const nuevoTexto = document.createElement('p');
            nuevoTexto.innerHTML = dialogosSimulados[index];
            subtitlesBox.appendChild(nuevoTexto);
            
            // Auto-scroll hacia abajo en los subtítulos
            subtitlesBox.scrollTop = subtitlesBox.scrollHeight;
            index++;
        }
    }, 4500); // Inserta un nuevo diálogo simulado cada 4.5 segundos
}

// 3. Controles básicos de la interfaz
btnMic.addEventListener('click', () => {
    btnMic.classList.toggle('active-feature');
    btnMic.innerText = btnMic.classList.contains('active-feature') ? "🎙️ Micrófono Activo" : "🎙️ Silenciar";
});

btnCam.addEventListener('click', () => {
    if (userVideo.srcObject) {
        const videoTrack = userVideo.srcObject.getVideoTracks()[0];
        videoTrack.enabled = !videoTrack.enabled;
        btnCam.innerText = videoTrack.enabled ? "📷 Apagar Cámara" : "📷 Encender Cámara";
    }
});

btnLeave.addEventListener('click', () => {
    if(confirm("¿Estás seguro de que deseas finalizar la sesión de nutrición?")) {
        window.close(); // O redirigir al catálogo de expertos
    }
});

// Inicializar funciones al cargar la página
window.addEventListener('DOMContentLoaded', () => {
    initCamera();
    startInterpretationSimulation();
});