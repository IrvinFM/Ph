<?php
header('Content-Type: application/json');
require_once '../Config/database.php';
session_start();

$method = $_SERVER['REQUEST_METHOD'];

try {
    $pdo = Database::connect();

    switch ($method) {
        case 'PUT':
            parse_str(file_get_contents("php://input"), $params);

            $id = $params['idSede'] ?? null;
            $nombre = $params['nombreSede'] ?? null;
            $direccion = $params['direccionSede'] ?? null;
            $telefono = $params['telefonoSede'] ?? null;
            $email = $params['emailSede'] ?? null;

            if (!$id || !$nombre || !$direccion || !$email) {
                http_response_code(400);
                echo json_encode(['message' => 'Datos incompletos']);
                exit;
            }

            $stmt = $pdo->prepare("
                UPDATE dbo.Sedes 
                SET nombreSede = ?, direccionSede = ?, telefonoSede = ?, emailSede = ?, updatedAt = GETDATE()
                WHERE idSede = ?
            ");
            $stmt->execute([$nombre, $direccion, $telefono, $email, $id]);

            echo json_encode(['message' => 'Sede actualizada correctamente']);
            break;

        case 'DELETE':
            parse_str(file_get_contents("php://input"), $params);
            $id = $params['idSede'] ?? null;

            if (!$id) {
                http_response_code(400);
                echo json_encode(['message' => 'ID de sede no proporcionado']);
                exit;
            }

            $stmt = $pdo->prepare("DELETE FROM dbo.Sedes WHERE idSede = ?");
            $stmt->execute([$id]); // <-- este faltaba

            echo json_encode(['message' => 'Sede eliminada correctamente']);
            break;
                case 'POST':
    parse_str(file_get_contents("php://input"), $params);

    $nombre = $params['nombreSede'] ?? null;
    $direccion = $params['direccionSede'] ?? null;
    $telefono = $params['telefonoSede'] ?? null;
    $email = $params['emailSede'] ?? null;

    if (!$nombre || !$direccion || !$telefono || !$email) {
        http_response_code(400);
        echo json_encode(['message' => 'Datos incompletos para nueva sede']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO dbo.Sedes (nombreSede, direccionSede, telefonoSede, emailSede, createdAt, updatedAt) VALUES (?, ?, ?, ?, GETDATE(), GETDATE())");
        $stmt->execute([$nombre, $direccion, $telefono, $email]);
        echo json_encode(['message' => 'Sede agregada correctamente']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['message' => 'Error al agregar sede: ' . $e->getMessage()]);
    }
    break;

        default:
            http_response_code(405);
            echo json_encode(['message' => 'Método no permitido']);
            break;
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['message' => 'Error de base de datos: ' . $e->getMessage()]);
}
