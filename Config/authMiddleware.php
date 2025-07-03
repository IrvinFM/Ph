<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user'])) {
    header('Location: ../login.html');
    exit;
}

// Verifica si es administrador
if ($_SESSION['user']['type'] !== 'ADMINISTRADOR') {
    echo "<h2 style='color:red;'>Acceso denegado. Solo los administradores pueden ver esta página.</h2>";
    exit;
}
