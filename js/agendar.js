// =====================================================
// ELEMENTOS
// =====================================================

const formulario =
    document.getElementById("appointmentForm");

const modalidad =
    document.getElementById("modalidad");

const grupoEspecialista =
    document.getElementById("grupoEspecialista");

const especialista =
    document.getElementById("especialista");

const grupoLugar =
    document.getElementById("grupoLugar");

const lugar =
    document.getElementById("lugar");

const informacionLugar =
    document.getElementById("informacionLugar");

const nombreLugar =
    document.getElementById("nombreLugar");

const direccionLugar =
    document.getElementById("direccionLugar");

const botonMapa =
    document.getElementById("botonMapa");

const contenedorMapa =
    document.getElementById("contenedorMapa");

const mapa =
    document.getElementById("mapa");

const modal =
    document.getElementById("modalExito");

const cerrarModal =
    document.getElementById("cerrarModal");

const verDatos =
    document.getElementById("verDatos");


let datosCita = {};


// =====================================================
// FECHA MÍNIMA = HOY
// =====================================================

const fecha =
    document.getElementById("fecha");

const hoy =
    new Date();

const año =
    hoy.getFullYear();

const mes =
    String(hoy.getMonth() + 1).padStart(2, "0");

const dia =
    String(hoy.getDate()).padStart(2, "0");

fecha.min =
    `${año}-${mes}-${dia}`;


// =====================================================
// ESTADO INICIAL
// =====================================================

grupoEspecialista.style.display = "none";

grupoLugar.style.display = "none";

informacionLugar.style.display = "none";

contenedorMapa.style.display = "none";

especialista.required = false;

lugar.required = false;


// =====================================================
// CAMBIO DE MODALIDAD
// =====================================================

modalidad.addEventListener("change", function () {


    // ==========================================
    // VIRTUAL
    // ==========================================

    if (this.value === "Virtual") {

        grupoEspecialista.style.display = "flex";

        grupoLugar.style.display = "none";

        especialista.required = true;

        lugar.required = false;

        lugar.value = "";

        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";
    }


    // ==========================================
    // PRESENCIAL
    // ==========================================

    else if (this.value === "Presencial") {

        grupoEspecialista.style.display = "none";

        grupoLugar.style.display = "flex";

        especialista.required = false;

        lugar.required = true;

        especialista.value = "";

        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";
    }


    // ==========================================
    // NINGUNA
    // ==========================================

    else {

        grupoEspecialista.style.display = "none";

        grupoLugar.style.display = "none";

        especialista.required = false;

        lugar.required = false;

        especialista.value = "";

        lugar.value = "";

        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";
    }

});


// =====================================================
// CAMBIO DE LUGAR
// =====================================================

lugar.addEventListener("change", function () {


    const opcion =
        this.options[this.selectedIndex];


    // ==========================================
    // NO HAY LUGAR
    // ==========================================

    if (!this.value) {

        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";

        return;
    }


    // ==========================================
    // DATOS
    // ==========================================

    const nombre =
        opcion.value;

    const direccion =
        opcion.dataset.direccion;


    // ==========================================
    // MOSTRAR DATOS
    // ==========================================

    nombreLugar.textContent =
        nombre;

    direccionLugar.textContent =
        direccion;

    informacionLugar.style.display =
        "block";


    // ==========================================
    // GOOGLE MAPS
    // ==========================================

    const direccionCodificada =
        encodeURIComponent(direccion);


    // URL PARA ABRIR GOOGLE MAPS

    const urlGoogleMaps =
        `https://www.google.com/maps/search/?api=1&query=${direccionCodificada}`;


    botonMapa.href =
        urlGoogleMaps;


    // ==========================================
    // MAPA EMBEBIDO
    // ==========================================

    const urlMapa =
        `https://www.google.com/maps?q=${direccionCodificada}&output=embed`;


    mapa.src =
        urlMapa;


    contenedorMapa.style.display =
        "block";

});


// =====================================================
// ENVIAR FORMULARIO
// =====================================================

formulario.addEventListener("submit", function(e) {

    e.preventDefault();


    let opcionLugar = null;


    if (modalidad.value === "Presencial") {

        opcionLugar =
            lugar.options[lugar.selectedIndex];
    }


    // ==========================================
    // CREAR DATOS
    // ==========================================

    datosCita = {

        nombre:
            document.getElementById("nombre").value,

        correo:
            document.getElementById("correo").value,

        telefono:
            document.getElementById("telefono").value,

        modalidad:
            modalidad.value,

        especialista:
            modalidad.value === "Virtual"
                ? especialista.value
                : "No aplica",

        lugar:
            modalidad.value === "Presencial"
                ? lugar.value
                : "Consulta virtual",

        direccion:
            modalidad.value === "Presencial" &&
            opcionLugar
                ? opcionLugar.dataset.direccion
                : "La consulta será realizada de manera virtual.",

        fecha:
            document.getElementById("fecha").value,

        hora:
            document.getElementById("hora").value,

        motivo:
            document.getElementById("motivo").value
    };


    // ==========================================
    // MOSTRAR MODAL
    // ==========================================

    modal.style.display =
        "flex";

});


// =====================================================
// VER DATOS
// =====================================================

verDatos.addEventListener("click", function() {

    alert(

`DATOS DE LA CITA

Nombre:
${datosCita.nombre}

Correo:
${datosCita.correo}

Teléfono:
${datosCita.telefono}

Modalidad:
${datosCita.modalidad}

Especialista:
${datosCita.especialista}

Lugar:
${datosCita.lugar}

Dirección:
${datosCita.direccion}

Fecha:
${datosCita.fecha}

Hora:
${datosCita.hora}

Motivo:
${datosCita.motivo}`

    );

});


// =====================================================
// CERRAR MODAL
// =====================================================

cerrarModal.addEventListener("click", function() {

    modal.style.display =
        "none";

    formulario.reset();


    grupoEspecialista.style.display =
        "none";

    grupoLugar.style.display =
        "none";

    especialista.required =
        false;

    lugar.required =
        false;

    informacionLugar.style.display =
        "none";

    contenedorMapa.style.display =
        "none";

    mapa.src =
        "";

    botonMapa.href =
        "#";

});