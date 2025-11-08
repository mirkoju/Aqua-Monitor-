<?php
$mysqli = new mysqli("localhost", "root", "", "nusuario");
if ($mysqli->connect_errno) {
    http_response_code(500);
    exit("Error de conexión: " . $mysqli->connect_error);
}

if (isset($_GET['porcentaje'])) {
    $porcentaje = intval($_GET['porcentaje']);
    $tanque_id = 1;
    $stmt = $mysqli->prepare("INSERT INTO tanque_niveles (tanque_id, porcentaje) VALUES (?, ?)");
    if ($stmt) {
        $stmt->bind_param("ii", $tanque_id, $porcentaje);
        if ($stmt->execute()) {
            echo "OK";
        } else {
            echo "Error al guardar: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en prepare: " . $mysqli->error;
    }
} else {
    http_response_code(400);
    echo "Falta porcentaje";
}
?>

