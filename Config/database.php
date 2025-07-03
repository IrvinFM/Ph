<?php
class Database {
    private static $instance = null;
    private $conn;
    
    private function __construct() {
        $serverName = "LAPTOP-3KHFCLBG\\SQLEXP";
        $database = "StratRooms";
        $user = "Irvin";       
        $password = "2208";  // Faltaba el punto y coma aquí
        
        try {
            $this->conn = new PDO(
                "sqlsrv:Server=$serverName;Database=$database", 
                $user,
                $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            error_log("Error de conexión: " . $e->getMessage());
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public static function connect() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->conn;
    }

    public static function secureQuery($sql, $params = []) {
        try {
            $pdo = self::connect();
            $stmt = $pdo->prepare($sql);
            
            foreach ($params as $key => $value) {
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue(is_int($key) ? $key + 1 : $key, $value, $paramType);
            }
            
            $stmt->execute();
            return $stmt;
        } catch(PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            throw new Exception("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }
}
