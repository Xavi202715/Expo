document.addEventListener("DOMContentLoaded", () => {
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

      // Usamos "flex" en lugar de "grid" para preservar el layout de las tarjetas
      card.style.display = (matchText && matchCondition && matchLevel) ? "flex" : "none";
    });

    // 2. Ocultar la sección entera y su línea divisoria si no hay tarjetas visibles
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

/* REDIRECCIÓN DE PLANES */
/* REDIRECCIÓN DE PLANES CON PHP UNIVERSAL */
function openPlan(id) {
  if (id) {
    // Redirige al PHP universal pasando el ID como parámetro GET
    window.location.href = `detalle_plan.php?id=${encodeURIComponent(id)}`;
  } else {
    alert("Código de plan no válido.");
  }
}

/* MARCADOR DE FAVORITOS / PLANES FIJADOS */
/* MARCADOR DE FAVORITOS / PLANES FIJADOS */
function toggleBookmark(planCode, planTitle, planLevel, btnElement) {
  console.log("¡Clic detectado en el pin del plan:", planCode);

  fetch('api/guardar_favorito.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      plan_code: planCode,
      plan_title: planTitle,
      plan_level: planLevel
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    console.log("Respuesta del servidor:", data);
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
      alert(data.message || 'Error al guardar el estado del plan.');
    }
  })
  .catch(err => {
    console.error('Error al cambiar favorito:', err);
    alert('No se pudo procesar la solicitud. Inténtalo más tarde.');
  });
}