// nuevoAlumno.js

document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("btnNuevoAlumno")?.addEventListener("click", async () => {
    const sedeOptions = sedes.map(sede =>
      `<option value="${sede.idSede}">${sede.nombreSede}</option>`
    ).join('');

    const { value: formValues, isConfirmed } = await Swal.fire({
      title: "Nuevo Alumno",
      html: `
        <input id="nombre" class="swal2-input" placeholder="Nombre">
        <input id="paterno" class="swal2-input" placeholder="Apellido Paterno">
        <input id="materno" class="swal2-input" placeholder="Apellido Materno">
        <input id="email" class="swal2-input" placeholder="Email">
        <input id="password" type="password" class="swal2-input" placeholder="Contraseña">
        <select id="idSede" class="swal2-select">${sedeOptions}</select>
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: "Guardar",
      preConfirm: () => {
        return {
          nombreUsuario: document.getElementById("nombre").value.trim(),
          apePaterno: document.getElementById("paterno").value.trim(),
          apeMaterno: document.getElementById("materno").value.trim(),
          email: document.getElementById("email").value.trim(),
          password: document.getElementById("password").value,
          idSede: document.getElementById("idSede").value
        };
      }
    });

    if (isConfirmed && formValues) {
      try {
        const res = await fetch('../includes/alumnosController.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: new URLSearchParams(formValues)
        });

        const data = await res.json();
        if (res.ok) {
          Swal.fire('Alumno creado', data.message, 'success');
          cargarAlumnos();
        } else {
          throw new Error(data.message || 'Error al crear alumno');
        }
      } catch (err) {
        Swal.fire('Error', err.message, 'error');
      }
    }
  });
});
