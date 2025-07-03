document.addEventListener("DOMContentLoaded", () => {
    const tabla = document.querySelector("#tablaAlumnos");
    if (tabla) {
        new DataTable(tabla, {
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-MX.json"
            },
            pageLength: 10
        });
    }
});
