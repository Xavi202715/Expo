// =====================================================
// ELEMENTS
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


// =====================================================
// APPOINTMENT DATA
// =====================================================

let datosCita = {};


// =====================================================
// DATE
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
// INITIAL STATE
// =====================================================

grupoEspecialista.style.display = "none";

grupoLugar.style.display = "none";

informacionLugar.style.display = "none";

contenedorMapa.style.display = "none";

especialista.required = false;

lugar.required = false;


// =====================================================
// APPOINTMENT TYPE CHANGE
// =====================================================

modalidad.addEventListener("change", function () {


    // =================================================
    // VIRTUAL
    // =================================================

    if (this.value === "Virtual") {

        // Show specialist
        grupoEspecialista.style.display = "flex";

        // Hide location
        grupoLugar.style.display = "none";

        // Required fields
        especialista.required = true;

        lugar.required = false;

        // Clear location
        lugar.value = "";

        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";
    }


    // =================================================
    // IN-PERSON
    // =================================================

    else if (this.value === "In-Person") {

        // Hide specialist
        grupoEspecialista.style.display = "none";

        // Show location
        grupoLugar.style.display = "flex";

        // Required fields
        especialista.required = false;

        lugar.required = true;

        // Clear specialist
        especialista.value = "";

        // Hide previous location information
        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";
    }


    // =================================================
    // NO TYPE SELECTED
    // =================================================

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
// LOCATION CHANGE
// =====================================================

lugar.addEventListener("change", function () {


    // Get selected option
    const opcion =
        this.options[this.selectedIndex];


    // =================================================
    // NO LOCATION SELECTED
    // =================================================

    if (!this.value) {

        informacionLugar.style.display = "none";

        contenedorMapa.style.display = "none";

        mapa.src = "";

        botonMapa.href = "#";

        return;
    }


    // =================================================
    // GET LOCATION DATA
    // =================================================

    const nombre =
        opcion.value;

    const direccion =
        opcion.dataset.direccion;


    // =================================================
    // SHOW LOCATION INFORMATION
    // =================================================

    nombreLugar.textContent =
        nombre;

    direccionLugar.textContent =
        direccion;

    informacionLugar.style.display =
        "block";


    // =================================================
    // GOOGLE MAPS
    // =================================================

    const direccionCodificada =
        encodeURIComponent(direccion);


    // Google Maps external URL

    const urlGoogleMaps =
        `https://www.google.com/maps/search/?api=1&query=${direccionCodificada}`;


    botonMapa.href =
        urlGoogleMaps;


    // =================================================
    // EMBEDDED MAP
    // =================================================

    const urlMapa =
        `https://www.google.com/maps?q=${direccionCodificada}&output=embed`;


    mapa.src =
        urlMapa;


    // Show map

    contenedorMapa.style.display =
        "block";

});


// =====================================================
// SUBMIT FORM
// =====================================================

formulario.addEventListener("submit", function(e) {

    e.preventDefault();


    // Variable for the selected location

    let opcionLugar = null;


    // Get location only for in-person appointments

    if (modalidad.value === "In-Person") {

        opcionLugar =
            lugar.options[lugar.selectedIndex];
    }


    // =================================================
    // CREATE APPOINTMENT DATA
    // =================================================

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
                : "Not applicable",

        lugar:
            modalidad.value === "In-Person"
                ? lugar.value
                : "Virtual consultation",

        direccion:
            modalidad.value === "In-Person" &&
            opcionLugar
                ? opcionLugar.dataset.direccion
                : "The consultation will be conducted virtually.",

        fecha:
            document.getElementById("fecha").value,

        hora:
            document.getElementById("hora").value,

        motivo:
            document.getElementById("motivo").value
    };


    // =================================================
    // SHOW SUCCESS MODAL
    // =================================================

    modal.style.display =
        "flex";

});


// =====================================================
// VIEW APPOINTMENT DETAILS
// =====================================================

verDatos.addEventListener("click", function() {


    alert(

`APPOINTMENT DETAILS

Full Name:
${datosCita.nombre}

Email:
${datosCita.correo}

Phone:
${datosCita.telefono}

Appointment Type:
${datosCita.modalidad}

Specialist:
${datosCita.especialista}

Location:
${datosCita.lugar}

Address:
${datosCita.direccion}

Date:
${datosCita.fecha}

Time:
${datosCita.hora}

Reason for Consultation:
${datosCita.motivo}`

    );

});


// =====================================================
// CLOSE MODAL
// =====================================================

cerrarModal.addEventListener("click", function() {


    // Hide modal

    modal.style.display =
        "none";


    // Reset form

    formulario.reset();


    // Hide specialist

    grupoEspecialista.style.display =
        "none";


    // Hide location

    grupoLugar.style.display =
        "none";


    // Reset required fields

    especialista.required =
        false;

    lugar.required =
        false;


    // Hide location information

    informacionLugar.style.display =
        "none";


    // Hide map

    contenedorMapa.style.display =
        "none";


    // Clear map

    mapa.src =
        "";


    // Reset Google Maps button

    botonMapa.href =
        "#";

});
