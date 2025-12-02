<?php
header('Content-Type: application/json; charset=utf-8');

include 'con_db.php';
$conn = $conex;

if (!$conn) {
    die(json_encode(['error' => 'Conexión a BD fallida']));
}

$sql = "SELECT id, tanque_id, tanque, porcentaje, estado, fecha FROM alertas_llenado ORDER BY fecha DESC LIMIT 50";
$result = $conn->query($sql);

$alertas = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $alertas[] = $row;
    }
}

echo json_encode($alertas);

$conn->close();
?>
