<?php
include 'con_db.php';

// Consulta para los últimos 5 días agrupados por día
$sql = "SELECT DATE(fecha) as dia, ROUND(AVG(porcentaje)) as promedio FROM historial_agua WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 5 DAY) GROUP BY dia ORDER BY dia ASC";
$result = mysqli_query($conex, $sql);

$labels = [];
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['dia'];
    $data[] = $row['promedio'];
}

header('Content-Type: application/json');
echo json_encode([
    'labels' => $labels,
    'data' => $data
]);
