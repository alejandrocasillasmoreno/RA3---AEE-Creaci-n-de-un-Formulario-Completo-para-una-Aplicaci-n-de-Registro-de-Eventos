document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('evento-form');
    const out = document.getElementById('respuesta-servidor');

    form.addEventListener('submit', async e => {
        e.preventDefault();
        out.innerHTML = '<div class="alert alert-info">Enviando...</div>';

        try {
            const res = await fetch('procesar_evento.php', {
                method: 'POST',
                body: new FormData(form)
            });
            const data = await res.json();

            if (data.status === 'exito') {
                out.innerHTML = data.htmlRecibo || '<div class="alert alert-success">Listo.</div>';
                form.reset();
            } else {
                const errores = (data.errores || []).map(x => `<li>${x}</li>`).join('');
                out.innerHTML = `<div class="alert alert-danger"><strong>Errores:</strong><ul>${errores}</ul></div>`;
            }
        } catch (err) {
            console.error('Fetch error:', err);
            out.innerHTML = '<div class="alert alert-danger">No se pudo conectar con el servidor.</div>';
        }
    });
});
