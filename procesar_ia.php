<?php
header('Content-Type: application/json');

// Capturar el cuerpo de la petición HTTP POST
$input = json_decode(file_get_contents('php://input'), true);
$userPrompt = trim($input['prompt'] ?? '');

if (empty($userPrompt)) {
    echo json_encode(["respuesta" => "No recibí ninguna frase para procesar."]);
    exit;
}

// CLAVE DE API DE MODELO DE IA (Ejemplo Gemini / OpenAI)
$apiKey = "TU_API_KEY_AQUI"; 

/*
 * Prompt del Sistema que fuerza a la IA a devolver un objeto JSON estricto
 */
$systemInstruction = "Eres Kizi, el asistente de voz inteligente de Nutrition Express. 
Tu objetivo es interpretar el dictado del usuario y responder ÚNICAMENTE en formato JSON plano con la siguiente estructura:

1. Si el usuario dicta datos numéricos como edad, peso o estatura/altura:
{
  \"tipo\": \"formulario\",
  \"datos\": {
     \"edad\": 25,
     \"peso\": 70,
     \"estatura\": 175
  },
  \"respuesta\": \"He anotado tu edad en 25 años, peso en 70 kilos y estatura en 175 centímetros.\"
}

2. Si solicita ir a una página concreta:
{
  \"tipo\": \"navegacion\",
  \"url\": \"recetas.php\",
  \"respuesta\": \"Abriendo recetas de cocina.\"
}

3. Para consultas de nutrición o conversación general:
{
  \"tipo\": \"conversacion\",
  \"respuesta\": \"Respuesta breve en una o dos frases habladas.\"
}";

// INTEGRACIÓN MEDIANTE CURL HACIA API DE IA
// Aquí puedes hacer la llamada POST enviando $systemInstruction y $userPrompt.

// --- EJEMPLO DE RESPUESTA DE PRUEBA ESTRUCTURADA ---
// Modifica esta respuesta de prueba según necesites probar la extracción:
$esDatos = preg_match('/(\d+)\s*(años|kilos|kg|cm|metros)/i', $userPrompt);

if ($esDatos) {
    // Ejemplo si detecta números en el texto del usuario
    $respuestaSimulada = [
        "tipo" => "formulario",
        "datos" => [
            "edad" => 25,
            "peso" => 70,
            "estatura" => 170
        ],
        "respuesta" => "Entendido. He registrado tus datos en la calculadora."
    ];
} else {
    $respuestaSimulada = [
        "tipo" => "conversacion",
        "respuesta" => "Recuerda que una hidratación adecuada mejora tu metabolismo diario."
    ];
}

echo json_encode($respuestaSimulada);
exit;
?>