async function cargarSedes() {
    try {
        const response = await fetch('../includes/sedes-content.php');
        if (!response.ok) throw new Error("Error al cargar sedes");
        
        const html = await response.text();
        document.getElementById("main-content").innerHTML = html;
    } catch (err) {
        console.error("Error:", err);
        document.getElementById("main-content").innerHTML = 
            `<div class="text-red-600 font-semibold">Error al cargar sedes.</div>`;
    }
}