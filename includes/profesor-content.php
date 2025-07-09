<?php
require_once '../Config/database.php';
$db = Database::connect();

$sql = "
    SELECT u.idUsuario, u.nombreUsuario, u.apePaterno, u.apeMaterno, u.email, s.nombreSede, u.idSede
    FROM dbo.Usuarios u
    LEFT JOIN dbo.Sedes s ON u.idSede = s.idSede
    WHERE u.tipoUsuario = 'profesor'
    ORDER BY u.idUsuario ASC
";

$profesor = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    
    .tabla-Prof thead {
        background-color:rgb(27, 4, 163); 
    }
    
    .tabla-Prof th {
        border: 1px solid #d1d5db;
        padding: 0.75rem 1rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: white;
        white-space: nowrap;
        vertical-align: middle;
    text-align: left;
    }
    
      .tabla-Prof {
        width: 100%;
        border-collapse: collapse;
    }

    .tabla-Prof td {
        border: 1px solid #d1d5db;
        padding: 1rem;
        font-size: 0.875rem;
        color: #111827;
        white-space: nowrap;
        vertical-align: middle;
    text-align: left;
    
    }
        .tabla-Prof tbody tr:hover {
        background-color:rgba(96, 96, 97, 0.44); 
    }
   
</style>

<body>
    

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-blue-900">Gestión de Profesores</h2>
        <button id="btnNuevoProf" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Nuevo Profesor
        </button>
    </div>

    <table id="tablaProf" class="tabla-Prof">
        <thead>
            <tr>
                <th class="px-4">Sede</th>
                <th class="px-4">Nombre</th>
                <th class="px-4">Apellido Paterno</th>
                <th class="px-4">Apellido Materno</th>
                <th class="px-6">Email</th>
                <th class="px-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($profesor as $profe): ?>
                <tr>
                    <td><?= htmlspecialchars($profe['nombreSede'] ?? 'Sin sede') ?></td>
                    <td><?= htmlspecialchars($profe['nombreUsuario']?? '') ?></td>
                    <td><?= htmlspecialchars($profe['apePaterno']?? '') ?></td>
                    <td><?= htmlspecialchars($profe['apeMaterno']?? '') ?></td>
                    <td><?= htmlspecialchars($profe['email']?? '') ?></td>
                    <td class="acciones-cell">
                    <div>
                        <button class="edit-prof-btn px-2 py-1 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                            data-id="<?= $profe['idUsuario'] ?>"
                            data-nombre="<?= htmlspecialchars($profe['nombreUsuario']?? '') ?>"
                            data-paterno="<?= htmlspecialchars($profe['apePaterno']?? '') ?>"
                            data-materno="<?= htmlspecialchars($profe['apeMaterno']?? '') ?>"
                            data-email="<?= htmlspecialchars($profe['email']?? '') ?>"
                            data-idsede="<?= $profe['idSede'] ?? '' ?>">
                        <img src="../image/icons/user-edit.svg"  class="w-4 h-4 mr-1 inline filter brightness-0 invert">           
                        </button>
                    </div>
                    <div>
                        <button class="delete-prof-btn px-2 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors" 
                            data-id="<?= $profe['idUsuario'] ?>">
                            <img src="../image/icons/trash.svg" class="w-4 h-4 mr-1 inline filter brightness-0 invert"> 
                        </button>
                    </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 

</body>