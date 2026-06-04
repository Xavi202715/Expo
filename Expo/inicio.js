const textoGrande = document.getElementById("textoGrande");
const contraste = document.getElementById("contraste");
const voz = document.getElementById("voz");
const dislexia = document.getElementById("dislexia");

// Texto grande

textoGrande.addEventListener("click", () => {
    document.body.classList.toggle("large-text");
});

// Alto contraste

contraste.addEventListener("click", () => {
    document.body.classList.toggle("high-contrast");
});

// Modo dislexia

dislexia.addEventListener("click", () => {
    document.body.classList.toggle("dislexia");
});

// Lectura por voz

voz.addEventListener("click", () => {

    const contenido = document.body.innerText;

    const speech = new SpeechSynthesisUtterance(contenido);

    speech.lang = "es-ES";

    speechSynthesis.cancel();
    speechSynthesis.speak(speech);

});