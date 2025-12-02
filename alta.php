<?php
require_once 'con_db.php';
$conex = $conex;
if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

$mensaje = '';
$tipo_mensaje = '';

if (isset($_POST['Enviar'])) {
    if (
        strlen($_POST['nombre']) >= 1 &&
        strlen($_POST['apellido']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['User']) >= 1 &&
        strlen($_POST['password']) >= 1 &&
        $_POST['password'] === $_POST['Cpassword']
    ) {
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['email']);
        $User = trim($_POST['User']);
        $password = $_POST['password'];
        $pass_cifrada = password_hash($password, PASSWORD_DEFAULT, ["cost" => 10]);

        $consulta = "INSERT INTO registronuevo (nombre, apellido, email, user, pass) VALUES ('$nombre','$apellido','$email','$User','$pass_cifrada')";
        $resultado = mysqli_query($conex, $consulta);

        if ($resultado) {
            $mensaje = "¡Te has registrado correctamente!";
            $tipo_mensaje = "success";
            header("refresh:3;url=index.php");
        } else {
            $mensaje = "¡Ups! Ocurrió un error al registrarte.";
            $tipo_mensaje = "error";
        }
    } else {
        $mensaje = "¡Por favor, completá todos los campos correctamente!";
        $tipo_mensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro de Usuario</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(-45deg, #ff6ec4, #7873f5, #4ade80, #38bdf8);
      background-size: 400% 400%;
      animation: gradientMove 12s ease infinite;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      color: #fff;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .form-container {
      background: rgba(255, 255, 255, 0.95);
      color: #1f1f2f;
      border-radius: 24px;
      box-shadow: 0 25px 50px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 500px;
      padding: 48px 38px;
      animation: fadeIn 1s ease;
      backdrop-filter: blur(10px);
      text-align: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      font-weight: 700;
      font-size: 2.4rem;
      color: #7c3aed;
      margin-bottom: 28px;
      text-shadow: 1px 1px 2px #e0e0ff;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      padding: 14px;
      border-radius: 14px;
      border: 2px solid #d1d5db;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input:focus {
      border-color: #a78bfa;
      box-shadow: 0 0 10px rgba(167, 139, 250, 0.4);
      outline: none;
      background: #f9f5ff;
    }

    .button {
      background: linear-gradient(to right, #8b5cf6, #ec4899);
      color: white;
      padding: 16px;
      font-size: 1.1rem;
      font-weight: 700;
      border: none;
      border-radius: 16px;
      cursor: pointer;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .button:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(236, 72, 153, 0.4);
    }

    .message {
      margin-top: 20px;
      padding: 14px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 1rem;
    }

    .message.success {
      background-color: #e8f5e9;
      color: #2e7d32;
      border: 1.5px solid #4caf50;
    }

    .message.error {
      background-color: #ffebee;
      color: #c62828;
      border: 1.5px solid #e53935;
    }

    @media (max-width: 480px) {
      .form-container {
        padding: 32px 24px;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Crear Cuenta Nueva</h2>

    <?php if ($mensaje): ?>
      <div class="message <?= $tipo_mensaje ?>"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST" action="alta.php" autocomplete="off">
      <input type="text" name="nombre" placeholder="Nombre" required>
      <input type="text" name="apellido" placeholder="Apellido" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="text" name="User" placeholder="Nombre de usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <input type="password" name="Cpassword" placeholder="Confirmar contraseña" required>
      <input type="submit" name="Enviar" value="Registrar" class="button">
    </form>
  </div>

</body>
</html>
