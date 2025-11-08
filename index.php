<?php
session_start();
$mensaje_error = $_SESSION['error_login'] ?? '';
unset($_SESSION['error_login']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ingreso - Fábrica Soda Braca</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #a8dadc, #457b9d, #1d3557);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      color: #f1faee;
    }

    .login-container {
      background: rgba(241, 250, 238, 0.95);
      border-radius: 20px;
      box-shadow: 0 12px 28px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 420px;
      padding: 48px 36px;
      animation: fadeIn 0.8s ease;
      text-align: center;
      color: #1d3557;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .logo {
      width: 220px;
      margin: 0 auto 32px auto;
    }

    h2 {
      font-weight: 700;
      font-size: 2rem;
      margin-bottom: 28px;
      color: #1d3557;
    }

    label {
      font-size: 1rem;
      font-weight: 600;
      display: block;
      margin-bottom: 10px;
      margin-top: 22px;
      color: #1d3557;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 14px 18px;
      font-size: 1rem;
      border: 2px solid #457b9d;
      border-radius: 14px;
      transition: all 0.3s ease;
      background-color: #f1faee;
      color: #1d3557;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #1d3557;
      box-shadow: 0 0 8px rgba(29, 53, 87, 0.6);
      outline: none;
      background: #ffffff;
    }

    .button {
      width: 100%;
      background: #457b9d;
      color: white;
      border: none;
      padding: 14px;
      border-radius: 16px;
      font-weight: 700;
      font-size: 1.05rem;
      margin-top: 28px;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
    }

    .button:hover {
      background: #1d3557;
      transform: scale(1.02);
    }

    .link-button {
      display: block;
      text-align: center;
      margin-top: 26px;
      font-weight: 600;
      color: #457b9d;
      text-decoration: none;
      font-size: 1rem;
      transition: color 0.3s;
    }

    .link-button:hover {
      color: #1d3557;
      text-decoration: underline;
    }

    .error-message {
      background-color: #f8d7da;
      border: 2px solid #e63946;
      color: #9b2226;
      padding: 12px 18px;
      margin-bottom: 24px;
      border-radius: 14px;
      font-weight: 600;
    }

    @media (max-width: 480px) {
      .login-container {
        padding: 32px 24px;
      }
      .logo {
        width: 180px;
      }
    }
  </style>
</head>
<body>

  <div class="login-container">
    <img src="logo_braca_hnos.png" alt="Logo Braca Hnos" class="logo" />
    <h2>Ingreso - Fábrica Soda Braca</h2>

    <?php if ($mensaje_error): ?>
      <div class="error-message"><?= htmlspecialchars($mensaje_error) ?></div>
    <?php endif; ?>

    <form action="ingreso.php" method="POST" autocomplete="off">
      <label for="usuario">Usuario</label>
      <input type="text" name="usuario" id="usuario" required autofocus />

      <label for="password">Contraseña</label>
      <input type="password" name="password" id="password" required />

      <button type="submit" class="button">Ingresar</button>
    </form>

    <a href="recuperar_clave.php" class="link-button">¿Olvidaste tu contraseña?</a>
  </div>

</body>
</html>
