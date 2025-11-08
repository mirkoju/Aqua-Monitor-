<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alertas - Aqua Monitor</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to bottom, #ffffff 0%, #0093FF 100%);
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
      height: 32px;
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
    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 0 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    h1 {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .tabs {
      display: flex;
      gap: 10px;
    }
    .tab-btn {
      background-color: #e3f2fd;
      border: none;
      padding: 8px 16px;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }
    .tab-btn.active {
      background-color: #2196f3;
      color: white;
    }
    .alert-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    .alert-card {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .alert-info {
      display: flex;
      flex-direction: column;
    }
    .alert-title {
      font-weight: bold;
      font-size: 16px;
    }
    .alert-detail {
      font-size: 14px;
      color: #555;
    }
    .alert-meta {
      text-align: right;
      font-size: 13px;
    }
    .eliminar-btn {
      background: linear-gradient(90deg, #f44336 60%, #ff7961 100%);
      color: #fff;
      border: none;
      padding: 7px 18px;
      border-radius: 20px;
      font-weight: bold;
      font-size: 13px;
      cursor: pointer;
      box-shadow: 0 2px 6px rgba(244,67,54,0.15);
      transition: background 0.2s, transform 0.2s;
      margin-top: 8px;
      outline: none;
    }
    .eliminar-btn:hover {
      background: linear-gradient(90deg, #d32f2f 60%, #ff7961 100%);
      transform: scale(1.07);
    }
    }
    .leida {
      background-color: #e3f2fd;
      padding: 4px 10px;
      border-radius: 10px;
      font-weight: bold;
      font-size: 12px;
      display: inline-block;
      margin-top: 5px;
    }
    /* Panel de configuración */
    .config-wrapper {
      position: relative;
    }
    .config-panel {
      position: absolute;
      top: 40px;
      right: 0;
      width: 250px;
      background: #fff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      border-radius: 15px;
      padding: 20px;
      z-index: 1000;
      transition: opacity 0.3s ease;
    }
    .config-panel.hidden {
      display: none;
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
    }//borrar 
    .logout-btn {
      width: 100%;
      background-color: #f44336 !important;
      color: white !important;
      border: none;
      padding: 10px;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      margin-top: 10px;
      box-shadow: 0 2px 6px rgba(244, 67, 54, 0.7);
      transition: background-color 0.3s ease;
    }
    .logout-btn:hover {
      background-color: #d32f2f !important;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">
      <img src="aquamonitor.png" alt="Aqua Monitor Logo" />
    </div>
    <div class="nav-buttons">
      <button onclick="window.location.href='inicio.php'">Inicio</button>
      <button onclick="window.location.href='pgraficos.php'">Mediciones</button>
      <button class="active" onclick="window.location.href='alertas.php'">Alertas</button>

      <div class="config-wrapper">
        <button id="config-btn">Configuración</button>
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

      <img src="usuario.png" alt="Usuario" class="user-icon" />
    </div>
  </div>

  <div class="container">
    <h1>Alertas</h1>

    <div class="tabs">
  <button class="tab-btn active" onclick="filtrarAlertas('no-leidas')">Alertas no leídas</button>
    </div>

    <div class="alert-list" id="alertList">
      <!-- Las alertas se cargarán aquí dinámicamente -->
    </div>
  </div>

  <script>
    // Cargar alertas desde la base de datos y renderizar
    function cargarAlertas() {
      fetch('alertas_data.php?_=' + Date.now(), { cache: 'no-store' })
        .then(response => response.json())
        .then(data => {
          const alertList = document.getElementById('alertList');
          // Reconstruir la lista completa en cada respuesta
          alertList.innerHTML = '';

          if (!Array.isArray(data) || data.length === 0) {
            alertList.innerHTML = '<div style="text-align:center;color:#888">No hay alertas recientes.</div>';
            return;
          }

          // data viene ordenada por fecha DESC (más recientes primero)
          data.forEach(alerta => {
            const leida = (alerta.estado || '').toLowerCase() === 'leida';

            // Determinar etiqueta de sensor a partir del campo 'tanque'
            let sensorLabel = alerta.tanque || 'Tanque';
            if (/\-\s*1$/.test(alerta.tanque) || /\b1\b/.test(alerta.tanque)) sensorLabel = 'Sensor 1';
            else if (/\-\s*2$/.test(alerta.tanque) || /\b2\b/.test(alerta.tanque)) sensorLabel = 'Sensor 2';
            else if (/\-\s*3$/.test(alerta.tanque) || /\b3\b/.test(alerta.tanque)) sensorLabel = 'Sensor 3';

            const card = document.createElement('div');
            card.className = 'alert-card';
            card.id = 'alert-' + alerta.id;
            card.setAttribute('data-id', String(alerta.id));
            card.dataset.leida = leida ? 'true' : 'false';
            card.innerHTML = `
              <div class="alert-info">
                <div class="alert-title">🔔 ${sensorLabel} - nivel bajo</div>
                <div class="alert-detail">${alerta.tanque} — ${alerta.porcentaje}%</div>
              </div>
              <div class="alert-meta">
                ${new Date(alerta.fecha).toLocaleString('es-AR')} <br />
                <span class="leida">${leida ? 'Leída' : 'No leída'}</span>
                <br />
                <button class="eliminar-btn" data-id="${alerta.id}">Eliminar</button>
              </div>
            `;
            alertList.appendChild(card);
          });
        })
        .catch(err => {
          console.error('Error cargando alertas:', err);
        });
    }

    // Delegación de eventos para botones Eliminar (funciona para elementos dinámicos)
    document.getElementById('alertList').addEventListener('click', function (e) {
      const btn = e.target.closest('.eliminar-btn');
      if (!btn) return;
      const id = btn.getAttribute('data-id');
      eliminarAlerta(id, btn);
    });

    // Eliminar alerta por ID (se espera que exista eliminar_alerta.php en el servidor)
    function eliminarAlerta(id, btn) {
      if (!id) return;
      btn.disabled = true;
      fetch('eliminar_alerta.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id)
      })
        .then(response => response.json())
        .then(data => {
          if (data && data.success) {
            // recargar lista inmediatamente para mostrar otras alertas pendientes
            cargarAlertas();
          } else {
            alert('Error al eliminar: ' + (data && data.error ? data.error : 'Desconocido'));
            btn.disabled = false;
          }
        })
        .catch(() => {
          alert('Error de red al eliminar');
          btn.disabled = false;
        });
    }

    // Filtro de alertas (no leídas/todas) — adapta display según dataset.leida
    function filtrarAlertas(tipo) {
      const botones = document.querySelectorAll('.tab-btn');
      botones.forEach(btn => btn.classList.remove('active'));
      if (tipo === 'no-leidas') {
        if (botones[0]) botones[0].classList.add('active');
      } else {
        if (botones[1]) botones[1].classList.add('active');
      }

      const alertas = document.querySelectorAll('.alert-card');
      alertas.forEach(alerta => {
        if (tipo === 'no-leidas' && alerta.dataset.leida === 'true') {
          alerta.style.display = 'none';
        } else {
          alerta.style.display = 'flex';
        }
      });
    }

    // Inicializar y refrescar periódicamente
    window.onload = function () {
      cargarAlertas();
      setInterval(cargarAlertas, 3000); // refrescar cada 3s (más responsivo)
    };

    // Toggle del panel de configuración (mantener igual)
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
