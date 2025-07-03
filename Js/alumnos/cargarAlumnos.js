async function cargarAlumnos() {
    try {
        const response = await fetch('../includes/alumnos-content.php');
        const html = await response.text();
        document.getElementById("main-content").innerHTML = html;
    } catch (err) {
        console.error("Error:", err);
        document.getElementById("main-content").innerHTML = 
            `<div class="text-red-600 font-semibold">Error al cargar alumnos.</div>`;
    }
}
