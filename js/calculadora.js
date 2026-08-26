// ==========================================
// CONFIGURACIÓN DE GEMINI AI
// ==========================================
const GEMINI_API_KEY = "AQ.Ab8RN6J67tH1irzTGxB8Ub9IV9kxN5w5hzGLR71X14HDIEkY_g"; 

// Usamos el modelo exacto que te funciona a ti: gemini-3.6-flash
const GEMINI_URL = `https://generativelanguage.googleapis.com/v1beta/models/gemini-3.6-flash:generateContent?key=${GEMINI_API_KEY}`;

// Elementos del DOM
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

if (imageUpload) {
    imageUpload.addEventListener('change', handleImageUpload);
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

// Convierte la imagen a base64 para enviarla a Gemini
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

async function analyzeFoodWithGemini(imageFile) {
    try {
        const imagePart = await fileToGenerativePart(imageFile);

        const promptText = `
        Analiza detenidamente la imagen adjunta.

        SI NO ES COMIDA NI UN ALIMENTO PREPARADO (por ejemplo: un animal vivo, una persona, un vehículo, un objeto, etc.):
        Responde ÚNICAMENTE con este JSON:
        {
            "es_comida": false,
            "error_mensaje": "La imagen no parece contener alimentos o platillos comestibles."
        }

        SI ES COMIDA O UN PLATILLO:
        Analiza sus macronutrientes aproximados e ingredientes y responde ÚNICAMENTE con este JSON:
        {
            "es_comida": true,
            "platillo": "Nombre del platillo detectado",
            "ingredientes": ["Ingrediente 1", "Ingrediente 2"],
            "macros": {
                "calorias": 500,
                "proteina": "30g",
                "grasas": "20g",
                "carbohidratos": "40g"
            }
        }

        Regla estricta: Devuelve SOLO el texto JSON crudo, sin bloques de código markdown (\`\`\`json) ni texto adicional.
        `;

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

        let response;
        let retries = 3; // Intentos si el servidor responde con 503 (Alta Demanda)

        while (retries > 0) {
            response = await fetch(GEMINI_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestBody)
            });

            // Si Google responde 503 (Alta demanda temporal), esperamos 2 segundos y reintentamos automáticamente
            if (response.status === 503 && retries > 1) {
                console.warn(`Servidor de Google en alta demanda (503). Reintentando... (${retries - 1} intentos restantes)`);
                retries--;
                await new Promise(resolve => setTimeout(resolve, 2000));
            } else {
                break;
            }
        }

        const data = await response.json();

        if (!response.ok) {
            console.error("Error devuelto por la API de Google:", data);
            const message = data.error?.message || response.statusText;
            throw new Error(`Error API (${response.status}): ${message}`);
        }

        if (!data.candidates || !data.candidates[0]?.content?.parts?.[0]?.text) {
            throw new Error("Respuesta inválida o incompleta de la IA.");
        }

        const rawText = data.candidates[0].content.parts[0].text;
        const cleanJsonString = rawText.replace(/```json/g, '').replace(/```/g, '').trim();
        const parsedResult = JSON.parse(cleanJsonString);

        if (!parsedResult.es_comida) {
            alert(parsedResult.error_mensaje || "La imagen subida no parece ser un alimento.");
            if (loaderSection) loaderSection.classList.add('hidden');
            return;
        }

        displayResults(parsedResult);

    } catch (error) {
        console.error("Error al procesar la imagen:", error);
        alert(`Ocurrió un error:\n${error.message}`);
        if (loaderSection) loaderSection.classList.add('hidden');
    }
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
}