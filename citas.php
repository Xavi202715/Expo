<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Book an Appointment</title>

    <link rel="stylesheet"
          href="css/citas.css">

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

</head>


<body>


<!-- ================================================= -->
<!-- BACK BUTTON -->
<!-- ================================================= -->

<a
    href="index.php"
    class="boton-regresar">

    ← Back

</a>



<!-- ================================================= -->
<!-- SUCCESS MODAL -->
<!-- ================================================= -->

<div id="modalExito" class="modal">

    <div class="modal-contenido">

        <div class="check">
            ✔
        </div>

        <h2>
            Appointment Booked!
        </h2>

        <p>
            Your appointment has been successfully registered.
        </p>

        <div class="botones">

            <button
                id="verDatos"
                type="button">

                View Appointment Details

            </button>

            <button
                id="cerrarModal"
                type="button">

                Back

            </button>

        </div>

    </div>

</div>



<!-- ================================================= -->
<!-- MAIN CONTAINER -->
<!-- ================================================= -->

<div class="container">


    <!-- ================================================= -->
    <!-- LEFT SIDE -->
    <!-- ================================================= -->

    <div class="left">

        <h1>
            Book Your Appointment
        </h1>

        <p>
            Fill out the following form and book
            your nutrition consultation easily
            and quickly.
        </p>

        
    </div>



    <!-- ================================================= -->
    <!-- RIGHT SIDE -->
    <!-- ================================================= -->

    <div class="right">

        <form id="appointmentForm">


            <!-- ================================================= -->
            <!-- FULL NAME -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="nombre">
                    Full Name
                </label>

                <input
                    type="text"
                    id="nombre"
                    placeholder="Enter your full name"
                    required>

            </div>



            <!-- ================================================= -->
            <!-- EMAIL -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="correo">
                    Email Address
                </label>

                <input
                    type="email"
                    id="correo"
                    placeholder="example@email.com"
                    required>

            </div>



            <!-- ================================================= -->
            <!-- PHONE -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="telefono">
                    Phone Number
                </label>

                <input
                    type="tel"
                    id="telefono"
                    placeholder="0000-0000"
                    required>

            </div>



            <!-- ================================================= -->
            <!-- APPOINTMENT TYPE -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="modalidad">
                    Appointment Type
                </label>

                <select
                    id="modalidad"
                    required>

                    <option value="">
                        Select an appointment type
                    </option>

                    <option value="Virtual">
                        💻 Virtual
                    </option>

                    <option value="In-Person">
                        📍 In-Person
                    </option>

                </select>

            </div>



            <!-- ================================================= -->
            <!-- SPECIALIST - VIRTUAL ONLY -->
            <!-- ================================================= -->

            <div
                class="input-group campo-dinamico"
                id="grupoEspecialista">

                <label for="especialista">
                    Specialist
                </label>

                <select
                    id="especialista">

                    <option value="">
                        Select a specialist
                    </option>

                    <option value="Andrea López">
                        Andrea López
                    </option>

                    <option value="Sofía Herrera">
                        Sofía Herrera
                    </option>

                    <option value="Meredith Gris">
                        Meredith Gris
                    </option>

                    <option value="Magaly Pérez">
                        Magaly Pérez
                    </option>

                    <option value="Miranda Báez">
                        Miranda Báez
                    </option>

                    <option value="Carlos Ramírez">
                        Carlos Ramírez
                    </option>

                </select>

            </div>



            <!-- ================================================= -->
            <!-- LOCATION - IN-PERSON ONLY -->
            <!-- ================================================= -->

            <div
                class="input-group campo-dinamico"
                id="grupoLugar">

                <label for="lugar">
                    Consultation Location
                </label>

                <select
                    id="lugar">

                    <option value="">
                        Select a location
                    </option>


                    <!-- NVS -->

                    <option
                        value="NVS Nutrición y Vida Sana"
                        data-direccion="83 Av. Sur y Calle Cuscatlán #7, Edificio EPSSA nivel 1, Colonia Escalón, San Salvador, El Salvador">

                        NVS Nutrición y Vida Sana

                    </option>



                    <!-- VITALITE -->

                    <option
                        value="Clínica Nutricional Vitalite El Salvador"
                        data-direccion="Avenida de la Revolución 128, San Salvador, El Salvador">

                        Clínica Nutricional Vitalite El Salvador

                    </option>



                    <!-- NUTRIFIT -->

                    <option
                        value="Clinica Nutricional NutriFit El Salvador"
                        data-direccion="Centro Comercial Vías Españolas, local 7-B, San Salvador, El Salvador">

                        Clinica Nutricional NutriFit El Salvador

                    </option>



                    <!-- NUTRIWENDY -->

                    <option
                        value="NutriWendySV - Wendy Godoy"
                        data-direccion="Centro Comercial Loma Linda, primer nivel, local 1D, San Salvador, El Salvador">

                        NutriWendySV - Wendy Godoy

                    </option>



                    <!-- MAURA -->

                    <option
                        value="Nutricionista Maura Rodríguez"
                        data-direccion="25 Avenida Norte 114, San Salvador, El Salvador">

                        Nutricionista Maura Rodríguez

                    </option>



                    <!-- RINA -->

                    <option
                        value="Rina Elizabeth Parada Mondragón"
                        data-direccion="Medicentro La Esperanza, Módulo J, Local 220, San Salvador, El Salvador">

                        Rina Elizabeth Parada Mondragón

                    </option>



                    <!-- JOHANNA -->

                    <option
                        value="Dra. Johanna Samayoa - Nutricionista Renal"
                        data-direccion="Calle La Mascota 780, San Salvador, El Salvador">

                        Dra. Johanna Samayoa - Nutricionista Renal

                    </option>



                    <!-- NUTRICARE -->

                    <option
                        value="Nutricare Clinics"
                        data-direccion="Torre Humana, piso 15, consultorio 8, San Salvador, El Salvador">

                        Nutricare Clinics

                    </option>



                    <!-- RAQUEL -->

                    <option
                        value="Nutricionista Raquel Platero"
                        data-direccion="Avenida El Boquerón 10, San Salvador, El Salvador">

                        Nutricionista Raquel Platero

                    </option>



                    <!-- IVETTE -->

                    <option
                        value="Clínica Dra. Ivette de Rodríguez"
                        data-direccion="Calle El Mirador 5517, San Salvador, El Salvador">

                        Clínica Dra. Ivette de Rodríguez

                    </option>



                    <!-- OLGA -->

                    <option
                        value="Olga Cabrales - Nutricionista"
                        data-direccion="83 Avenida Sur 133, San Salvador, El Salvador">

                        Olga Cabrales - Nutricionista

                    </option>



                    <!-- NUTRIMADES -->

                    <option
                        value="NUTRIMADES - Clínica de Nutrición Integral"
                        data-direccion="Clínica Médica SAFE Life, Escalón, San Salvador, El Salvador">

                        NUTRIMADES - Clínica de Nutrición Integral

                    </option>



                    <!-- NUTRITION FOREVER -->

                    <option
                        value="Clinica Nutrition Forever"
                        data-direccion="Clínica #7, Boulevard Walter Thilo Deininger, Plaza Médica Ancalmo, segundo nivel, San Salvador, El Salvador">

                        Clinica Nutrition Forever

                    </option>

                </select>

            </div>



            <!-- ================================================= -->
            <!-- LOCATION INFORMATION -->
            <!-- ================================================= -->

            <div
                id="informacionLugar"
                class="ubicacion">

                <div class="ubicacion-titulo">

                    <span>
                        📍
                    </span>

                    <strong id="nombreLugar">
                        Selected Location
                    </strong>

                </div>

                <p id="direccionLugar"></p>

                <a
                    id="botonMapa"
                    href="#"
                    target="_blank"
                    rel="noopener noreferrer">

                    🗺️ Open Location in Google Maps

                </a>

            </div>



            <!-- ================================================= -->
            <!-- MAP -->
            <!-- ================================================= -->

            <div
                id="contenedorMapa"
                class="mapa-container">

                <iframe
                    id="mapa"
                    title="Location map"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>

            </div>



            <!-- ================================================= -->
            <!-- DATE -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="fecha">
                    Date
                </label>

                <input
                    type="date"
                    id="fecha"
                    required>

            </div>



            <!-- ================================================= -->
            <!-- TIME -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="hora">
                    Time
                </label>

                <input
                    type="time"
                    id="hora"
                    required>

            </div>



            <!-- ================================================= -->
            <!-- REASON -->
            <!-- ================================================= -->

            <div class="input-group">

                <label for="motivo">
                    Reason for Consultation
                </label>

                <textarea
                    id="motivo"
                    rows="4"
                    placeholder="Write here..."
                    required></textarea>

            </div>



            <!-- ================================================= -->
            <!-- CONFIRM -->
            <!-- ================================================= -->

            <button
                class="boton-confirmar"
                type="submit">

                Confirm Appointment

            </button>


        </form>

    </div>

</div>



<script src="js/agendar.js"></script>

</body>

</html>
