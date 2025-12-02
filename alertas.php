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
      /* asegurar que las tarjetas no se solapen */
      margin-bottom: 8px;
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
    // mantener lista de IDs actualmente mostrados para evitar re-render innecesario
    let currentDisplayedIds = [];

    // Cargar alertas desde la base de datos y renderizar (reconstrucción completa)
    function cargarAlertas() {
      fetch('alertas_data.php?_=' + Date.now(), { cache: 'no-store' })
        .then(response => response.json())
        .then(data => {
          if (!Array.isArray(data)) return;

          // Tomar las últimas 5 alertas (asumimos vienen ordenadas por fecha DESC)
          const latest = data.slice(0, 5);
          const latestIds = latest.map(a => String(a.id));

          // Si los IDs no cambiaron, no hacemos nada (evita parpadeos)
          if (arraysEqual(latestIds, currentDisplayedIds)) {
            // console.log('sin cambios en alertas');
            return;
          }

          currentDisplayedIds = latestIds;

          const alertList = document.getElementById('alertList');
          // Reconstruir la lista completa con las 5 más recientes
          alertList.innerHTML = '';

          if (latest.length === 0) {
            alertList.innerHTML = '<div style="text-align:center;color:#888">No hay alertas recientes.</div>';
            return;
          }

          latest.forEach(alerta => {
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

    // Utilidad simple para comparar arrays de strings
    function arraysEqual(a, b) {
      if (a === b) return true;
      if (!a || !b) return false;
      if (a.length !== b.length) return false;
      for (let i = 0; i < a.length; i++) {
        if (a[i] !== b[i]) return false;
      }
      return true;
    }

    // Delegación de eventos para botones Eliminar (funciona para elementos dinámicos)
    document.getElementById('alertList').addEventListener('click', function (e) {
      const btn = e.target.closest('.eliminar-btn');
      if (!btn) return;
      const id = btn.getAttribute('data-id');
      eliminarAlerta(id, btn);
    });

    // Eliminar alerta por ID
    function eliminarAlerta(id, btn) {
      if (!id) {
        alert('ID de alerta inválido');
        return;
      }

      // intentar normalizar el id a entero
      let parsedId = parseInt(id, 10);
      if (isNaN(parsedId)) {
        // intentar leer desde el contenedor si vino mal el atributo
        const cardFallback = btn.closest('.alert-card');
        if (cardFallback && cardFallback.dataset && cardFallback.dataset.id) {
          parsedId = parseInt(cardFallback.dataset.id, 10);
        }
      }

      if (isNaN(parsedId)) {
        console.error('ID de alerta inválido:', id);
        alert('ID de alerta inválido');
        btn.disabled = false;
        return;
      }

      btn.disabled = true;
      // enviar como entero
      const body = 'id=' + encodeURIComponent(parsedId);

      fetch('eliminar_alerta.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: body
      })
        .then(response => response.json())
        .then(data => {
          if (data && data.success) {
            // Quitar solo la tarjeta correspondiente del DOM
            const card = btn.closest('.alert-card') || document.getElementById('alert-' + parsedId);
            if (card && card.parentNode) {
              card.parentNode.removeChild(card);
            }
            // quitar id de la lista mostrada para evitar que vuelva en la proxima comprobacion local
            currentDisplayedIds = currentDisplayedIds.filter(i => i !== String(parsedId));
          } else {
            console.error('Error al eliminar (backend):', data);
            alert('Error al eliminar: ' + (data && data.error ? data.error : 'Desconocido'));
            btn.disabled = false;
          }
        })
        .catch(err => {
          console.error('Error de red al eliminar:', err);
          alert('Error de red al eliminar');
          btn.disabled = false;
        });
    }

    // Inicializar y refrescar periódicamente
    window.onload = function () {
      cargarAlertas();
      setInterval(cargarAlertas, 2000); // refrescar cada 2s para mayor rapidez
    };
  </script>

</body>
</html>
