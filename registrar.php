<?php
include("con_db.php");
$mensaje = "";

if (isset($_POST['register'])) {
    if (
        strlen($_POST['nombre']) >= 1 &&
        strlen($_POST['apellido']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['usuario']) >= 1 &&
        strlen($_POST['contrasena']) >= 1
    ) {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['contrasena']);
        $rol = 'admin'; // o lo que corresponda

        // Hashear contraseña correctamente
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $consulta = "INSERT INTO registonuevo(nombre, apellido, email, usuario, contrasena, rol)
                     VALUES('$nombre','$apellido','$email','$usuario','$password_hash','$rol')";

        $resultado = mysqli_query($conex, $consulta);

        if ($resultado) {
            $mensaje = "✅ Usuario registrado correctamente.";
        } else {
            $mensaje = "❌ Error al registrar usuario.";
        }
    } else {
        $mensaje = "⚠ Todos los campos son obligatorios.";
    }
}
?>
