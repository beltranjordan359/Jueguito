document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('nivel1-form');
    const respuestaInput = document.getElementById('respuesta');
    const mensaje = document.querySelector('.mensaje');

    if (respuestaInput) {
        respuestaInput.focus();
    }

    if (form) {
        form.addEventListener('submit', () => {
            if (mensaje) {
                mensaje.textContent = 'Verificando respuesta...';
                mensaje.className = 'mensaje info';
            }
        });
    }

    if (window.NIVEL1_REDIRECT) {
        setTimeout(() => {
            window.location.href = 'nivel2.php';
        }, 2000);
    }
});
