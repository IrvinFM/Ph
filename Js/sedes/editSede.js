document.addEventListener('click', async (e) => {
    if (e.target.classList.contains('edit-btn')) {
        const id = e.target.getAttribute('data-id');
        const fila = e.target.closest('tr');

        const nombreActual = fila.children[1].textContent.trim();
        const direccionActual = fila.children[2].textContent.trim();
        const telefonoActual = fila.children[3].textContent.trim(); 
        const emailActual = fila.children[4].textContent.trim();

        const { value: formValues, isConfirmed, isDismissed, dismiss } = await Swal.fire({
            title: `Editar: <span class="text-blue-600">${nombreActual}</span>`,
            html: `
                <div class="space-y-4 mt-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="swal-nombre">Nombre</label>
                        <input id="swal-nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Nombre" value="${nombreActual}">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="swal-direccion">Dirección</label>
                        <input id="swal-direccion" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Dirección" value="${direccionActual}">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="swal-telefono">Teléfono</label>
                        <input id="swal-telefono" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Teléfono" value="${telefonoActual}">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1" for="swal-email">Email</label>
                        <input id="swal-email" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Email" value="${emailActual}">
                    </div>
                </div>
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-save mr-2"></i> Guardar',
            cancelButtonText: '<i class="fas fa-trash mr-2"></i> Eliminar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            buttonsStyling: true,
            showCloseButton: true,
            backdrop: true,
            width: '600px',
            customClass: {
                popup: 'rounded-lg shadow-xl',
                title: 'text-2xl font-semibold',
                confirmButton: 'px-4 py-2 rounded',
                cancelButton: 'px-4 py-2 rounded'
            },
            preConfirm: () => {
                return {
                    nombreSede: document.getElementById('swal-nombre').value.trim(),
                    direccionSede: document.getElementById('swal-direccion').value.trim(),
                    telefonoSede: document.getElementById('swal-telefono').value.trim(),
                    emailSede: document.getElementById('swal-email').value.trim()
                };
            }
        });

        // Acción Guardar (PUT)
if (isConfirmed && formValues) {
    try {
        const res = await fetch('../includes/sedesController.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ idSede: id, ...formValues })
        });

        const responseText = await res.text();

        let result;
        try {
            result = JSON.parse(responseText);
        } catch (parseError) {
            throw new Error('La respuesta del servidor no es JSON válido.');
        }

        if (!res.ok) {
            Swal.fire({
                title: 'Error',
                text: result.message || 'Error desconocido al actualizar sede.',
                icon: 'error',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
            return;
        }

        
        await Swal.fire({
            title: '¡Actualizado!',
            text: result.message,
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });

        cargarSedes(); 

    } catch (error) {
        Swal.fire({
            title: 'Error',
            text: error.message || 'Hubo un problema al actualizar la sede',
            icon: 'error',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    }
}

        // Acción Eliminar (DELETE)
        if (isDismissed && dismiss === Swal.DismissReason.cancel) {
            const confirmDelete = await Swal.fire({
                title: '¿Eliminar sede?',
                text: `¿Estás seguro de eliminar la sede "${nombreActual}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="fas fa-trash mr-2"></i> Sí, eliminar',
                cancelButtonText: '<i class="fas fa-times mr-2"></i> Cancelar',
                reverseButtons: true
            });

            if (confirmDelete.isConfirmed) {
                try {
                    const res = await fetch('../includes/sedesController.php', {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: new URLSearchParams({ idSede: id })
                    });
                    const result = await res.json();

                    await Swal.fire({
                        title: '¡Eliminado!',
                        text: result.message,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });

                    cargarSedes(); // Actualizar tabla después de eliminar

                } catch (error) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al eliminar la sede',
                        icon: 'error',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            }
        }
    }
});
