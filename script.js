// Obtención de elementos del DOM
const ageSlider = document.getElementById('ageSlider');
const ageValueDisplay = document.getElementById('ageValue');
const audioText = document.getElementById('audioText');

// Inicializar estado de los marcadores inferiores activos al cargar
if(ageSlider) {
    updateActiveTick(parseInt(ageSlider.value));
}

// Función encargada de actualizar el contador central cuando mueves la barra
function updateAgeFromSlider(val) {
    const age = parseInt(val);
    ageValueDisplay.innerText = age;
    audioText.innerText = age + " años seleccionado";
    updateActiveTick(age);
}

// Botón Más (+)
function incrementAge() {
    let currentAge = parseInt(ageSlider.value);
    if (currentAge < parseInt(ageSlider.max)) {
        currentAge++;
        ageSlider.value = currentAge;
        updateAgeFromSlider(currentAge);
    }
}

// Botón Menos (-)
function decrementAge() {
    let currentAge = parseInt(ageSlider.value);
    if (currentAge > parseInt(ageSlider.min)) {
        currentAge--;
        ageSlider.value = currentAge;
        updateAgeFromSlider(currentAge);
    }
}

// Hacer clic directo en un número de los ticks inferiores
function setAge(age) {
    ageSlider.value = age;
    updateAgeFromSlider(age);
}

// Resalta visualmente el número seleccionado abajo del slider
function updateActiveTick(selectedAge) {
    const ticks = document.querySelectorAll('.slider-ticks .tick');
    ticks.forEach((tick, index) => {
        const tickAge = index + 6; // El rango empieza en 6 años
        if (tickAge === selectedAge) {
            tick.classList.add('active');
        } else {
            tick.classList.remove('active');
        }
    });
}

function speakSelectedAge() {
    const age = ageSlider.value;
    const text = `${age} años seleccionado.`;
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'es-ES';
    window.speechSynthesis.speak(utterance);
}

function scrollToAccessibility() {
    document.getElementById('accessibilityPanel').scrollIntoView({ behavior: 'smooth' });
}

// Botón Continuar
function navigateNext() {
    window.location.href = 'siguiente.html'; 
}


// ==========================================================================
// 🛠️ CONTROLADORES REPARADOS DEL PANEL DE ACCESIBILIDAD
// ==========================================================================

// Muestra los botones + y - ocultando la letra "A" tal como en el Login original
function toggleZoomButtons(event) {
    const zoomContainer = document.getElementById('zoomContainer');
    const iconA = document.querySelector('.text-icon');
    
    zoomContainer.classList.toggle('active');
    
    if (zoomContainer.classList.contains('active')) {
        iconA.style.display = 'none';
    } else {
        iconA.style.display = 'flex';
    }
}

let currentSize = 16; 
function changeFontSize(action, event) {
    event.stopPropagation(); // Evita cierres accidentales del contenedor desplegable
    if (action === 1 && currentSize < 24) {
        currentSize += 1;
    } else if (action === -1 && currentSize > 13) {
        currentSize -= 1;
    }
    document.documentElement.style.fontSize = currentSize + 'px';
}

function toggleContrast() { 
    document.body.classList.toggle('high-contrast-mode'); 
}

function toggleLetterSpacing() { 
    document.body.classList.toggle('extra-spacing-mode'); 
}

function toggleFocusVisible() { 
    document.body.classList.toggle('focus-visible-mode'); 
}

function speakText() {
    const text = "¿Cuántos años tienes? Selecciona tu edad usando los botones o deslizando la barra.";
    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'es-ES';
    window.speechSynthesis.speak(utterance);
}