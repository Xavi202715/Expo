document.addEventListener('DOMContentLoaded', () => {

    // =========================================================================
    // publicar comentarios
    // =========================================================================
    const publishBtn = document.getElementById('publishBtn');
    const feedList = document.querySelector('.feed-list');

    if (publishBtn && feedList) {
        publishBtn.addEventListener('click', async (e) => {
            e.preventDefault();

            const nameInput = document.getElementById('feedUserName');
            const messageInput = document.getElementById('feedMessage');

            const name = nameInput.value.trim();
            const message = messageInput.value.trim();

            // Validación de campos requeridos
            if (!name || !message) {
                alert('Por favor ingresa tu nombre y un mensaje antes de publicar.');
                return;
            }

            // Cambiar estado del botón mientras procesa
            publishBtn.disabled = true;
            publishBtn.textContent = 'Publicando...';

            try {
                // Intento de envío al servidor PHP
                const response = await fetch('api/post_feed.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ user_name: name, message: message })
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.status === 'success') {
                        agregarItemAlFeed(data.user_name, data.initial, data.message, 'Just now');
                    } else {
                        // Fallback por si la API responde error
                        agregarItemAlFeed(name, name.charAt(0).toUpperCase(), message, 'Just now');
                    }
                } else {
                    // Fallback si la ruta PHP aún no está montada
                    agregarItemAlFeed(name, name.charAt(0).toUpperCase(), message, 'Just now');
                }
            } catch (error) {
                // Renderizado local directo en caso de trabajar offline o sin backend
                agregarItemAlFeed(name, name.charAt(0).toUpperCase(), message, 'Just now');
            }

            // Limpiar formulario y restaurar botón
            nameInput.value = '';
            messageInput.value = '';
            publishBtn.disabled = false;
            publishBtn.textContent = 'Share Update!';
        });
    }

    function agregarItemAlFeed(userName, initial, text, timeAgo) {
        const item = document.createElement('div');
        item.className = 'feed-item';

        // Aplicar colores de avatar dinámicos opcionales
        const colorClasses = ['', 'alt-1', 'alt-2', 'alt-3'];
        const randomClass = colorClasses[Math.floor(Math.random() * colorClasses.length)];

        item.innerHTML = `
            <div class="feed-avatar ${randomClass}">${initial}</div>
            <div class="feed-content">
                <p><strong>${escapeHTML(userName)}</strong>: ${escapeHTML(text)}</p>
                <span class="feed-time">${timeAgo}</span>
            </div>
        `;

        // Animación de entrada
        item.style.opacity = '0';
        item.style.transform = 'translateY(-10px)';
        item.style.transition = 'all 0.3s ease';

        feedList.prepend(item);

        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 50);
    }

    function escapeHTML(str) {
        return str.replace(/[&<>'"]/g, 
            tag => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;' }[tag] || tag)
        );
    }

// =========================================================================
    // interacción d botones
    // =========================================================================
    const challengeButtons = document.querySelectorAll('.btn-challenge-join');

    challengeButtons.forEach(button => {
        // Inicializar estado en el HTML si no existe
        if (!button.hasAttribute('data-joined')) {
            button.setAttribute('data-joined', 'false');
        }

        button.addEventListener('click', async () => {
            const card = button.closest('.challenge-card');
            const meta = card.querySelector('.challenge-meta');
            const challengeId = card.getAttribute('data-id');

            // Leer estado actual
            const isJoined = button.getAttribute('data-joined') === 'true';

            // Extraer el número actual de participantes
            const countMatch = meta.textContent.match(/\d[\d,]*/);
            let currentCount = countMatch ? parseInt(countMatch[0].replace(/,/g, '')) : 0;

            if (!isJoined) {
                // --- UNIRSE AL DESAFÍO ---
                currentCount++;
                button.setAttribute('data-joined', 'true');
                button.innerHTML = 'Joined! <i class="fa-solid fa-check"></i>';
                button.style.backgroundColor = 'var(--forest-green)';
                button.style.color = '#ffffff';
                button.style.borderColor = 'var(--forest-green)';
            } else {
                // --- SALIR DEL DESAFÍO ---
                currentCount = Math.max(0, currentCount - 1); // Evita números negativos
                button.setAttribute('data-joined', 'false');
                button.innerHTML = 'Join Challenge';
                // Limpiamos los estilos en línea para que tome el CSS original
                button.style.backgroundColor = '';
                button.style.color = '';
                button.style.borderColor = '';
            }

            // Actualizar texto del contador de participantes
            meta.innerHTML = `<i class="fa-solid fa-user-group"></i> ${currentCount.toLocaleString()} people joined`;

            // Petición al backend notificando la acción ('join' o 'leave')
            try {
                await fetch('api/join_challenge.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ 
                        challenge_id: challengeId,
                        action: !isJoined ? 'join' : 'leave'
                    })
                });
            } catch (err) {
                console.error('Error al actualizar el estado del desafío:', err);
            }
        });
    });

    // =========================================================================
    // votación
    // =========================================================================
    const pollButtons = document.querySelectorAll('.poll-option-btn');
    const resultBoxText = document.querySelector('.poll-result-box p');

    pollButtons.forEach(btn => {
        btn.addEventListener('click', async () => {
            // Remover estado activo de los demás botones
            pollButtons.forEach(b => b.classList.remove('active-option'));
            btn.classList.add('active-option');

            const selectedOption = btn.textContent.trim();

            try {
                const response = await fetch('api/vote_poll.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ option: selectedOption })
                });

                if (response.ok) {
                    const data = await response.json();
                    if (data.status === 'success') {
                        resultBoxText.innerHTML = `<strong>${data.percentage}% of the OLI community</strong> chose <strong>${data.option}</strong>.`;
                        return;
                    }
                }
            } catch (e) {
            }

            // Respuesta por defecto
            resultBoxText.innerHTML = `Thanks for voting! You selected <strong>${selectedOption}</strong>.`;
        });
    });

});