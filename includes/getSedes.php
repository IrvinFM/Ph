<?php
require_once '../Config/database.php';
$db = Database::connect();

$sedes = $db->query("SELECT idSede, nombreSede FROM dbo.Sedes ORDER BY nombreSede")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($sedes);
?>