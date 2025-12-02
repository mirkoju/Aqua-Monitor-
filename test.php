<?php
include "con_db.php";

$sql = "SELECT * FROM historial_agua LIMIT 10";
$res = mysqli_query($conex, $sql);

$data = [];

while ($row = mysqli_fetch_assoc($res)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT);
