<?php
// helper logging (coincide con los otros archivos)
function log_msg($msg) {
    $dir = __DIR__ . '/logs';
    if (!is_dir($dir)) @mkdir($dir, 0755, true);
    $file = $dir . '/alerts_debug.log';
    $line = date('c') . ' ' . $msg . PHP_EOL;
    @file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}

log_msg("== alertas_data.php invoked ==");

// incluir con_db.php
include 'con_db.php';

// headers
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

if (!isset($conex) || !$conex) {
    $try = @mysqli_connect("192.168.101.93","BG05","St2025#QkcwNQ","bg05");
    if ($try && !mysqli_connect_errno()) {
        $conex = $try;
        log_msg("INFO: fallback mysqli_connect funcionó (192.168.101.93, BG05).");
    } else {
        $err = mysqli_connect_error();
        log_msg("FATAL: no se pudo conectar a BD. " . $err);
        http_response_code(500);
        echo json_encode(['error' => 'DB connection not available', 'detail' => $err]);
        exit;
    }
}

$umbral = 200;
$alertas = [];

// obtener lista de tanques detectados en historial_agua y tanque_niveles
$sqlIds = "
    SELECT DISTINCT tanque_id FROM historial_agua
    UNION
    SELECT DISTINCT tanque_id FROM tanque_niveles
";
$resIds = mysqli_query($conex, $sqlIds);
if ($resIds === false) {
    log_msg("ERROR obtener IDs de tanques: " . mysqli_error($conex));
    http_response_code(500);
    echo json_encode(['error'=>'Failed to list tanks']);
    exit;
}

$ids = [];
while ($r = mysqli_fetch_assoc($resIds)) {
    if (isset($r['tanque_id'])) $ids[] = intval($r['tanque_id']);
}
mysqli_free_result($resIds);

if (empty($ids)) {
    // si no hay ids, intentar tomar 1 como mínimo
    $ids[] = 1;
}

// por cada id buscar último registro (preferir historial_agua)
foreach ($ids as $tid) {
    $porcentaje = null;
    $fecha = null;
    $nombre = null;
    $q1 = "SELECT porcentaje, fecha, tanque FROM historial_agua WHERE tanque_id = $tid ORDER BY fecha DESC LIMIT 1";
    $r1 = mysqli_query($conex, $q1);
    if ($r1 && ($row = mysqli_fetch_assoc($r1))) {
        $porcentaje = is_null($row['porcentaje']) ? null : intval($row['porcentaje']);
        $fecha = $row['fecha'];
        $nombre = $row['tanque'] ?: "Tanque $tid";
        mysqli_free_result($r1);
    }
    if ($porcentaje === null) {
        $q2 = "SELECT porcentaje, fecha FROM tanque_niveles WHERE tanque_id = $tid ORDER BY fecha DESC LIMIT 1";
        $r2 = mysqli_query($conex, $q2);
        if ($r2 && ($row2 = mysqli_fetch_assoc($r2))) {
            $porcentaje = is_null($row2['porcentaje']) ? null : intval($row2['porcentaje']);
            $fecha = $row2['fecha'];
            $nombre = $nombre ?: "Tanque $tid";
            mysqli_free_result($r2);
        }
    }
    if ($porcentaje !== null) {
        // normalizar porcentaje entre 0 y 100
        if ($porcentaje < 0) $porcentaje = 0;
        if ($porcentaje > 100) $porcentaje = 100;
        if ($porcentaje < $umbral) {
            $alertas[] = [
                'id' => $tid,
                'tanque' => $nombre ?: "Tanque $tid",
                'porcentaje' => $porcentaje,
                'estado' => 'no leida',
                'fecha' => $fecha ?: date('Y-m-d H:i:s')
            ];
        }
    }
}

log_msg("alertas_data.php: alertas encontradas = " . count($alertas));
echo json_encode($alertas);

