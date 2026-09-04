/*================ BUSCADOR POR TEXTO =================*/
const searchInput = document.getElementById("searchInput");
const cards = document.querySelectorAll(".expert-card");

if (searchInput) {
    searchInput.addEventListener("keyup", () => {
        const value = searchInput.value.toLowerCase().trim();

        cards.forEach(card => {
            const text = card.innerText.toLowerCase();

            if (text.includes(value)) {
                card.style.display = "block";
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
            } else {
                card.style.display = "none";
            }
        });
    });
}

/*================ FILTRADOR POR CATEGORÍA =================*/
const filterButtons = document.querySelectorAll(".filter");
const expertCards = document.querySelectorAll(".expert-card");

filterButtons.forEach(button => {
    button.addEventListener("click", () => {
        // Remover estado activo de todos los botones
        filterButtons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        // Obtener el valor a filtrar (del atributo data-filter o del texto)
        const filterCategory = (button.dataset.filter || button.innerText).toLowerCase().trim();

        expertCards.forEach(card => {
            const cardCategory = (card.dataset.category || "").toLowerCase();

            // Si es "all" o "todos", mostrar todo
            if (filterCategory === "all" || filterCategory === "todos") {
                card.style.display = "block";
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
                return;
            }

            // Validar si la categoría de la tarjeta contiene la categoría filtrada
            if (cardCategory.includes(filterCategory)) {
                card.style.display = "block";
                card.style.opacity = "1";
                card.style.transform = "translateY(0)";
            } else {
                card.style.display = "none";
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

const descriptions = {
    "Andrea López": "Especialista en nutrición clínica con amplia experiencia en enfermedades metabólicas y planes alimenticios personalizados.",
    "Sofía Herrera": "Experta en nutrición deportiva enfocada en mejorar el rendimiento físico de atletas y personas activas.",
    "Meredith Gris": "Especialista en dietas personalizadas y educación alimentaria para todas las edades.",
    "Magaly Pérez": "Nutricionista infantil dedicada al crecimiento y desarrollo saludable de niños y adolescentes.",
    "Miranda Báez": "Especialista en control de peso mediante hábitos sostenibles y alimentación consciente.",
    "Carlos Ramírez": "Experto en nutrición para adultos mayores, promoviendo una mejor calidad de vida."
};

document.querySelectorAll(".book-btn").forEach(button => {
    button.addEventListener("click", () => {
        const card = button.closest(".expert-card");
        const image = card.querySelector("img").src;
        const name = card.querySelector("h3").innerText;
        const speciality = card.querySelector(".speciality").innerText;

        modal.style.display = "flex";
        modalImage.src = image;
        modalName.innerText = name;
        modalSpeciality.innerText = speciality;
        modalDescription.innerText = descriptions[name] || "Especialista en nutrición y bienestar.";
    });
});

if (closeModal) {
    closeModal.onclick = () => {
        modal.style.display = "none";
    };
}

window.onclick = (e) => {
    if (e.target === modal) {
        modal.style.display = "none";
    }
};

/*================ SCROLL OBSERVER =================*/
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
});

document.querySelectorAll(".expert-card").forEach(card => {
    card.style.opacity = "0";
    card.style.transform = "translateY(50px)";
    card.style.transition = ".6s";
    observer.observe(card);
});

const ctaButton = document.querySelector(".cta button");
if (ctaButton) {
    ctaButton.onclick = () => {
        alert("¡Gracias por tu interés! Aquí puedes redirigir al formulario de citas.");
    };
}