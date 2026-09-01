document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll('.hero-carousel input[name="slider"]');
    let currentIndex = 0;
    const intervalTime = 3500; // Tiempo en milisegundos (4 segundos por slide)

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        slides[currentIndex].checked = true;
    }

    // Iniciar el movimiento automático
    let slideInterval = setInterval(nextSlide, intervalTime);

    // Pausar el movimiento cuando el mouse esté encima del carrusel (Opcional)
    const carousel = document.querySelector('.hero-carousel');
    if (carousel) {
        carousel.addEventListener('mouseenter', () => clearInterval(slideInterval));
        carousel.addEventListener('mouseleave', () => slideInterval = setInterval(nextSlide, intervalTime));
    }
});