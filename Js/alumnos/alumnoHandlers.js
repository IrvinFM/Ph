document.addEventListener('click', async (e) => {
    if (e.target && e.target.id === 'btnNuevoAlumno') {
        const { value: formValues, isConfirmed } = await Swal.fire({
            title: 'Nuevo Alumno',
            html: `
                <input id="swal-nombre" class="swal2-input" placeholder="Nombre">
                <input id="swal-apellidoP" class="swal2-input" placeholder="Apellido Paterno">
                <input id="swal-apellidoM" class="swal2-input" placeholder="Apellido Materno">
                <input id="swal-email" class="swal2-input" placeholder="Email">
                <input id="swal-password" class="swal2-input" placeholder="Contraseña">
            `,
            focusConfirm: false,
            confirmButtonText: 'Agregar',
            showCancelButton: true,
            preConfirm: () => {
                return {
                    nombreUsuario: document.getElementById('swal-nombre').value.trim(),
                    aplIPatUsuario: document.getElementById('swal-apellidoP').value.trim(),
                    apllMatUsuario: document.getElementById('swal-apellidoM').value.trim(),
                    email: document.getElementById('swal-email').value.trim(),
                    password: document.getElementById('swal-password').value.trim()
                };
            }
        });

        if (isConfirmed && formValues) {
            try {
                const res = await fetch('../../includes/alumnosController.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams(formValues)
                });

                const result = await res.json();
                if (!res.ok) throw new Error(result.message || 'Error al agregar alumno');

                Swal.fire('¡Agregado!', result.message, 'success');
                cargarAlumnos();
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    }

    if (e.target && e.target.classList.contains('delete-alumno-btn')) {
        const id = e.target.dataset.id;

        const confirm = await Swal.fire({
            title: '¿Eliminar alumno?',
            text: `Esta acción no se puede deshacer.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (confirm.isConfirmed) {
            try {
                const res = await fetch('../../includes/alumnosController.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ idUsuario: id })
                });
                const result = await res.json();
                if (!res.ok) throw new Error(result.message);

                Swal.fire('¡Eliminado!', result.message, 'success');
                cargarAlumnos();
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    }
});
