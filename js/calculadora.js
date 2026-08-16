// Seleccionamos los elementos del DOM (Pantalla)
const imageUpload = document.getElementById('imageUpload');
const previewSection = document.getElementById('previewSection');
const imagePreview = document.getElementById('imagePreview');
const loaderSection = document.getElementById('loaderSection');
const resultsSection = document.getElementById('resultsSection');

// Elementos de datos
const foodName = document.getElementById('foodName');
const calValue = document.getElementById('calValue');
const protValue = document.getElementById('protValue');
const fatValue = document.getElementById('fatValue');
const ingredientsList = document.getElementById('ingredientsList');

// 1. Escuchar cuando se sube o toma una foto
imageUpload.addEventListener('change', handleImageUpload);

function handleImageUpload(event) {
    const file = event.target.files[0];
    
    if (!file) return;

    // Mostrar la vista previa de la imagen
    const imageURL = URL.createObjectURL(file);
    imagePreview.src = imageURL;
    
    // Configurar la interfaz para el análisis
    previewSection.classList.remove('hidden');
    resultsSection.classList.add('hidden');
    loaderSection.classList.remove('hidden');

    // Iniciar el análisis de la IA
    analyzeFood(file);
}

// 2. Función que procesa la imagen (Aquí conectarías tu API en el futuro)
async function analyzeFood(imageFile) {
    
    try {
        /* =========================================
        AQUÍ IRÍA EL CÓDIGO REAL DE TU API (FETCH).
        Como aún no tienes una API key conectada, 
        simularemos la respuesta de la IA (JSON).
        =========================================
        */
        
        const mockApiResponse = await simulateAIApiCall();
        
        // 3. Mostrar los resultados en pantalla
        displayResults(mockApiResponse);

    } catch (error) {
        alert("Hubo un error analizando la imagen. Intenta de nuevo.");
        loaderSection.classList.add('hidden');
    }
}

// 3. Función para inyectar el JSON en el HTML
function displayResults(data) {
    // Ocultar loader y mostrar resultados
    loaderSection.classList.add('hidden');
    resultsSection.classList.remove('hidden');

    // Llenar textos
    foodName.textContent = data.platillo;
    calValue.textContent = `${data.macros.calorias} kcal`;
    protValue.textContent = data.macros.proteina;
    fatValue.textContent = data.macros.grasas;

    // Llenar lista de ingredientes
    ingredientsList.innerHTML = ''; // Limpiar lista anterior
    data.ingredientes.forEach(ingrediente => {
        const li = document.createElement('li');
        li.textContent = ingrediente;
        ingredientsList.appendChild(li);
    });
}

// --- FUNCIÓN DE SIMULACIÓN (Borrar cuando uses una API real) ---
function simulateAIApiCall() {
    return new Promise((resolve) => {
        setTimeout(() => {
            const jsonIA = {
                platillo: "Hamburguesa con Queso",
                ingredientes: ["Pan brioche", "Carne de res (200g)", "Queso cheddar", "Lechuga", "Tomate", "Salsa especial"],
                macros: {
                    calorias: 650,
                    proteina: "35g",
                    grasas: "40g",
                    carbohidratos: "45g"
                }
            };
            resolve(jsonIA);
        }, 2500); // Simulamos 2.5 segundos de carga de la IA
    });
}