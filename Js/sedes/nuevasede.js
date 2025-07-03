document.addEventListener('click', async (e) => {
    if (e.target && e.target.id === 'btnNuevaSede') {
        const { value: formValues, isConfirmed } = await Swal.fire({
            title: 'Nueva Sede',
            html: `
                <input id="swal-nombre" class="swal2-input" placeholder="Nombre">
                <input id="swal-direccion" class="swal2-input" placeholder="Dirección">
                <input id="swal-telefono" class="swal2-input" placeholder="Teléfono">
                <input id="swal-email" class="swal2-input" placeholder="Email">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Agregar',
            preConfirm: () => {
                return {
                    nombreSede: document.getElementById('swal-nombre').value.trim(),
                    direccionSede: document.getElementById('swal-direccion').value.trim(),
                    telefonoSede: document.getElementById('swal-telefono').value.trim(),
                    emailSede: document.getElementById('swal-email').value.trim()
                };
            }
        });

        if (isConfirmed && formValues) {
            try {
                const res = await fetch('../includes/sedesController.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams(formValues)
                });

                const result = await res.json();

                if (!res.ok) {
                    throw new Error(result.message || 'Error al agregar la sede');
                }

                await Swal.fire('¡Agregado!', result.message, 'success');
                cargarSedes(); // recarga la tabla

            } catch (error) {
                Swal.fire('Error', error.message, 'error');
            }
        }
    }
});
