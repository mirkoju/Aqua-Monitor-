<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Alertas - Aqua Monitor</title>
  <link rel="stylesheet" href="styles.css" />
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
    // Cargar alertas desde la base de datos y renderizar (reconstrucción completa)
    function cargarAlertas() {
      fetch('alertas_data.php?_=' + Date.now(), { cache: 'no-store' })
        .then(response => response.json())
        .then(data => {
          const alertList = document.getElementById('alertList');
          // Reconstruir la lista completa en cada respuesta (evita inconsistencias)
          alertList.innerHTML = '';

          if (!Array.isArray(data) || data.length === 0) {
            alertList.innerHTML = '<div style="text-align:center;color:#888">No hay alertas recientes.</div>';
            return;
          }

          // DEBUG: ver en consola cuántas alertas vinieron
          console.log('alertas recibidas:', data.length);

          // Mostrar todas las alertas devueltas (vienen ordenadas por fecha DESC)
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

    // Eliminar alerta por ID
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
            // Quitar la tarjeta de la alerta del DOM con una transición suave
            const card = btn.closest('.alert-card');
            if (card) {
              card.style.transition = 'opacity 300ms, height 300ms, margin 300ms, padding 300ms';
              card.style.opacity = '0';
              card.style.height = '0';
              card.style.margin = '0';
              card.style.padding = '0';
              setTimeout(() => {
                if (card.parentNode) card.parentNode.removeChild(card);
              }, 320);
            } else {
              // fallback: recargar la lista si no encontramos la tarjeta
              cargarAlertas();
            }
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

    // Inicializar y refrescar periódicamente
    window.onload = function () {
      cargarAlertas();
      setInterval(cargarAlertas, 20000); // refrescar cada 20s para mayor rapidez
    };
  </script>

</body>
</html>
