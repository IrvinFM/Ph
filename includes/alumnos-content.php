<?php
require_once '../Config/database.php';
$db = Database::connect();

$sql = "
    SELECT u.idUsuario, u.nombreUsuario, u.apePaterno, u.apeMaterno, u.email, s.nombreSede
    FROM dbo.Usuarios u
    LEFT JOIN dbo.Sedes s ON u.idSede = s.idSede
    WHERE u.tipoUsuario = 'alumno'
    ORDER BY u.idUsuario ASC
";

$alumnos = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<h2 class="text-2xl font-bold text-blue-900 mb-6">Gestión de Alumnos</h2>

<div class="mb-4">
    <button id="btnNuevoAlumno" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Nuevo Alumno
    </button>
</div>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Sede</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Email</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
                <tr>
                    <td><?= htmlspecialchars($alumno['nombreSede'] ?? 'Sin sede') ?></td>
                    <td><?= htmlspecialchars($alumno['nombreUsuario']) ?></td>
                    <td><?= htmlspecialchars($alumno['apePaterno']) ?></td>
                    <td><?= htmlspecialchars($alumno['apeMaterno']) ?></td>
                    <td><?= htmlspecialchars($alumno['email']) ?></td>
                    <td class="text-center">
                       <button 
                         class="edit-alumno-btn bg-blue-600 px-3 py-1 rounded text-white text-sm"
                            data-id="<?= $alumno['idUsuario'] ?>"
                            data-nombre="<?= htmlspecialchars($alumno['nombreUsuario']) ?>"
                         data-paterno="<?= htmlspecialchars($alumno['apePaterno']) ?>"
                         data-materno="<?= htmlspecialchars($alumno['apeMaterno']) ?>"
                         data-email="<?= htmlspecialchars($alumno['email']) ?>"
                         data-idsede="<?= $alumno['idSede'] ?? '' ?>"
>
    Editar
                        </button>

                        <button class="btn btn-danger btn-sm delete-alumno-btn" 
                            data-id="<?= $alumno['idUsuario'] ?>">
                            <i class="fas fa-trash me-1"></i>Eliminar
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
