// editar-perfil.js

document.addEventListener("DOMContentLoaded", () => {
    // ELEMENTOS DEL DOM
    const vistaFoto = document.getElementById("vistaFoto");
    const nuevaFoto = document.getElementById("nuevaFoto");
    const textoGrandeEditar = document.getElementById("textoGrandeEditar");
    const contrasteEditar = document.getElementById("contrasteEditar");
    const movimientoEditar = document.getElementById("movimientoEditar");
    const btnMenu = document.getElementById("btnMenu");
    const navMenu = document.getElementById("navMenu");
    const overlay = document.getElementById("overlay");

    // 1. VISTA PREVIA DE LA FOTO SELECCIONADA
    if (nuevaFoto) {
        nuevaFoto.addEventListener("change", (e) => {
            const archivo = e.target.files[0];
            if (archivo) {
                const lector = new FileReader();
                lector.onload = (evento) => {
                    vistaFoto.src = evento.target.result;
                };
                lector.readAsDataURL(archivo);
            }
        });
    }

    // 2. GESTIÓN DE ACCESIBILIDAD Y PERSISTENCIA
    function aplicarAccesibilidad() {
        const config = JSON.parse(localStorage.getItem("nutritionAccesibilidad")) || {
            textoGrande: false,
            altoContraste: false,
            reducirMovimiento: false
        };

        // Aplicar clases al body
        document.body.classList.toggle("texto-grande", config.textoGrande);
        document.body.classList.toggle("alto-contraste", config.altoContraste);
        document.body.classList.toggle("reducir-movimiento", config.reducirMovimiento);

        // Sincronizar checkboxes del formulario
        if (textoGrandeEditar) textoGrandeEditar.checked = config.textoGrande;
        if (contrasteEditar) contrasteEditar.checked = config.altoContraste;
        if (movimientoEditar) movimientoEditar.checked = config.reducirMovimiento;
    }

    function guardarAccesibilidad() {
        const config = {
            textoGrande: textoGrandeEditar.checked,
            altoContraste: contrasteEditar.checked,
            reducirMovimiento: movimientoEditar.checked
        };
        localStorage.setItem("nutritionAccesibilidad", JSON.stringify(config));
        aplicarAccesibilidad();
    }

    // Listeners para los toggles de accesibilidad
    if (textoGrandeEditar && contrasteEditar && movimientoEditar) {
        textoGrandeEditar.addEventListener("change", guardarAccesibilidad);
        contrasteEditar.addEventListener("change", guardarAccesibilidad);
        movimientoEditar.addEventListener("change", guardarAccesibilidad);
    }

    // Cargar preferencia al iniciar
    aplicarAccesibilidad();

    // 3. MENÚ HAMBURGUESA RESPONSIVE
    if (btnMenu && navMenu && overlay) {
        btnMenu.addEventListener("click", () => {
            navMenu.classList.toggle("activo");
            overlay.classList.toggle("activo");
        });

        overlay.addEventListener("click", () => {
            navMenu.classList.remove("activo");
            overlay.classList.remove("activo");
        });
    }
});