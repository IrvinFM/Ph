document.addEventListener('click', async (e) => {
    // Editar alumno
    if (e.target.classList.contains('edit-alumno-btn')) {
        const btn = e.target.closest('button');
        const id = btn.dataset.id;
        const nombre = btn.dataset.nombre;
        const paterno = btn.dataset.paterno;
        const materno = btn.dataset.materno;
        const email = btn.dataset.email;
        const idSede = btn.dataset.sede;

        // Cargar las sedes desde el servidor
        const sedes = await fetch('../includes/getSedes.php')
            .then(res => res.json())
            .catch(() => []);

        // Crear las opciones del select
        const sedeOptions = sedes.map(sede =>
            `<option value="${sede.idSede}" ${sede.idSede == idSede ? 'selected' : ''}>${sede.nombreSede}</option>`
        ).join('');

        const { value: formValues, isConfirmed } = await Swal.fire({
            title: 'Editar Alumno',
            html: `
                <input id="nombre" class="swal2-input" placeholder="Nombre" value="${nombre}">
                <input id="paterno" class="swal2-input" placeholder="Apellido Paterno" value="${paterno}">
                <input id="materno" class="swal2-input" placeholder="Apellido Materno" value="${materno}">
                <input id="email" class="swal2-input" placeholder="Email" value="${email}">
                <input id="password" type="password" class="swal2-input" placeholder="Nueva contraseña (opcional)">
                <select id="idSede" class="swal2-input">${sedeOptions}</select>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            preConfirm: () => {
                return {
                    idUsuario: id,
                    nombreUsuario: document.getElementById('nombre').value.trim(),
                    apePaterno: document.getElementById('paterno').value.trim(),
                    apeMaterno: document.getElementById('materno').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    password: document.getElementById('password').value.trim(),
                    idSede: document.getElementById('idSede').value
                };
            }
        });

        if (isConfirmed && formValues) {
            try {
                const res = await fetch('../includes/alumnosController.php', {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams(formValues)
                });

                const data = await res.json();
                if (res.ok) {
                    Swal.fire('¡Actualizado!', data.message, 'success');
                    cargarAlumnos(); // Recargar tabla
                } else {
                    throw new Error(data.message || 'Error al actualizar');
                }
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    }

    // Eliminar alumno
    if (e.target.classList.contains('delete-alumno-btn')) {
        const id = e.target.dataset.id;

        const confirmDelete = await Swal.fire({
            title: '¿Eliminar Alumno?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (confirmDelete.isConfirmed) {
            try {
                const res = await fetch('../includes/alumnosController.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ idUsuario: id })
                });

                const data = await res.json();
                if (res.ok) {
                    Swal.fire('¡Eliminado!', data.message, 'success');
                    cargarAlumnos(); // Recargar tabla
                } else {
                    throw new Error(data.message || 'Error al eliminar');
                }
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    }
});
