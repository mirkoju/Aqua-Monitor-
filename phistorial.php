<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Historial - Aqua Monitor</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #ffffff, #0093FF);
      margin: 0;
      padding: 0;
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

    .nav-buttons img {
      width: 32px;
      height: 32px;
      border-radius: 50%;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .chart-card {
      background-color: white;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }

    /* Panel de configuración */
    .config-panel {
      position: absolute;
      top: 70px;
      right: 30px;
      width: 250px;
      background: #fff;
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
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <div class="navbar">
    <div class="logo">
      <img src="aquamonitor.png" alt="Logo Aqua Monitor" />
    </div>
    <div class="nav-buttons">
      <button onclick="window.location.href='inicio.php'">Inicio</button>
      <button onclick="window.location.href='pgraficos.php'">Mediciones</button>
      <button class="active" onclick="window.location.href='phistorial.php'">Historial</button>
      <button onclick="window.location.href='alertas.php'">Alertas</button>
      <button id="config-btn">Configuración</button>
      <img src="usuario.png" alt="Usuario" />
    </div>

    <!-- Panel de Configuración -->
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

      <button class="logout-btn" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
    </div>
  </div>

  <!-- CONTENIDO -->
  <div class="container">
    <h1>Historial de Agua</h1>

    <div class="chart-card">
      <canvas id="chartTanque1"></canvas>
      <?php
      // Obtener los últimos 10 registros del historial
      $mysqli = new mysqli("localhost", "root", "", "nusuario");
      $result = $mysqli->query("SELECT porcentaje, fecha FROM tanque_niveles ORDER BY fecha DESC LIMIT 10");
      $labels = [];
      $data = [];
      while ($row = $result->fetch_assoc()) {
        $labels[] = date("d/m H:i", strtotime($row['fecha']));
        $data[] = intval($row['porcentaje']);
      }
      // Invertir para mostrar del más antiguo al más reciente
      $labels = array_reverse($labels);
      $data = array_reverse($data);
      if (count($labels) == 0) {
        echo "<p style='text-align:center;color:#f44336;'>No hay datos guardados en la base.</p>";
      }
      ?>
    </div>
  </div>

  <script>
    // Toggle del panel de configuración
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

    // Gráfico Tanque 1 con datos reales
    const labelsHistorial = <?php echo json_encode($labels); ?>;
    const dataHistorial = <?php echo json_encode($data); ?>;

    if (labelsHistorial.length > 0) {
      new Chart(document.getElementById('chartTanque1').getContext('2d'), {
        type: 'line',
        data: {
          labels: labelsHistorial,
          datasets: [{
            label: 'Porcentaje de llenado',
            data: dataHistorial,
            borderColor: '#2196f3',
            backgroundColor: 'transparent',
            tension: 0.3
          }]
        },
        options: {
          responsive: true,
          plugins: {
            title: {
              display: true,
              text: 'Historial - Últimos 10 datos',
              font: { size: 18 }
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              max: 100
            }
          }
        }
      });
    }
  </script>

</body>
</html>
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Historial - Tanque AGUA FILTRADA',
            font: { size: 18 }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });

    // Gráfico Tanque 3
    new Chart(document.getElementById('chartTanque3').getContext('2d'), {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Tanque AGUA NO FILTRADA',
          data: [30, 32, 35, 34, 33, 32, 31],
          borderColor: '#f44336',
          backgroundColor: 'transparent',
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Historial - Tanque AGUA NO FILTRADA',
            font: { size: 18 }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 100
          }
        }
      }
    });
  </script>

</body>
</html>
