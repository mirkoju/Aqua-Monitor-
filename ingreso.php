<?php
session_start();

// Usar conexión central con credenciales de con_db.php
require_once 'con_db.php';
$conex = $conex; // ya viene definida en con_db.php
if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

if (!$usuario || !$password) {
    $_SESSION['error_login'] = "Por favor, complete usuario y contraseña.";
    header("Location: index.php");
    exit();
}

// Preparar consulta para buscar usuario
$sql = "SELECT * FROM registonuevo WHERE usuario = ?";
$stmt = mysqli_prepare($conex, $sql);
if (!$stmt) {
    die("Error en la preparación de la consulta: " . mysqli_error($conex));
}

mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    $hashedPassword = $row['contrasena'];

    if (password_verify($password, $hashedPassword)) {
        $_SESSION["usuario"] = $usuario;
        header("Location: pgraficos.php");
        exit();
    }
}

// Si usuario o contraseña incorrectos
$_SESSION['error_login'] = "Usuario o contraseña incorrectos.";
header("Location: index.php");
exit();
?>
