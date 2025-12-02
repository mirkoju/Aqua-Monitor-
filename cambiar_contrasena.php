<?php
session_start();
if (!isset($_SESSION['clave_temporal_usada']) || !$_SESSION['clave_temporal_usada']) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva = $_POST['nueva'];
    $repetir = $_POST['repetir'];

    if ($nueva !== $repetir) {
        $error = "Las contraseñas no coinciden.";
    } else {
        require_once 'con_db.php';
        $conex = $conex;
        if (!$conex) {
            die("Error de conexión: " . mysqli_connect_error());
        }
        $hash = password_hash($nueva, PASSWORD_DEFAULT);
        mysqli_query($conex, "UPDATE registronuevo SET pass = '$hash' WHERE email = '$email'");

        // Eliminar la solicitud de clave temporal
        mysqli_query($conex, "DELETE FROM recuperar WHERE email = '$email'");

        // Limpiar sesión y redirigir
        unset($_SESSION['clave_temporal_usada']);
        $_SESSION['rta'] = "Contraseña actualizada correctamente. Ahora puede iniciar sesión.";
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cambiar Contraseña</title>
</head>
<body>
  <h2>Cambiar contraseña</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="POST">
    Nueva contraseña: <input type="password" name="nueva" required><br>
    Repetir contraseña: <input type="password" name="repetir" required><br>
    <input type="submit" value="Actualizar">
  </form>
</body>
</html>
