document.addEventListener("click", async (e) => {
  if (e.target && e.target.id === "btnNuevoProf") {

    const sedes = await fetch("../includes/getSedes.php")
      .then(res => res.json())
      .catch(() => []);
    const sedeOptions = sedes.map(s =>
      `<option value="${s.idSede}">${s.nombreSede}</option>`
    ).join("");

   
    const { value: formValues, isConfirmed } = await Swal.fire({
      title: "Agregar Profesor",
      html: `
        <input id="swal-nombre"    class="swal2-input" placeholder="Nombre">
        <input id="swal-paterno"   class="swal2-input" placeholder="Apellido Paterno">
        <input id="swal-materno"   class="swal2-input" placeholder="Apellido Materno">
        <input id="swal-email"     class="swal2-input" placeholder="Email">
        <input id="swal-password"  class="swal2-input" type="password" placeholder="Contraseña">
        <select id="swal-sede"     class="swal2-input">
          <option value="" disabled selected>Selecciona una sede</option>
          ${sedeOptions}
        </select>
      `,
      focusConfirm: false,
      showCancelButton: true,
      confirmButtonText: "Guardar",
      preConfirm: () => {
        const nombre    = document.getElementById("swal-nombre").value.trim();
        const paterno   = document.getElementById("swal-paterno").value.trim();
        const materno   = document.getElementById("swal-materno").value.trim();
        const email     = document.getElementById("swal-email").value.trim();
        const password  = document.getElementById("swal-password").value;
        const idSede    = document.getElementById("swal-sede").value;

        if (!nombre || !paterno || !email || !password || !idSede) {
          Swal.showValidationMessage("Completa todos los campos obligatorios");
          return false;
        }

        return {
          nombreUsuario: nombre,
          apePaterno: paterno,
          apeMaterno: materno,
          email: email,
          password: password,
          idSede: idSede
        };
      }
    });

    if (isConfirmed && formValues) {
      try {
        const res = await fetch("../includes/profesorController.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: new URLSearchParams(formValues)
        });
        const result = await res.json();
        if (res.ok) {
          Swal.fire("¡Agregado!", result.message, "success");
          recargarProfesor();
        } else {
          throw new Error(result.message || "Error al crear Profesor");
        }
      } catch (err) {
        Swal.fire("Error", err.message, "error");
      }
    }
  }
});
