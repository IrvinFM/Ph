// admin-navigation.js
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("a[data-section]").forEach(link => {
        link.addEventListener("click", async (e) => {
            e.preventDefault();
            const section = link.dataset.section;
 const banner = document.getElementById('welcome-banner');
            if (banner) {
                banner.style.display = 'none';
            }
            try {
                const response = await fetch(`../includes/${section}-content.php`);
                if (!response.ok) throw new Error("No se pudo cargar el contenido");

                const html = await response.text();
                document.getElementById("main-content").innerHTML = html;
            } catch (err) {
                document.getElementById("main-content").innerHTML =
                    `<div class="text-red-600 font-semibold">Error al cargar sección.</div>`;
            }
        });
    });
});
