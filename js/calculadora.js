// ==========================================
// CONFIGURACIÓN DE GEMINI AI & ACCESIBILIDAD
// ==========================================
const GEMINI_API_KEY = "AQ.Ab8RN6J67tH1irzTGxB8Ub9IV9kxN5w5hzGLR71X14HDIEkY_g"; 
const GEMINI_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=${GEMINI_API_KEY}`;

// Elementos del DOM - General
const imageUpload = document.getElementById('imageUpload');
const previewSection = document.getElementById('previewSection');
const imagePreview = document.getElementById('imagePreview');
const loaderSection = document.getElementById('loaderSection');
const resultsSection = document.getElementById('resultsSection');

// Elementos para mostrar los datos
const foodName = document.getElementById('foodName');
const calValue = document.getElementById('calValue');
const protValue = document.getElementById('protValue');
const fatValue = document.getElementById('fatValue');
const ingredientsList = document.getElementById('ingredientsList');
const recommendationsText = document.getElementById('recommendationsText');

// Elementos - Accesibilidad (Texto y Voz)
const foodTextInput = document.getElementById('foodTextInput');
const btnAnalyzeText = document.getElementById('btnAnalyzeText');
const btnVoiceRecord = document.getElementById('btnVoiceRecord');
const btnInlineMic = document.getElementById('btnInlineMic'); // Botón integrado en la barra de texto
const tabBtns = document.querySelectorAll('.tab-btn');
const tabPanels = document.querySelectorAll('.tab-panel');

// Reconocimiento de Voz (Web Speech API)
let recognition = null;
let isRecording = false;
let activeMicSource = null; // Guarda qué botón inició la grabación ('tab' o 'inline')

if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    recognition = new SpeechRecognition();
    recognition.lang = 'es-ES'; // Idioma de escucha (puedes cambiar a 'en-US' si lo prefieres)
    recognition.continuous = false;
    recognition.interimResults = false;

    recognition.onresult = (event) => {
        const transcript = event.results[0][0].transcript;
        console.log("Texto detectado:", transcript);
        
        // Escribir el texto detectado en el textarea
        if (foodTextInput) {
            foodTextInput.value = transcript;
        }

        const currentSource = activeMicSource;
        stopRecordingUI();

        // Si fue invocado desde la pestaña exclusiva de voz, procesa automáticamente.
        // Si fue desde el micrófono integrado en el texto, el usuario puede revisar antes de dar clic en Analyze.
        if (currentSource === 'tab') {
            processFoodText(transcript);
        }
    };

    recognition.onerror = (event) => {
        console.error("Error en reconocimiento de voz:", event.error);
        stopRecordingUI();
        alert("No se pudo procesar la voz. Intenta escribir directamente en el cuadro de texto.");
    };

    recognition.onend = () => {
        stopRecordingUI();
    };
}

// Inicialización de Eventos
document.addEventListener('DOMContentLoaded', () => {
    // Manejo de Pestañas (Imagen / Texto / Voz)
    if (tabBtns.length > 0) {
        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => b.classList.remove('active'));
                tabPanels.forEach(p => p.classList.add('hidden'));

                btn.classList.add('active');
                const targetPanel = document.getElementById(btn.dataset.target);
                if (targetPanel) targetPanel.classList.remove('hidden');
            });
        });
    }

    // Evento Subir Imagen
    if (imageUpload) imageUpload.addEventListener('change', handleImageUpload);

    // Evento Analizar Texto
    if (btnAnalyzeText) {
        btnAnalyzeText.addEventListener('click', () => {
            const description = foodTextInput ? foodTextInput.value.trim() : '';
            if (!description) {
                alert("Please write or dictate a food description first.");
                return;
            }
            processFoodText(description);
        });
    }

    // Evento Grabar Voz (Pestaña principal de voz)
    if (btnVoiceRecord) {
        btnVoiceRecord.addEventListener('click', () => toggleVoiceRecording('tab'));
    }

    // Evento Grabar Voz (Microfonito integrado en la caja de texto)
    if (btnInlineMic) {
        btnInlineMic.addEventListener('click', () => toggleVoiceRecording('inline'));
    }
});

function toggleVoiceRecording(source = 'tab') {
    if (!recognition) {
        alert("Your browser does not support Speech Recognition. Please use text input.");
        return;
    }

    if (!isRecording) {
        try {
            activeMicSource = source;
            recognition.start();
            isRecording = true;

            if (source === 'inline' && btnInlineMic) {
                btnInlineMic.classList.add('listening');
            } else if (btnVoiceRecord) {
                btnVoiceRecord.classList.add('recording');
                btnVoiceRecord.textContent = "🎙️ Listening... (Click to stop)";
            }
        } catch (e) {
            console.error("Error al iniciar el micrófono:", e);
        }
    } else {
        recognition.stop();
        stopRecordingUI();
    }
}

function stopRecordingUI() {
    isRecording = false;
    activeMicSource = null;

    if (btnInlineMic) {
        btnInlineMic.classList.remove('listening');
    }

    if (btnVoiceRecord) {
        btnVoiceRecord.classList.remove('recording');
        btnVoiceRecord.textContent = "🎤 Dictate Food";
    }
}

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (!file) return;

    const imageURL = URL.createObjectURL(file);
    if (imagePreview) imagePreview.src = imageURL;
    
    if (previewSection) previewSection.classList.remove('hidden');
    if (resultsSection) resultsSection.classList.add('hidden');
    if (loaderSection) loaderSection.classList.remove('hidden');

    analyzeFoodWithGemini(file);
}

function fileToGenerativePart(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => {
            const base64Data = reader.result.split(',')[1];
            resolve({
                inlineData: {
                    data: base64Data,
                    mimeType: file.type
                }
            });
        };
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

// Procesar entrada por Imagen
async function analyzeFoodWithGemini(imageFile) {
    try {
        const imagePart = await fileToGenerativePart(imageFile);
        const promptText = getSystemPrompt();

        const requestBody = {
            contents: [
                {
                    parts: [
                        { text: promptText },
                        imagePart
                    ]
                }
            ]
        };

        await sendToGemini(requestBody);
    } catch (error) {
        handleApiError(error);
    }
}

// Procesar entrada por Texto o Voz
async function processFoodText(description) {
    if (previewSection) previewSection.classList.add('hidden');
    if (resultsSection) resultsSection.classList.add('hidden');
    if (loaderSection) loaderSection.classList.remove('hidden');

    try {
        const promptText = `${getSystemPrompt()}\n\nFood description provided by the user: "${description}"`;

        const requestBody = {
            contents: [
                {
                    parts: [
                        { text: promptText }
                    ]
                }
            ]
        };

        await sendToGemini(requestBody);
    } catch (error) {
        handleApiError(error);
    }
}

// Prompt unificado
function getSystemPrompt() {
    return `
    Carefully analyze the input (image or text description).

    IF IT IS NOT FOOD OR AN EDIBLE MEAL:
    Respond ONLY with this raw JSON:
    {
        "es_comida": false,
        "error_mensaje": "The provided input does not contain or describe edible food."
    }

    IF IT IS FOOD OR A DISH:
    Analyze its estimated macronutrients, ingredients, and provide 1-2 healthy substitution/improvement recommendations.
    Respond ONLY with this raw JSON:
    {
        "es_comida": true,
        "platillo": "Detected dish name in English",
        "ingredientes": ["Ingredient 1 in English", "Ingredient 2 in English"],
        "macros": {
            "calorias": 500,
            "proteina": "30g",
            "grasas": "20g",
            "carbohidratos": "40g"
        },
        "recomendacion": "Brief healthy recommendation or healthier alternative in English."
    }

    CRITICAL RULE:
    - All text values (dish name, ingredients, error message, recommendation) MUST BE STRICTLY IN ENGLISH.
    - Return ONLY raw JSON text, without markdown code blocks (\`\`\`json) or extra text.
    `;
}

// Envío a la API con retry
async function sendToGemini(requestBody) {
    let response;
    let retries = 4;

    while (retries > 0) {
        response = await fetch(GEMINI_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(requestBody)
        });

        if (response.status === 503 && retries > 1) {
            retries--;
            await new Promise(resolve => setTimeout(resolve, 2000));
        } else {
            break;
        }
    }

    const data = await response.json();

    if (!response.ok) {
        const message = data.error?.message || response.statusText;
        throw new Error(`API Error (${response.status}): ${message}`);
    }

    if (!data.candidates || !data.candidates[0]?.content?.parts?.[0]?.text) {
        throw new Error("Invalid or incomplete response from AI.");
    }

    const rawText = data.candidates[0].content.parts[0].text;
    const cleanJsonString = rawText.replace(/```json/g, '').replace(/```/g, '').trim();
    const parsedResult = JSON.parse(cleanJsonString);

    if (!parsedResult.es_comida) {
        alert(parsedResult.error_mensaje || "The input does not appear to be food.");
        if (loaderSection) loaderSection.classList.add('hidden');
        return;
    }

    displayResults(parsedResult);
}

function handleApiError(error) {
    console.error("Processing error:", error);
    alert(`An error occurred:\n${error.message}`);
    if (loaderSection) loaderSection.classList.add('hidden');
}

function displayResults(data) {
    if (loaderSection) loaderSection.classList.add('hidden');
    if (resultsSection) resultsSection.classList.remove('hidden');

    if (foodName) foodName.textContent = data.platillo;
    if (calValue) calValue.textContent = `${data.macros.calorias} kcal`;
    if (protValue) protValue.textContent = data.macros.proteina;
    if (fatValue) fatValue.textContent = data.macros.grasas;

    if (ingredientsList) {
        ingredientsList.innerHTML = '';
        data.ingredientes.forEach(ingrediente => {
            const li = document.createElement('li');
            li.textContent = ingrediente;
            ingredientsList.appendChild(li);
        });
    }

    if (recommendationsText && data.recomendacion) {
        recommendationsText.textContent = data.recomendacion;
    }
}