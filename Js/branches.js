document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("a[data-section]").forEach(link => {
        link.addEventListener("click", async (e) => {
            e.preventDefault();
            const section = link.dataset.section;
            const banner = document.getElementById('welcome-banner');
            if (banner) banner.style.display = 'none';

            try {
                
                if (section === "alumnos") {
                    await recargarAlumnos(); 
                    return;
                } 
                if (section === "profesor") {
                    await recargarProfesor(); 
                    return;
                } 
                
                const response = await fetch(`../includes/${section}-content.php`);
                if (!response.ok) throw new Error('Error al cargar sección');

                const html = await response.text();
                document.getElementById("main-content").innerHTML = html;

            } catch (err) {
                console.error(err);
                document.getElementById("main-content").innerHTML = `
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                        Error al cargar la sección "${section}". 
                    </div>
                `;
            }
        });
    });
});
