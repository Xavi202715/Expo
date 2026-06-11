const togglePassword =
document.getElementById("togglePassword");

const password =
document.getElementById("password");

togglePassword.addEventListener("click", ()=>{

    if(password.type === "password"){
        password.type = "text";
        togglePassword.classList.replace(
        "fa-eye",
        "fa-eye-slash"
        );
    }
    else{
        password.type = "password";
        togglePassword.classList.replace(
        "fa-eye-slash",
        "fa-eye"
        );
    }

});

document
.getElementById("loginForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    const email =
    document.getElementById("email").value;

    const password =
    document.getElementById("password").value;

    if(password.length < 6){

        alert(
        "La contraseña debe tener al menos 6 caracteres"
        );

        return;
    }

    alert("Inicio de sesión correcto");

});

const accessBtn =
document.getElementById("accessibilityBtn");

const accessPanel =
document.getElementById("accessibilityPanel");

accessBtn.addEventListener("click", ()=>{

    accessPanel.classList.toggle("active");

});

function toggleLargeText(){

    document.body.classList.toggle("large-text");

}

function toggleDarkMode(){

    document.body.classList.toggle("dark-mode");

}

function toggleContrast(){

    document.body.classList.toggle("contrast");

}

function toggleDyslexia(){

    document.body.classList.toggle("dyslexia");

}

function readPage(){

    const speech =
    new SpeechSynthesisUtterance(
    document.body.innerText
    );

    speech.lang = "es-ES";

    speechSynthesis.cancel();
    speechSynthesis.speak(speech);

}

function toggleSpacing(){

    document.body.classList.toggle("spacing");

}

function toggleFocus(){

    document.body.classList.toggle("focus-mode");

}