<?php
require_once 'config/database.php';

try {
    $db = Database::connect();
    $stmt = $db->query("SELECT 1 AS test");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "Conexión exitosa! Resultado: " . $result['test'];
} catch (Exception $e) {
    echo "Error de conexión: " . $e->getMessage();

    // Información adicional para diagnóstico
    echo "<h3>Información del sistema:</h3>";
    echo "PHP Version: " . phpversion() . "<br>";
    echo "Extensiones cargadas: " . implode(", ", get_loaded_extensions());
}
?>
