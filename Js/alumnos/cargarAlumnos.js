function inicializarTablaAlumnos() {
    const tabla = document.getElementById("tablaAlumnos");
    if (tabla) {
        if ($.fn.DataTable.isDataTable(tabla)) {
            $(tabla).DataTable().destroy();
            $(tabla).removeAttr('style');

        }

        $(tabla).DataTable({
            language: {
                url: "../Config/es-MX.json"
            },
            responsive: true,
            scrollX: true,
            autoWidth: false,
            pageLength: 10,
            dom: '<"top"lf>rt<"bottom"ip>'
        });
    }
}

async function recargarAlumnos() {
    const mainContent = document.getElementById("main-content");

    try {
        const response = await fetch('../includes/alumnos-content.php');
        if (!response.ok) throw new Error('Error al cargar alumnos');
        const html = await response.text();

        mainContent.innerHTML = html;
        inicializarTablaAlumnos(); 
    } catch (error) {
        console.error('Error:', error);
        mainContent.innerHTML = `
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                Error al cargar la tabla de alumnos.
                <button onclick="recargarAlumnos()" class="font-medium text-red-600 hover:underline">Reintentar</button>
            </div>
        `;
    }
}
