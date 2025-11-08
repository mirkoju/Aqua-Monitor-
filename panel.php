<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION['usar_clave_temporal']) && $_SESSION['usar_clave_temporal'] === true) {
    header("Location: cambiar_contrasena.php");
    exit;
}

echo "Bienvenido " . htmlspecialchars($_SESSION['user_email']) . "!";

if (isset($_SESSION['mensaje'])) {
    echo "<p style='color:green;'>" . $_SESSION['mensaje'] . "</p>";
    unset($_SESSION['mensaje']);
}
?>
