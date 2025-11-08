<?php
include 'con_db.php';

$tanque = 'Tacho 20L';
$porcentaje = 12; // Puedes cambiar este valor para probar
$estado = 'no leida';

$sql = "INSERT INTO alertas_llenado (tanque, porcentaje, estado) VALUES ('$tanque', $porcentaje, '$estado')";
if (mysqli_query($conex, $sql)) {
    echo "Alerta insertada correctamente";
} else {
    echo "Error al insertar alerta: " . mysqli_error($conex);
}
?>
