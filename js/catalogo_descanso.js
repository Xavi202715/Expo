document.addEventListener("DOMContentLoaded", () => {
  const search = document.getElementById("search");
  const condition = document.getElementById("condition");
  const level = document.getElementById("level");
  const cards = document.querySelectorAll(".card");
  const sections = document.querySelectorAll(".plan-section");

  /* FILTRO DE PLANES DE DESCANSO */
  function filterPlans() {
    const text = search ? search.value.toLowerCase().trim() : "";
    const c = condition ? condition.value : "all";
    const l = level ? level.value : "all";

    // 1. Filtrar tarjeta por tarjeta
    cards.forEach(card => {
      const titleElement = card.querySelector("h3");
      const title = titleElement ? titleElement.innerText.toLowerCase() : "";

      const matchText = title.includes(text);
      const matchCondition = (c === "all" || card.dataset.condition === c);
      const matchLevel = (l === "all" || card.dataset.level === l);

      card.style.display = (matchText && matchCondition && matchLevel) ? "flex" : "none";
    });

    // 2. Ocultar secciones vacías y divisores
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

  /* EVENTOS DE FILTRADO */
  if (search) search.addEventListener("input", filterPlans);
  if (condition) condition.addEventListener("change", filterPlans);
  if (level) level.addEventListener("change", filterPlans);
});

/* REDIRECCIÓN ESPECÍFICA A DETALLE DESCANSO */
function openPlan(planId) {
  if (planId) {
    window.location.href = 'detalle_descanso.php?id=' + encodeURIComponent(planId);
  } else {
    alert("Plan no encontrado.");
  }
}

/* MARCADOR / FAVORITO PARA DESCANSO */
function toggleBookmark(planCode, planTitle, planLevel, btnElement) {
  fetch('api/guardar_favorito.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      plan_code: planCode,
      plan_title: planTitle,
      plan_level: planLevel,
      tipo: 'descanso'
    })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      const icon = btnElement.querySelector('i');
      if (data.is_favorite) {
        btnElement.classList.add('active');
        if (icon) {
          icon.classList.remove('fa-regular');
          icon.classList.add('fa-solid');
        }
      } else {
        btnElement.classList.remove('active');
        if (icon) {
          icon.classList.remove('fa-solid');
          icon.classList.add('fa-regular');
        }
      }
    } else {
      // Toggle local si aún no está conectado a BD
      const icon = btnElement.querySelector('i');
      btnElement.classList.toggle('active');
      if (icon) {
        icon.classList.toggle('fa-solid');
        icon.classList.toggle('fa-regular');
      }
    }
  })
  .catch(err => {
    // Cambio local en caso de no tener backend listo
    const icon = btnElement.querySelector('i');
    btnElement.classList.toggle('active');
    if (icon) {
      icon.classList.toggle('fa-solid');
      icon.classList.toggle('fa-regular');
    }
  });
}