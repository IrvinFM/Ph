<?php
header('Content-Type: application/json');

// Configuración de CORS para desarrollo
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Manejar preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once 'database.php';

try {
    // Verificar método HTTP
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        exit;
    }

    // Obtener datos del formulario
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rememberMe = isset($_POST['remember-me']);

    // Validar campos
    if (empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Email y contraseña son requeridos']);
        exit;
    }

    $db = Database::connect();

    // Consulta segura
    $stmt = Database::secureQuery(
        "SELECT idUsuario, nombreUsuario, password, tipoUsuario FROM Usuarios WHERE email = :email",
        [':email' => $email]
    );

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
        exit;
    }

    // Verificar contraseña en texto plano (solo para pruebas)
    if ($password !== $user['password']) {
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
        exit;
    }

    // Iniciar sesión
    session_start();
    $_SESSION['user'] = [
        'id' => $user['idUsuario'],
        'name' => $user['nombreUsuario'],
        'type' => $user['tipoUsuario']
    ];

    // Recordar usuario
    if ($rememberMe) {
        $token = bin2hex(random_bytes(32));
        setcookie('remember_token', $token, time() + 86400 * 30, '/', '', false, true);
        
        Database::secureQuery(
            "UPDATE Usuarios SET remember_token = :token WHERE idUsuario = :id",
            [':token' => $token, ':id' => $user['idUsuario']]
        );
    }

    // Respuesta exitosa
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'userType' => $user['tipoUsuario'],
        'message' => 'Inicio de sesión exitoso'
    ]);

} catch (PDOException $e) {
    error_log("Error de base de datos: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error en el servidor']);
} catch (Exception $e) {
    error_log("Error general: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
