<?php
header('Content-Type: application/json; charset=utf-8');

include 'con_db.php';
$conn = $conex;

if (!$conn) {
    die(json_encode(['error' => 'Conexión a BD fallida']));
}

// Obtener ID de alerta a eliminar
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo json_encode(['error' => 'ID de alerta inválido']);
    exit;
}

// Eliminar alerta
$sql = "DELETE FROM alertas_llenado WHERE id = $id";

if ($conn->query($sql)) {
    echo json_encode(['success' => true, 'message' => 'Alerta eliminada correctamente']);
} else {
    echo json_encode(['error' => 'Error al eliminar: ' . $conn->error]);
}

$conn->close();
?>
