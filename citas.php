<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Agendar Consulta</title>

<link rel="stylesheet" href="css/citas.css">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body>

<div class="container">

<div class="left">

<h1>Agenda tu cita</h1>

<p>

Completa el siguiente formulario y uno de nuestros especialistas se pondrá en contacto contigo lo antes posible.

</p>
</div>

<div class="right">

<form id="appointmentForm">

<div class="input-group">

<label>Nombre completo</label>

<input
type="text"
required>

</div>

<div class="input-group">

<label>Correo electrónico</label>

<input
type="email"
required>

</div>

<div class="input-group">

<label>Teléfono</label>

<input
type="tel"
required>

</div>

<div class="input-group">

<label>Especialista</label>

<select required>

<option value="">Selecciona uno</option>

<option>Calixta Torres</option>

<option>Cristina Yanos</option>

<option>Meredith Gris</option>

<option>Magaly Pérez</option>

<option>Miranda Báez</option>

<option>Derek Pastor</option>

</select>

</div>

<div class="input-group">

<label>Fecha</label>

<input
type="date"
required>

</div>

<div class="input-group">

<label>Hora</label>

<input
type="time"
required>

</div>

<div class="input-group">

<label>Motivo de consulta</label>

<textarea
rows="4"
placeholder="Escribe aquí..."
required></textarea>

</div>

<button>

Confirmar cita

</button>

</form>

</div>

</div>

<script src="js/agendar.js"></script>

</body>

</html>