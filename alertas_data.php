<?php
include 'con_db.php';

// Evitar caché intermedio y del navegador
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Devolver todas las alertas pendientes (no leídas) con porcentaje < 25, más recientes primero
$query = "SELECT * FROM alertas_llenado WHERE estado = 'no leida' AND porcentaje < 25 ORDER BY fecha DESC";
$result = mysqli_query($conex, $query);

$alertas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $alertas[] = $row;
}

echo json_encode($alertas);
