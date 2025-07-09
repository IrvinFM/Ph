document.addEventListener('click', async (e) => {
    // EDITAR
    const btnEdit = e.target.closest('.edit-prof-btn');
    if (btnEdit) {
        const id = btnEdit.dataset.id;
        const nombre = btnEdit.dataset.nombre;
        const paterno = btnEdit.dataset.paterno;
        const materno = btnEdit.dataset.materno;
        const email = btnEdit.dataset.email;
        const idSede = btnEdit.dataset.sede;

        const sedes = await fetch('../includes/getSedes.php')
            .then(res => res.json())
            .catch(() => []);

        const sedeOptions = sedes.map(sede =>
            `<option value="${sede.idSede}" ${sede.idSede == idSede ? 'selected' : ''}>${sede.nombreSede}</option>`
        ).join('');

        const { value: formValues, isConfirmed } = await Swal.fire({
            title: 'Editar Profesor',
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
                const res = await fetch('../includes/profesorController.php', {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams(formValues)
                });

                const data = await res.json();
                if (res.ok) {
                    Swal.fire('¡Actualizado!', data.message, 'success');
                    recargarProfesor();
                } else {
                    throw new Error(data.message || 'Error al actualizar');
                }
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    }

    // ELIMINAR
    const btnDelete = e.target.closest('.delete-prof-btn');
    if (btnDelete) {
        const id = btnDelete.dataset.id;

        const confirmDelete = await Swal.fire({
            title: '¿Eliminar Profesor?',
            text: 'Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        });

        if (confirmDelete.isConfirmed) {
            try {
                const res = await fetch('../includes/profesorController.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ idUsuario: id })
                });

                const data = await res.json();
                if (res.ok) {
                    Swal.fire('¡Eliminado!', data.message, 'success');
                    recargarProfesor(); // Recarga tabla actualizada
                } else {
                    throw new Error(data.message || 'Error al eliminar');
                }
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        }
    }
});
