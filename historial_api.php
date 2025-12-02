<?php
require_once 'con_db.php';
$mysqli = $conex;
if (!$mysqli) {
  http_response_code(500);
  echo json_encode(['error' => 'No se pudo conectar a la base de datos']);
  exit;
}
$result = $mysqli->query("
  SELECT porcentaje, fecha 
  FROM tanque_niveles
  WHERE MOD(SECOND(fecha), 10) = 0
  ORDER BY fecha DESC
  LIMIT 10
");
$labels = [];
$data = [];
while ($row = $result->fetch_assoc()) {
  $labels[] = date("H:i:s", strtotime($row['fecha']));
  $data[] = intval($row['porcentaje']);
}
echo json_encode([
  'labels' => array_reverse($labels),
  'data' => array_reverse($data)
]);
?>
