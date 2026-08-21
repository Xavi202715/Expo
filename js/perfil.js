// perfil.js
document.addEventListener("DOMContentLoaded", () => {
    // 1. CARGAR CONFIGURACIÓN DE ACCESIBILIDAD GUARDADA EN EDITAR PERFIL
    const config = JSON.parse(localStorage.getItem("nutritionAccesibilidad")) || {
        textoGrande: false,
        altoContraste: false,
        reducirMovimiento: false
    };

    document.body.classList.toggle("texto-grande", config.textoGrande);
    document.body.classList.toggle("alto-contraste", config.altoContraste);
    document.body.classList.toggle("reducir-movimiento", config.reducirMovimiento);

    // 2. MENÚ RESPONSIVE
    const btnMenu = document.getElementById("btnMenu");
    const navMenu = document.getElementById("navMenu");
    const overlay = document.getElementById("overlay");

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