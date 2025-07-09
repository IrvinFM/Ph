<?php
require_once '../Config/database.php';
header('Content-Type: application/json');

$db = Database::connect();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Crear nuevo Profesor
    $nombre = $_POST['nombreUsuario'] ?? '';
    $apePaterno = $_POST['apePaterno'] ?? '';
    $apeMaterno = $_POST['apeMaterno'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $idSede = $_POST['idSede'] ?? null;

    if (!$nombre || !$apePaterno || !$email || !$password) {
        http_response_code(400);
        echo json_encode(['message' => 'Todos los campos obligatorios deben estar completos']);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $db->prepare("INSERT INTO dbo.Usuarios 
        (tipoUsuario, idSede, nombreUsuario, apePaterno, apeMaterno, email, password, imgUrlUsuario, createdAt, updatedAt)
        VALUES ('PROFESOR', :idSede, :nombre, :apePaterno, :apeMaterno, :email, :password, :img, GETDATE(), GETDATE())");

    $success = $stmt->execute([
        ':idSede' => $idSede,
        ':nombre' => $nombre,
        ':apePaterno' => $apePaterno,
        ':apeMaterno' => $apeMaterno,
        ':email' => $email,
        ':password' => $hashedPassword,
        ':img' => ''
    ]);

    echo json_encode(['message' => $success ? 'Profesor creado correctamente' : 'Error al crear Profesor']);

} elseif ($method === 'PUT') {
    parse_str(file_get_contents("php://input"), $putData);

    $id = $putData['idUsuario'] ?? null;
    $nombre = $putData['nombreUsuario'] ?? '';
    $apePaterno = $putData['apePaterno'] ?? '';
    $apeMaterno = $putData['apeMaterno'] ?? '';
    $email = $putData['email'] ?? '';
    $idSede = $putData['idSede'] ?? null;
    $password = $putData['password'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['message' => 'ID del Profesor requerido']);
        exit;
    }

    $sql = "UPDATE dbo.Usuarios SET nombreUsuario = :nombre, apePaterno = :apePaterno, apeMaterno = :apeMaterno, email = :email, idSede = :idSede";
    $params = [
        ':nombre' => $nombre,
        ':apePaterno' => $apePaterno,
        ':apeMaterno' => $apeMaterno,
        ':email' => $email,
        ':idSede' => $idSede,
        ':id' => $id
    ];

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql .= ", password = :password";
        $params[':password'] = $hashedPassword;
    }

    $sql .= ", updatedAt = GETDATE() WHERE idUsuario = :id";

    $stmt = $db->prepare($sql);
    $success = $stmt->execute($params);

    echo json_encode(['message' => $success ? 'Profesor actualizado correctamente' : 'Error al actualizar Profesor']);

} elseif ($method === 'DELETE') {
    parse_str(file_get_contents("php://input"), $deleteData);
    $id = $deleteData['idUsuario'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(['message' => 'ID del Profesor requerido']);
        exit;
    }

    $stmt = $db->prepare("DELETE FROM dbo.Usuarios WHERE idUsuario = :id");
    $success = $stmt->execute([':id' => $id]);

    echo json_encode(['message' => $success ? 'Profesor eliminado correctamente' : 'Error al eliminar Profesor']);

} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido']);
}
