<?php
include 'con_db.php';

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $query = "DELETE FROM alertas_llenado WHERE id = $id";
    $result = mysqli_query($conex, $query);
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conex)]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID no proporcionado']);
}
?>
