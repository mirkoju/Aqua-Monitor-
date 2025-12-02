<?php

function log_db($msg) {
    $dir = __DIR__ . '/logs';
    if (!is_dir($dir)) @mkdir($dir, 0755, true);
    $file = $dir . '/db_debug.log';
    @file_put_contents($file, date('c').' '.$msg.PHP_EOL, FILE_APPEND);
}


$host = "192.168.101.93";
$user = "BG05";
$pass = "St2025#QkcwNQ";
$db   = "bg05";

$conex = mysqli_connect($host, $user, $pass, $db);

if (!$conex) {
    error_log("❌ Error de conexión MySQL: " . mysqli_connect_error());
    die("DATABASE_ERROR");
}

mysqli_set_charset($conex, "utf8mb4");
?>
