<?php
$mysqli = new mysqli("localhost", "root", "", "nusuario");
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
