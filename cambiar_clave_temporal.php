<?php
session_start();
if (!isset($_SESSION['user_email']) || !isset($_SESSION['usar_clave_temporal'])) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nueva_pass = $_POST['nueva_pass'] ?? '';
    $conf_pass = $_POST['conf_pass'] ?? '';

    if (empty($nueva_pass) || empty($conf_pass)) {
        $error = "Completa ambos campos.";
    } elseif ($nueva_pass !== $conf_pass) {
        $error = "Las contraseñas no coinciden.";
    } else {
        require_once 'con_db.php';
        $conex = $conex;
        if (!$conex) {
            die("Error de conexión: " . mysqli_connect_error());
        }
        $email = mysqli_real_escape_string($conex, $_SESSION['user_email']);
        $clave_cifrada = password_hash($nueva_pass, PASSWORD_DEFAULT);

        $sql = "UPDATE registronuevo SET pass='$clave_cifrada' WHERE email='$email'";
        if (mysqli_query($conex, $sql)) {
            // Quitar la bandera para forzar cambio
            unset($_SESSION['usar_clave_temporal']);
            unset($_SESSION['user_email']);

            $_SESSION['mensaje'] = "Contraseña cambiada correctamente. Ya puedes iniciar sesión.";

            header("Location: index.php");
            exit;
        } else {
            $error = "Error al actualizar la contraseña.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cambiar contraseña</title>
</head>
<body>
    <h2>Cambiar contraseña temporal</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label>Nueva contraseña:</label><br>
        <input type="password" name="nueva_pass" required><br><br>

        <label>Confirmar contraseña:</label><br>
        <input type="password" name="conf_pass" required><br><br>

        <button type="submit">Actualizar contraseña</button>
    </form>
</body>
</html>
