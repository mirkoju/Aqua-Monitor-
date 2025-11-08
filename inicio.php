<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aqua Monitor | BRACA HNOS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;600&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: #fff;
      min-height: 100vh;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: white;
      border-bottom: 1px solid #ccc;
      position: relative;
    }

    .navbar .logo {
      display: flex;
      align-items: center;
    }

    .navbar .logo img {
      height: 40px;
    }

    .nav-buttons {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .nav-buttons button {
      background-color: #e3f2fd;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .nav-buttons button:hover {
      background-color: #bbdefb;
    }

    .nav-buttons .active {
      background-color: #2196f3;
      color: white;
      font-weight: bold;
    }

    .user-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      object-fit: cover;
    }

    .config-panel {
      position: absolute;
      top: 70px;
      right: 30px;
      width: 250px;
      background: #fff;
      color: #000;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      border-radius: 15px;
      padding: 20px;
      z-index: 1000;
      transition: opacity 0.3s ease;
    }

    .config-panel h3 {
      margin-top: 0;
      font-size: 18px;
      margin-bottom: 15px;
    }

    .config-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
    }

    .config-item select {
      border-radius: 8px;
      padding: 4px 8px;
      border: 1px solid #ccc;
    }

    .logout-btn {
      width: 100%;
      background-color: #f44336;
      color: white;
      border: none;
      padding: 10px;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 10px;
    }

    .logout-btn:hover {
      background-color: #d32f2f;
    }

    .hidden {
      display: none;
    }

    .main-content {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 60px 20px;
      text-align: center;
    }

    h1 {
      font-size: 3em;
      margin-bottom: 10px;
    }

    h2 {
      font-weight: 300;
      color: #a0d6ff;
      margin-bottom: 40px;
    }

    p {
      max-width: 600px;
      margin-bottom: 40px;
      font-size: 1.2em;
      line-height: 1.6;
    }

    .btn {
      padding: 12px 30px;
      background-color: #1e90ff;
      border: none;
      border-radius: 6px;
      font-size: 1em;
      color: white;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s;
    }

    .btn:hover {
      background-color: #1c7ed6;
    }

    footer {
      margin-top: 60px;
      font-size: 0.9em;
      color: #aaa;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Barra de navegación -->
  <div class="navbar">
    <div class="logo">
      <img src="aquamonitor.png" alt="Aqua Monitor" />
    </div>
    <div class="nav-buttons">
      <button class="active" onclick="window.location.href='inicio.php'">Inicio</button>
      <button onclick="window.location.href='pgraficos.php'">Mediciones</button>
      <button onclick="window.location.href='alertas.php'">Alertas</button>
      <button id="config-btn">Configuración</button>
      <img src="usuario.png" alt="Usuario" class="user-icon" />
    </div>

    <div id="config-panel" class="config-panel hidden">
      <h3>Configuración</h3>

      <div class="config-item">
        <span>🔔 Notificaciones</span>
        <select>
          <option>ON</option>
          <option>OFF</option>
        </select>
      </div>

      <div class="config-item">
        <span>📏 Unidad</span>
        <select>
          <option>Lts</option>
          <option>m³</option>
        </select>
      </div>

      <div class="config-item">
        <span>⏱ Frecuencia</span>
        <select>
          <option>1 Min</option>
          <option>5 Min</option>
          <option>10 Min</option>
        </select>
      </div>

      <button class="logout-btn" onclick="window.location.href='index.php'">Cerrar Sesión</button>
    </div>
  </div>

  <!-- Contenido principal -->
  <div class="main-content">
    <h1>Aqua Monitor</h1>
    <h2>Monitoreo inteligente de tanques de agua</h2>

    <p>
      Somos especialistas en medición y monitoreo de niveles de agua en tanques industriales.
      Nuestro sistema brinda información precisa y en tiempo real para <strong>BRACA HNOS</strong>,
      optimizando recursos y mejorando la toma de decisiones.
    </p>

    <a href="ingreso.php" class="btn">Ingresar al sistema</a>
  </div>

  <footer>
    © 2025 Aqua Monitor - BRACA HNOS. Todos los derechos reservados.
  </footer>

  <script>
    const configBtn = document.getElementById("config-btn");
    const configPanel = document.getElementById("config-panel");

    configBtn.onclick = function (e) {
      e.preventDefault();
      configPanel.classList.toggle("hidden");
    };

    document.addEventListener("click", function (e) {
      if (!configPanel.contains(e.target) && !configBtn.contains(e.target)) {
        configPanel.classList.add("hidden");
      }
    });
  </script>
</body>
</html>

