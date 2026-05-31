document.addEventListener("DOMContentLoaded", () => {
    // Referencias de UI de edad
    const ageSlider = document.getElementById('ageSlider');
    const ageValueDisplay = document.getElementById('ageValue');
    const audioText = document.getElementById('audioText');
    const btnMinus = document.getElementById('btnMinus');
    const btnPlus = document.getElementById('btnPlus');
    const ticks = document.querySelectorAll('.slider-ticks .tick');

    // Referencias de Accesibilidad
    const goToAccessibility = document.getElementById('goToAccessibility');
    const textAccessItem = document.getElementById('textAccessItem');
    const zoomContainer = document.getElementById('zoomContainer');
    const iconAa = textAccessItem.querySelector('.text-icon');
    const btnZoomIn = document.getElementById('btnZoomIn');
    const btnZoomOut = document.getElementById('btnZoomOut');
    
    const btnContrast = document.getElementById('btnContrast');
    const btnSpeakText = document.getElementById('btnSpeakText');
    const btnSpeakAge = document.getElementById('btnSpeakAge');
    const btnSpacing = document.getElementById('btnSpacing');
    const btnFocus = document.getElementById('btnFocus');
    const btnContinue = document.getElementById('btnContinue');

    let currentSize = 16; 

    // --- FUNCIÓN CENTRAL DE ACTUALIZACIÓN ---
    function updateAge(value) {
        const age = parseInt(value);
        ageSlider.value = age;
        ageValueDisplay.innerText = age;
        audioText.innerText = age + " años seleccionado";
        
        // Resaltar el número correspondiente abajo
        ticks.forEach(tick => {
            const tickAge = parseInt(tick.getAttribute('data-age'));
            if (tickAge === age) {
                tick.classList.add('active');
            } else {
                tick.classList.remove('active');
            }
        });
    }

    // --- ENLAZAR EVENTOS DEL CONTROL DESLIZANTE ---
    if (ageSlider) {
        ageSlider.addEventListener('input', (e) => {
            updateAge(e.target.value);
        });
        // Inicializar el estado al cargar (Edad: 10)
        updateAge(ageSlider.value);
    }

    // --- ENLAZAR EVENTOS DE BOTONES MÁS / MENOS ---
    if (btnMinus) {
        btnMinus.addEventListener('click', () => {
            let current = parseInt(ageSlider.value);
            if (current > parseInt(ageSlider.min)) {
                updateAge(current - 1);
            }
        });
    }

    if (btnPlus) {
        btnPlus.addEventListener('click', () => {
            let current = parseInt(ageSlider.value);
            if (current < parseInt(ageSlider.max)) {
                updateAge(current + 1);
            }
        });
    }

    // --- ENLAZAR INTERACCIÓN CON LOS REGLONES DE NÚMEROS (TICKS) ---
    ticks.forEach(tick => {
        tick.addEventListener('click', () => {
            const age = tick.getAttribute('data-age');
            updateAge(age);
        });
    });

    // --- ACCESIBILIDAD: MOSTRAR MÁS/MENOS EN TEXTO GRANDE ---
    if (textAccessItem) {
        textAccessItem.addEventListener('click', () => {
            zoomContainer.classList.toggle('active');
            if (zoomContainer.classList.contains('active')) {
                iconAa.style.display = 'none';
            } else {
                iconAa.style.display = 'flex';
            }
        });
    }

    // Botones internos del zoom (+ y -)
    if (btnZoomIn) {
        btnZoomIn.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que se cierre el contenedor al pulsar
            if (currentSize < 24) {
                currentSize += 1;
                document.documentElement.style.fontSize = currentSize + 'px';
            }
        });
    }

    if (btnZoomOut) {
        btnZoomOut.addEventListener('click', (e) => {
            e.stopPropagation(); // Evita que se cierre el contenedor al pulsar
            if (currentSize > 13) {
                currentSize -= 1;
                document.documentElement.style.fontSize = currentSize + 'px';
            }
        });
    }

    // --- ACCESIBILIDAD: OTRAS COMPORTAMIENTOS ---
    if (goToAccessibility) {
        goToAccessibility.addEventListener('click', () => {
            document.getElementById('accessibilityPanel').scrollIntoView({ behavior: 'smooth' });
        });
    }

    if (btnContrast) {
        btnContrast.addEventListener('click', () => {
            document.body.classList.toggle('high-contrast-mode');
        });
    }

    if (btnSpacing) {
        btnSpacing.addEventListener('click', () => {
            document.body.classList.toggle('extra-spacing-mode');
        });
    }

    if (btnFocus) {
        btnFocus.addEventListener('click', () => {
            document.body.classList.toggle('focus-visible-mode');
        });
    }

    // --- LECTORES DE VOZ ---
    if (btnSpeakAge) {
        btnSpeakAge.addEventListener('click', () => {
            const text = `${ageSlider.value} años seleccionado.`;
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'es-ES';
            window.speechSynthesis.speak(utterance);
        });
    }

    if (btnSpeakText) {
        btnSpeakText.addEventListener('click', () => {
            const text = "¿Cuántos años tienes? Elige tu edad con los botones o deslizando la barra.";
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'es-ES';
            window.speechSynthesis.speak(utterance);
        });
    }

    // Continuar ruta
    if (btnContinue) {
        btnContinue.addEventListener('click', () => {
            window.location.href = 'siguiente.html';
        });
    }
});