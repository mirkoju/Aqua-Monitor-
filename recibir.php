<?php
header('Content-Type: text/plain; charset=utf-8');

include 'con_db.php';
$conn = $conex;

if (!$conn || !mysqli_ping($conn)) {
    die("Error: No hay conexión a BD");
}

$alturaSensorLlena = 20.0;
$alturaSensorVacia = 65.0;
$alturaTacho = 45.0;
$volumenTachoLitros = 20.0;
$umbral_alerta = 25.0;

function mantener_limite($conn, $tabla, $limite, $col_fecha = 'fecha') {
    $sql_delete = "DELETE FROM $tabla WHERE id NOT IN (SELECT id FROM (SELECT id FROM $tabla ORDER BY $col_fecha DESC LIMIT $limite) AS temp)";
    $conn->query($sql_delete);
}

$ultimo_path = "ultimo.txt";
$ultimo = array('t1'=>null,'t2'=>null,'t3'=>null,'fecha'=>date('Y-m-d H:i:s'));
if (file_exists($ultimo_path)) {
    $tmp = @json_decode(file_get_contents($ultimo_path), true);
    if (is_array($tmp)) {
        $ultimo = array_merge($ultimo, $tmp);
    }
}

function guardar_ultimo($path, &$ultimo_arr) {
    $ultimo_arr['fecha'] = date('Y-m-d H:i:s');
    file_put_contents($path, json_encode($ultimo_arr));
}

// FUNCIÓN CORREGIDA: Guarda distancia, porcentaje Y litros
function registrar_historial_y_alerta($conn, $tanque_id, $nombre, $distancia, $porcentaje, $litros, $umbral_alerta) {
    $porc_round = round(floatval($porcentaje), 1);
    $dist_round = round(floatval($distancia), 1);
    $lit_round = round(floatval($litros), 2);
    $nombre_esc = $conn->real_escape_string($nombre);
    
    // Insertar en historial_agua CON distancia y litros
    $sql = "INSERT INTO historial_agua (tanque_id, tanque, distancia, porcentaje, litros, estado) 
            VALUES ($tanque_id, '$nombre_esc', $dist_round, $porc_round, $lit_round, 'normal')";
    $conn->query($sql);
    
    // Insertar alerta si está por debajo del umbral
    if ($porc_round < $umbral_alerta) {
        $sql_alerta = "INSERT INTO alertas_llenado (tanque_id, tanque, porcentaje, estado) 
                       VALUES ($tanque_id, '$nombre_esc', $porc_round, 'no leida')";
        $conn->query($sql_alerta);
    }
}

$handled = false;

// PROCESAMIENTO PRINCIPAL
if (isset($_GET['distancia1']) || isset($_GET['distancia']) || isset($_GET['distancia2']) || isset($_GET['distancia3'])) {
    $distancia1 = isset($_GET['distancia1']) ? floatval($_GET['distancia1']) : (isset($_GET['distancia']) ? floatval($_GET['distancia']) : null);
    $llenado1   = isset($_GET['llenado1'])   ? floatval($_GET['llenado1'])   : null;
    $litros1    = isset($_GET['litros1'])    ? floatval($_GET['litros1'])    : null;

    $distancia2 = isset($_GET['distancia2']) ? floatval($_GET['distancia2']) : null;
    $llenado2   = isset($_GET['llenado2'])   ? floatval($_GET['llenado2'])   : null;
    $litros2    = isset($_GET['litros2'])    ? floatval($_GET['litros2'])    : null;

    $distancia3 = isset($_GET['distancia3']) ? floatval($_GET['distancia3']) : null;
    $llenado3   = isset($_GET['llenado3'])   ? floatval($_GET['llenado3'])   : null;
    $litros3    = isset($_GET['litros3'])    ? floatval($_GET['litros3'])    : null;

    // Actualizar archivo último
    if ($distancia1 !== null || $llenado1 !== null || $litros1 !== null) {
        $ultimo['t1'] = array('distancia'=>$distancia1, 'llenado'=>$llenado1, 'litros'=>$litros1);
    }
    if ($distancia2 !== null || $llenado2 !== null || $litros2 !== null) {
        $ultimo['t2'] = array('distancia'=>$distancia2, 'llenado'=>$llenado2, 'litros'=>$litros2);
    }
    if ($distancia3 !== null || $llenado3 !== null || $litros3 !== null) {
        $ultimo['t3'] = array('distancia'=>$distancia3, 'llenado'=>$llenado3, 'litros'=>$litros3);
    }
    
    guardar_ultimo($ultimo_path, $ultimo);

    // Mostrar en pantalla
    $out = "";
    $out .= "T1 Dist: " . ($distancia1 !== null ? round($distancia1,1) . " cm" : "N/A") . " | Llenado: " . ($llenado1 !== null ? round($llenado1,1) . "%" : "N/A") . " | Litros: " . ($litros1 !== null ? round($litros1,1) . " L" : "N/A") . "\n";
    $out .= "T2 Dist: " . ($distancia2 !== null ? round($distancia2,1) . " cm" : "N/A") . " | Llenado: " . ($llenado2 !== null ? round($llenado2,1) . "%" : "N/A") . " | Litros: " . ($litros2 !== null ? round($litros2,1) . " L" : "N/A") . "\n";
    $out .= "T3 Dist: " . ($distancia3 !== null ? round($distancia3,1) . " cm" : "N/A") . " | Llenado: " . ($llenado3 !== null ? round($llenado3,1) . "%" : "N/A") . " | Litros: " . ($litros3 !== null ? round($litros3,1) . " L" : "N/A") . "\n";

    echo $out;

    // Guardar distancia, porcentaje Y litros
    if ($llenado1 !== null) {
        registrar_historial_y_alerta($conn, 1, 'Tacho 20L - 1', $distancia1, $llenado1, $litros1, $umbral_alerta);
    }
    if ($llenado2 !== null) {
        registrar_historial_y_alerta($conn, 2, 'Tacho 20L - 2', $distancia2, $llenado2, $litros2, $umbral_alerta);
    }
    if ($llenado3 !== null) {
        registrar_historial_y_alerta($conn, 3, 'Tacho 20L - 3', $distancia3, $llenado3, $litros3, $umbral_alerta);
    }

    mantener_limite($conn, 'historial_agua', 100);
    mantener_limite($conn, 'alertas_llenado', 50);

    $handled = true;
}

if (!$handled && isset($_GET['sensor'])) {
    $sensorId = intval($_GET['sensor']);
    $dist = isset($_GET['distancia']) ? floatval($_GET['distancia']) : (isset($_GET['distancia' . $sensorId]) ? floatval($_GET['distancia' . $sensorId]) : null);
    $llen = isset($_GET['llenado'])   ? floatval($_GET['llenado'])   : (isset($_GET['llenado' . $sensorId]) ? floatval($_GET['llenado' . $sensorId]) : null);
    $lit  = isset($_GET['litros'])    ? floatval($_GET['litros'])    : (isset($_GET['litros' . $sensorId]) ? floatval($_GET['litros' . $sensorId]) : null);

    if ($sensorId === 3) {
        $ultimo['t3'] = array('distancia'=>$dist, 'llenado'=>$llen, 'litros'=>$lit);
        guardar_ultimo($ultimo_path, $ultimo);

        echo "T1 Dist: " . (isset($ultimo['t1']['distancia']) ? round($ultimo['t1']['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($ultimo['t1']['llenado']) ? round($ultimo['t1']['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($ultimo['t1']['litros']) ? round($ultimo['t1']['litros'],1) . " L" : "N/A") . "\n";
        echo "T2 Dist: " . (isset($ultimo['t2']['distancia']) ? round($ultimo['t2']['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($ultimo['t2']['llenado']) ? round($ultimo['t2']['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($ultimo['t2']['litros']) ? round($ultimo['t2']['litros'],1) . " L" : "N/A") . "\n";
        echo "T3 Dist: " . ($dist !== null ? round($dist,1) . " cm" : "N/A") . " | Llenado: " . ($llen !== null ? round($llen,1) . "%" : "N/A") . " | Litros: " . ($lit !== null ? round($lit,1) . " L" : "N/A") . "\n";

        if ($llen !== null) {
            registrar_historial_y_alerta($conn, 3, 'Tacho 20L - 3', $dist, $llen, $lit, $umbral_alerta);
        }

        mantener_limite($conn, 'historial_agua', 100);
        mantener_limite($conn, 'alertas_llenado', 50);
        $handled = true;
    }
}

if (!$handled && (isset($_GET['distancia3']) || isset($_GET['llenado3']) || isset($_GET['litros3']))) {
    $dist3 = isset($_GET['distancia3']) ? floatval($_GET['distancia3']) : null;
    $llen3 = isset($_GET['llenado3']) ? floatval($_GET['llenado3']) : null;
    $lit3  = isset($_GET['litros3']) ? floatval($_GET['litros3']) : null;

    $ultimo['t3'] = array('distancia'=>$dist3, 'llenado'=>$llen3, 'litros'=>$lit3);
    guardar_ultimo($ultimo_path, $ultimo);

    echo "T1 Dist: " . (isset($ultimo['t1']['distancia']) ? round($ultimo['t1']['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($ultimo['t1']['llenado']) ? round($ultimo['t1']['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($ultimo['t1']['litros']) ? round($ultimo['t1']['litros'],1) . " L" : "N/A") . "\n";
    echo "T2 Dist: " . (isset($ultimo['t2']['distancia']) ? round($ultimo['t2']['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($ultimo['t2']['llenado']) ? round($ultimo['t2']['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($ultimo['t2']['litros']) ? round($ultimo['t2']['litros'],1) . " L" : "N/A") . "\n";
    echo "T3 Dist: " . ($dist3 !== null ? round($dist3,1) . " cm" : "N/A") . " | Llenado: " . ($llen3 !== null ? round($llen3,1) . "%" : "N/A") . " | Litros: " . ($lit3 !== null ? round($lit3,1) . " L" : "N/A") . "\n";

    if ($llen3 !== null) {
        registrar_historial_y_alerta($conn, 3, 'Tacho 20L - 3', $dist3, $llen3, $lit3, $umbral_alerta);
    }

    mantener_limite($conn, 'historial_agua', 100);
    mantener_limite($conn, 'alertas_llenado', 50);
    $handled = true;
}

if (!$handled) {
    if (file_exists($ultimo_path)) {
        $json = file_get_contents($ultimo_path);
        $data = json_decode($json, true);
        if (is_array($data) && (isset($data['t1']) || isset($data['t2']) || isset($data['t3']))) {
            $t1 = isset($data['t1']) ? $data['t1'] : null;
            $t2 = isset($data['t2']) ? $data['t2'] : null;
            $t3 = isset($data['t3']) ? $data['t3'] : null;
            echo "T1 Dist: " . (isset($t1['distancia']) ? round($t1['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($t1['llenado']) ? round($t1['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($t1['litros']) ? round($t1['litros'],1) . " L" : "N/A") . "\n";
            echo "T2 Dist: " . (isset($t2['distancia']) ? round($t2['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($t2['llenado']) ? round($t2['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($t2['litros']) ? round($t2['litros'],1) . " L" : "N/A") . "\n";
            echo "T3 Dist: " . (isset($t3['distancia']) ? round($t3['distancia'],1) . " cm" : "N/A") . " | Llenado: " . (isset($t3['llenado']) ? round($t3['llenado'],1) . "%" : "N/A") . " | Litros: " . (isset($t3['litros']) ? round($t3['litros'],1) . " L" : "N/A") . "\n";
        } else {
            echo "No hay datos válidos en ultimo.txt";
        }
    } else {
        echo "No se recibió ninguna distancia aún";
    }
}

$conn->close();
?>