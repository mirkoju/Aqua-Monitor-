<?php
header('Content-Type: application/json; charset=utf-8');

include 'con_db.php';
$conn = $conex;

if (!$conn) {
    die(json_encode(['error' => 'Conexión a BD fallida']));
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo json_encode(['error' => 'ID de alerta inválido']);
    exit;
}

$sql = "UPDATE alertas_llenado SET estado = 'leida' WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Alerta marcada como leída']);
} else {
    echo json_encode(['error' => 'Error: ' . $conn->error]);
}

$conn->close();
?>
