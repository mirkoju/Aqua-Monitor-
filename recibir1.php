<?php
header('Content-Type: text/plain; charset=utf-8');
header('Refresh: 5');
// Usar conexión centralizada (con_db.php)
require_once 'con_db.php';
$conn = $conex; // alias para mantener compatibilidad con el resto del archivo
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Parámetros del tacho (igual que en el microcontrolador)
$alturaSensorLlena = 20.0;
$alturaSensorVacia = 65.0;
$alturaTacho = 45.0;
$volumenTachoLitros = 20.0;
$umbral_alerta = 25.0; // porcentaje

// Función auxiliar para eliminar filas antiguas (historial y alertas)
function mantener_limite($conn, $tabla, $limite, $col_fecha = 'fecha') {
    $sql_delete = "DELETE FROM $tabla WHERE id NOT IN (SELECT id FROM (SELECT id FROM $tabla ORDER BY $col_fecha DESC LIMIT $limite) AS temp)";
    $conn->query($sql_delete);
}

// Procesar cuando Arduino envía ambos tanques
if (isset($_GET['distancia1']) || isset($_GET['distancia'])) {
    // Aceptar ambas formas: (distancia1...) o la antigua distancia (para compatibilidad)
    $distancia1 = isset($_GET['distancia1']) ? floatval($_GET['distancia1']) : (isset($_GET['distancia']) ? floatval($_GET['distancia']) : null);
    $llenado1   = isset($_GET['llenado1'])   ? floatval($_GET['llenado1'])   : null;
    $litros1    = isset($_GET['litros1'])    ? floatval($_GET['litros1'])    : null;

    $distancia2 = isset($_GET['distancia2']) ? floatval($_GET['distancia2']) : null;
    $llenado2   = isset($_GET['llenado2'])   ? floatval($_GET['llenado2'])   : null;
    $litros2    = isset($_GET['litros2'])    ? floatval($_GET['litros2'])    : null;

    // Guardar último estado en formato JSON
    $ultimo = array(
        't1' => array('distancia' => $distancia1, 'llenado' => $llenado1, 'litros' => $litros1),
        't2' => array('distancia' => $distancia2, 'llenado' => $llenado2, 'litros' => $litros2),
        'fecha' => date('Y-m-d H:i:s')
    );
    file_put_contents("ultimo.txt", json_encode($ultimo));

    // Mostrar resultado al cliente
    $out = "";
    $out .= "T1 Dist: " . ($distancia1 !== null ? round($distancia1,1) . " cm" : "N/A") . " | Llenado: " . ($llenado1 !== null ? round($llenado1,1) . "%" : "N/A") . " | Litros: " . ($litros1 !== null ? round($litros1,1) . " L" : "N/A") . "\n";
    $out .= "T2 Dist: " . ($distancia2 !== null ? round($distancia2,1) . " cm" : "N/A") . " | Llenado: " . ($llenado2 !== null ? round($llenado2,1) . "%" : "N/A") . " | Litros: " . ($litros2 !== null ? round($litros2,1) . " L" : "N/A") . "\n";

    echo $out;

    // Guardar en la base de datos historial para ambos tanques si vienen valores
    if ($llenado1 !== null) {
        $sql1 = "INSERT INTO historial_agua (tanque_id, tanque, porcentaje, estado) VALUES (1, 'Tacho 20L - 1', " . round($llenado1,1) . ", 'normal')";
        $conn->query($sql1);
        if ($llenado1 < $umbral_alerta) {
            // { changed code }
            enviar_alerta($conn, 'Tacho 20L - 1', $llenado1);
        }
    }
    if ($llenado2 !== null) {
        $sql2 = "INSERT INTO historial_agua (tanque_id, tanque, porcentaje, estado) VALUES (2, 'Tacho 20L - 2', " . round($llenado2,1) . ", 'normal')";
        $conn->query($sql2);
        if ($llenado2 < $umbral_alerta) {
            // { changed code }
            enviar_alerta($conn, 'Tacho 20L - 2', $llenado2);
        }
    }

    // Mantener solo las filas más recientes
    mantener_limite($conn, 'historial_agua', 25);
    mantener_limite($conn, 'alertas_llenado', 50);

} else {
    // Si no se reciben parámetros, intentar leer ultimo.txt y mostrarlo
    if (file_exists("ultimo.txt")) {
        $json = file_get_contents("ultimo.txt");
        // Intentar decodificar JSON primero
        $data = json_decode($json, true);

        if (is_array($data) && isset($data['t1']) && isset($data['t2'])) {
            $t1 = $data['t1'];
            $t2 = $data['t2'];
            echo "T1 Dist: " . (isset($t1['distancia']) ? round($t1['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($t1['llenado']) ? round($t1['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($t1['litros']) ? round($t1['litros'],1) . " L" : "N/A") . "\n";
            echo "T2 Dist: " . (isset($t2['distancia']) ? round($t2['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($t2['llenado']) ? round($t2['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($t2['litros']) ? round($t2['litros'],1) . " L" : "N/A") . "\n";

        } elseif (is_numeric($data) || is_numeric($json)) {
            // Formato antiguo: ultimo.txt contiene solo un número (distancia)
            $val = is_numeric($json) ? floatval($json) : floatval($data);
            // Calcular porcentaje y litros usando los parámetros definidos arriba
            $dist = $val;
            if ($dist <= $alturaSensorLlena) {
                $porcentaje = 100.0;
                $litros = $volumenTachoLitros;
            } elseif ($dist >= $alturaSensorVacia) {
                $porcentaje = 0.0;
                $litros = 0.0;
            } else {
                $alturaAgua = $dist - $alturaSensorLlena;
                $porcentaje = 100.0 - (($alturaAgua / $alturaTacho) * 100.0);
                if ($porcentaje < 0.0) $porcentaje = 0.0;
                if ($porcentaje > 100.0) $porcentaje = 100.0;
                $litros = ($porcentaje / 100.0) * $volumenTachoLitros;
            }
            echo "T1 Dist: " . round($dist,1) . " cm | Llenado: " . round($porcentaje,1) . "% | Litros: " . round($litros,1) . " L\n";
            echo "T2 Dist: N/A | Llenado: N/A | Litros: N/A\n";

        } else {
            echo "No hay datos válidos en ultimo.txt";
        }
    } else {
        echo "No se recibió ninguna distancia aún";
    }
}

$conn->close();
?>