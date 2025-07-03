<?php
require_once '../Config/authMiddleware.php';
require_once '../Config/database.php';

$db = Database::connect();
$sedes = $db->query("SELECT * FROM Sedes ORDER BY idSede ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Contenido HTML que se cargará dentro de #main-content -->
<h2 class="text-2xl font-bold text-blue-900 mb-6">Gestión de Sedes</h2>
<button id="btnNuevaSede" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4">
    <i class="fas fa-plus mr-2"></i> Nueva Sede
</button>
<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-blue-800 text-white">
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Dirección</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white text-gray-800">
            <?php foreach ($sedes as $sede): ?>
<tr class="border-t">
    <td class="px-4 py-2"><?= $sede['idSede'] ?></td>
    <td class="px-4 py-2"><?= htmlspecialchars($sede['nombreSede']) ?></td>
    <td class="px-4 py-2"><?= htmlspecialchars($sede['direccionSede']) ?></td>
    <td class="px-4 py-2"><?= htmlspecialchars($sede['telefonoSede']) ?></td>
    <td class="px-4 py-2"><?= htmlspecialchars($sede['emailSede']) ?></td>
    <td class="px-6 py-4 flex gap-2">
        <button class="edit-btn bg-blue-400 px-3 py-1 rounded text-white text-sm" data-id="<?= $sede['idSede'] ?>">Editar</button>
    </td>
</tr>
<?php endforeach; ?>

        </tbody>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </table>
</div>
