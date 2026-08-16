const search = document.getElementById("search");
const condition = document.getElementById("condition");
const level = document.getElementById("level");
const cards = document.querySelectorAll(".card");
const sections = document.querySelectorAll(".plan-section");

/* FILTRO DE PLANES */
function filterPlans() {
  const text = search ? search.value.toLowerCase().trim() : "";
  const c = condition ? condition.value : "all";
  const l = level ? level.value : "all";

  // 1. Filtrar cada tarjeta individualmente
  cards.forEach(card => {
    const titleElement = card.querySelector("h3");
    const title = titleElement ? titleElement.innerText.toLowerCase() : "";

    const matchText = title.includes(text);
    const matchCondition = (c === "all" || card.dataset.condition === c);
    const matchLevel = (l === "all" || card.dataset.level === l);

    // CAMBIO CLAVE: Usamos "flex" en lugar de "grid"
    card.style.display = (matchText && matchCondition && matchLevel) ? "flex" : "none";
  });

  // 2. Ocultar la sección entera y su línea divisoria si no hay tarjetas visibles en ella
  sections.forEach(section => {
    const visibleCards = Array.from(section.querySelectorAll(".card")).filter(
      card => card.style.display !== "none"
    );
    const nextDivider = section.nextElementSibling;

    if (visibleCards.length > 0) {
      section.style.display = "flex";
      if (nextDivider && nextDivider.classList.contains("section-divider")) {
        nextDivider.style.display = "block";
      }
    } else {
      section.style.display = "none";
      if (nextDivider && nextDivider.classList.contains("section-divider")) {
        nextDivider.style.display = "none";
      }
    }
  });
}

/* EVENTOS */
if (search) search.addEventListener("input", filterPlans);
if (condition) condition.addEventListener("change", filterPlans);
if (level) level.addEventListener("change", filterPlans);

/* REDIRECCIÓN DE PLANES (TUS ENLACES ORIGINALES) */
function openPlan(id) {
  switch (id) {
    case "AB-G1-01":
      window.location.href = "plAB01.html";
      break;

    case "AB-02":
      window.location.href = "ab02.html";
      break;

    case "AB-03":
      window.location.href = "ab03.html";
      break;

    case "AB-04":
      window.location.href = "ab04.html";
      break;

    default:
      alert("Este plan aún no está disponible.");
  }
}