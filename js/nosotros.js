const searchInput = document.getElementById("searchInput");

const cards = document.querySelectorAll(".expert-card");

searchInput.addEventListener("keyup", () => {

const value = searchInput.value.toLowerCase();

cards.forEach(card=>{

const text = card.innerText.toLowerCase();

card.style.display = text.includes(value)
? "block"
: "none";

});

});

const filterButtons = document.querySelectorAll(".filter");
const expertCards = document.querySelectorAll(".expert-card");

filterButtons.forEach(button=>{

button.addEventListener("click",()=>{

filterButtons.forEach(btn=>btn.classList.remove("active"));

button.classList.add("active");

const category = button.innerText.toLowerCase();

expertCards.forEach(card=>{

if(category==="todos"){

card.style.display="block";

return;

}

if(card.dataset.category.includes(category)){

card.style.display="block";

}

else{

card.style.display="none";

}

});

});

});
/*================ MODAL =================*/

const modal = document.getElementById("expertModal");

const closeModal = document.querySelector(".close");

const modalImage = document.getElementById("modalImage");

const modalName = document.getElementById("modalName");

const modalSpeciality = document.getElementById("modalSpeciality");

const modalDescription = document.getElementById("modalDescription");

const descriptions={

"Calixta Torres":"Especialista en nutrición clínica con amplia experiencia en enfermedades metabólicas y planes alimenticios personalizados.",

"Cristina Yanos":"Experta en nutrición deportiva enfocada en mejorar el rendimiento físico de atletas y personas activas.",

"Meredith Gris":"Especialista en dietas personalizadas y educación alimentaria para todas las edades.",

"Magaly Pérez":"Nutricionista infantil dedicada al crecimiento y desarrollo saludable de niños y adolescentes.",

"Miranda Báez":"Especialista en control de peso mediante hábitos sostenibles y alimentación consciente.",

"Derek Pastor":"Experto en nutrición para adultos mayores, promoviendo una mejor calidad de vida."
};

document.querySelectorAll(".book-btn").forEach(button=>{

button.addEventListener("click",()=>{

const card=button.closest(".expert-card");

const image=card.querySelector("img").src;

const name=card.querySelector("h3").innerText;

const speciality=card.querySelector(".speciality").innerText;

modal.style.display="flex";

modalImage.src=image;

modalName.innerText=name;

modalSpeciality.innerText=speciality;

modalDescription.innerText=descriptions[name];

});

});

closeModal.onclick=()=>{

modal.style.display="none";

}

window.onclick=(e)=>{

if(e.target===modal){

modal.style.display="none";

}

}

/*================ SCROLL =================*/

const observer=new IntersectionObserver(entries=>{

entries.forEach(entry=>{

if(entry.isIntersecting){

entry.target.style.opacity="1";

entry.target.style.transform="translateY(0)";

}

});

});

document.querySelectorAll(".expert-card").forEach(card=>{

card.style.opacity="0";

card.style.transform="translateY(50px)";

card.style.transition=".6s";

observer.observe(card);

});

document.querySelector(".cta button").onclick=()=>{

alert("¡Gracias por tu interés! Aquí puedes redirigir al formulario de citas.");

}