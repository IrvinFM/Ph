<?php
session_start();
$nombre = $_SESSION['user']['name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StartroomsDashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="icon" href="../image/favicon.ico" type="image/x-icon">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        .welcome-banner {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .logo-text {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Barra lateral -->
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
        <div class="flex items-center justify-center h-16 px-4 border-b">
            <img src="../image/favicon.ico" alt="Logo" class="h-8 w-12 mr-2">
            <h1 class="text-xl font-bold text-blue-900">Stratrooms</h1>
        </div>
        <nav class="p-4">
            <div class="space-y-1">
                
                <a href="#" data-section="alumnos" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                 <i class="fas fa-user-graduate mr-3"></i>Alumnos
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-book mr-3"></i>Materias
                </a>
                <a href="#" data-section="sedes" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                <img src="../image/icons/branch.svg" alt="Ícono de Sedes" class="mr-3" style="width: 1.25em; height: 1.25em;">Sedes
                </a>
                 <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-calendar-alt mr-3"></i>Profesores
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-calendar-alt mr-3"></i>Grupos
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-calendar-alt mr-3"></i>Administradores
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                    <i class="fas fa-cog mr-3"></i> Configuración
                </a>
            </div>
        </nav>
        <div class="absolute bottom-0 w-full p-4 border-t">
            <a href="#" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 rounded-md hover:bg-blue-50 hover:text-blue-600">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Cerrar sesión
            </a>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="ml-64">
        <!-- Barra superior -->
        <header class="bg-white shadow-sm">
            <div class="flex items-center justify-between px-8 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Panel de Administración</h2>
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-500 rounded-full hover:bg-gray-100">
                        <i class="fas fa-bell"></i>
                    </button>
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/40" alt="User" class="h-8 w-8 rounded-full">
                        <span class="ml-2 text-sm font-medium text-gray-700">
                        <?php echo htmlspecialchars($nombre); ?>
                        </span>

                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido dinámico -->
        <main class="p-8">
            <div class="welcome-banner rounded-xl p-8 text-white mb-8" id="welcome-banner">
                <h1 class="text-4xl font-bold mb-2 logo-text">Welcome Admin</h1>
                <p class="text-xl opacity-90">meet Stratrooms</p>
            </div>
            <div id="main-content" class="mt-6">
                
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../Js/branches.js"></script>
    <script src="../Js/sedes/editSede.js"></script>
    <script src="../Js/sedes/cargarSedes.js"></script>
    <script src="../Js/sedes/nuevasede.js"></script>

    <script src="../Js/alumnos/alumnoHandlers.js"></script>
    <script src="../Js/alumnos/cargarAlumnos.js"></script>
    <script src="../Js/alumnos/editAlumno.js"></script>
    <script src="../Js/alumnos/nuevoalumno.js"></script>
    <script src="../Js/alumnos/alumnoTable.js"></script>
    

</body>
</html>
