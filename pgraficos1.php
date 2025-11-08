<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Aqua Monitor</title>
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

    .container {
      max-width: 800px;
      margin: 40px auto;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .tank-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 20px 30px;
    }

    .tank-info {
      display: flex;
      flex-direction: column;
    }

    .status {
      font-weight: bold;
      margin-bottom: 8px;
    }

    .status.low {
      color: #ff9800;
    }

    .status.high {
      color: #f44336;
    }

    .status.normal {
      color: #4caf50;
    }

    .circle {
      position: relative;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #eee;
    }

    .circle svg {
      transform: rotate(-90deg);
    }

    .circle-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 18px;
      font-weight: bold;
    }

    .circle .progress {
      stroke-linecap: round;
      fill: none;
      stroke-width: 8;
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

    @keyframes pulse {
      0% { transform: scale(1.2); }
      100% { transform: scale(1.35); }
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">
      <img src="aquamonitor.png" alt="Aqua Monitor" />
    </div>
    <div class="nav-buttons">
      <button onclick="window.location.href='inicio.php'">Inicio</button>
      <button class="active" onclick="window.location.href='pgraficos.php'">Mediciones</button>
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

  <div class="container">
    <div style="display:flex; gap:24px; justify-content:center; flex-wrap:wrap;">
      <!-- Tarjeta Tanque 1 -->
      <div class="tank-card" style="width:360px; flex:1; max-width:420px;">
        <div style="display:flex; gap:20px; align-items:center;">
          <div class="circle" style="width:120px;height:120px; background: linear-gradient(135deg,#bbdefb 0%,#e3f2fd 100%); box-shadow: 0 4px 12px rgba(33,150,243,0.08);">
            <svg width="120" height="120">
              <circle cx="60" cy="60" r="52" stroke="#eee" stroke-width="16" fill="none"/>
              <circle id="progress1" cx="60" cy="60" r="52" stroke="#2196f3" stroke-width="16" fill="none" class="progress" stroke-dasharray="327.0" stroke-dashoffset="327.0" style="transition:stroke-dashoffset 0.7s cubic-bezier(.4,2,.3,1);"/>
            </svg>
            <div class="circle-text" id="porcentaje1" style="font-size:1.4em; color:#2196f3;">0%</div>
          </div>
          <div style="flex:1;">
            <div style="font-size:1.1em; font-weight:700; color:#1565c0; margin-bottom:6px;">Tacho 20L — T1</div>
            <div id="dato1" style="font-size:1.05em; color:#2196f3;">Esperando datos...</div>
            <div id="alerta1" style="font-size:0.95em; color:#f44336; margin-top:10px; font-weight:600; display:none;">¡Alerta: Tanque bajo! Llenar urgente.</div>
          </div>
        </div>
      </div>

      <!-- Tarjeta Tanque 2 -->
      <div class="tank-card" style="width:360px; flex:1; max-width:420px;">
        <div style="display:flex; gap:20px; align-items:center;">
          <div class="circle" style="width:120px;height:120px; background: linear-gradient(135deg,#bbdefb 0%,#e3f2fd 100%); box-shadow: 0 4px 12px rgba(33,150,243,0.08);">
            <svg width="120" height="120">
              <circle cx="60" cy="60" r="52" stroke="#eee" stroke-width="16" fill="none"/>
              <circle id="progress2" cx="60" cy="60" r="52" stroke="#2196f3" stroke-width="16" fill="none" class="progress" stroke-dasharray="327.0" stroke-dashoffset="327.0" style="transition:stroke-dashoffset 0.7s cubic-bezier(.4,2,.3,1);"/>
            </svg>
            <div class="circle-text" id="porcentaje2" style="font-size:1.4em; color:#2196f3;">0%</div>
          </div>
          <div style="flex:1;">
            <div style="font-size:1.1em; font-weight:700; color:#1565c0; margin-bottom:6px;">Tacho 20L — T2</div>
            <div id="dato2" style="font-size:1.05em; color:#2196f3;">Esperando datos...</div>
            <div id="alerta2" style="font-size:0.95em; color:#f44336; margin-top:10px; font-weight:600; display:none;">¡Alerta: Tanque bajo! Llenar urgente.</div>
          </div>
        </div>
      </div>

      <!-- Tarjeta Tanque 3 (nuevo) -->
      <div class="tank-card" style="width:360px; flex:1; max-width:420px;">
        <div style="display:flex; gap:20px; align-items:center;">
          <div class="circle" style="width:120px;height:120px; background: linear-gradient(135deg,#bbdefb 0%,#e3f2fd 100%); box-shadow: 0 4px 12px rgba(33,150,243,0.08);">
            <svg width="120" height="120">
              <circle cx="60" cy="60" r="52" stroke="#eee" stroke-width="16" fill="none"/>
              <circle id="progress3" cx="60" cy="60" r="52" stroke="#2196f3" stroke-width="16" fill="none" class="progress" stroke-dasharray="327.0" stroke-dashoffset="327.0" style="transition:stroke-dashoffset 0.7s cubic-bezier(.4,2,.3,1);"/>
            </svg>
            <div class="circle-text" id="porcentaje3" style="font-size:1.4em; color:#2196f3;">0%</div>
          </div>
          <div style="flex:1;">
            <div style="font-size:1.1em; font-weight:700; color:#1565c0; margin-bottom:6px;">Tacho 20L — T3</div>
            <div id="dato3" style="font-size:1.05em; color:#2196f3;">Esperando datos...</div>
            <div id="alerta3" style="font-size:0.95em; color:#f44336; margin-top:10px; font-weight:600; display:none;">¡Alerta: Tanque bajo! Llenar urgente.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    async function actualizar() {
      try {
        let r = await fetch("recibir.php");
        let t = await r.text();
        // Parsear T1, T2 y T3 desde la respuesta
        let reT1 = /T1 Dist:\s*([0-9]+\.?[0-9]*)\s*cm\s*\|\s*Llenado:\s*([0-9]+\.?[0-9]*)%\s*\|\s*Litros:\s*([0-9]+\.?[0-9]*)/i;
        let reT2 = /T2 Dist:\s*([0-9]+\.?[0-9]*)\s*cm\s*\|\s*Llenado:\s*([0-9]+\.?[0-9]*)%\s*\|\s*Litros:\s*([0-9]+\.?[0-9]*)/i;
        let reT3 = /T3 Dist:\s*([0-9]+\.?[0-9]*)\s*cm\s*\|\s*Llenado:\s*([0-9]+\.?[0-9]*)%\s*\|\s*Litros:\s*([0-9]+\.?[0-9]*)/i;
        let m1 = t.match(reT1);
        let m2 = t.match(reT2);
        let m3 = t.match(reT3);
        let porcentaje = 0, litros = 0, dist = 0;
        let porcentaje2 = 0, litros2 = 0, dist2 = 0;
        let porcentaje3 = 0, litros3 = 0, dist3 = 0;

        if (m1) {
          dist = parseFloat(m1[1]);
          porcentaje = parseFloat(m1[2]);
          litros = parseFloat(m1[3]);
        }
        if (m2) {
          dist2 = parseFloat(m2[1]);
          porcentaje2 = parseFloat(m2[2]);
          litros2 = parseFloat(m2[3]);
        }
        if (m3) {
          dist3 = parseFloat(m3[1]);
          porcentaje3 = parseFloat(m3[2]);
          litros3 = parseFloat(m3[3]);
        }

        // Parámetros (coinciden con el cálculo del dispositivo)
        const alturaSensorLlena_js = 20.0;
        const alturaSensorVacia_js  = 65.0;
        const alturaTacho_js        = 45.0;
        const volumenTachoLitros_js = 20.0;

        function calcularDesdeDistancia(distVal) {
          if (!isFinite(distVal) || distVal === null) return {porcentaje: 0, litros: 0};
          if (distVal <= alturaSensorLlena_js) return {porcentaje: 100, litros: volumenTachoLitros_js};
          if (distVal >= alturaSensorVacia_js) return {porcentaje: 0, litros: 0};
          let alturaAgua = distVal - alturaSensorLlena_js;
          let pct = 100 - ((alturaAgua / alturaTacho_js) * 100);
          pct = Math.max(0, Math.min(100, pct));
          let lts = (pct / 100) * volumenTachoLitros_js;
          return {porcentaje: pct, litros: lts};
        }

        // Recalcular si hay distancia (prioriza distancia)
        if (m1) {
          let r = calcularDesdeDistancia(dist);
          porcentaje = r.porcentaje;
          litros = r.litros;
        }
        if (m2) {
          let r2 = calcularDesdeDistancia(dist2);
          porcentaje2 = r2.porcentaje;
          litros2 = r2.litros;
        }
        if (m3) {
          let r3 = calcularDesdeDistancia(dist3);
          porcentaje3 = r3.porcentaje;
          litros3 = r3.litros;
        }

        // Redondear y sanitizar
        porcentaje = Math.round(porcentaje); porcentaje2 = Math.round(porcentaje2); porcentaje3 = Math.round(porcentaje3);
        litros = Math.round(litros); litros2 = Math.round(litros2); litros3 = Math.round(litros3);
        dist = Math.round(dist); dist2 = Math.round(dist2); dist3 = Math.round(dist3);

        porcentaje = Math.min(100, Math.max(0, porcentaje));
        porcentaje2 = Math.min(100, Math.max(0, porcentaje2));
        porcentaje3 = Math.min(100, Math.max(0, porcentaje3));

        // Actualizar DOM T1
        document.getElementById("dato1").innerHTML = `Dist: ${dist} cm<br>Llenado: ${porcentaje}% | ${litros} L`;
        let circle1 = document.getElementById("progress1");
        let total1 = 327.0;
        let offset1 = total1 - (porcentaje / 100) * total1;
        circle1.setAttribute("stroke-dashoffset", offset1);
        document.getElementById("porcentaje1").innerHTML = porcentaje + "%";
        let color1 = "#4caf50";
        if (porcentaje < 25) color1 = "#f44336";
        else if (porcentaje < 50) color1 = "#ff9800";
        circle1.setAttribute("stroke", color1);
        document.getElementById("porcentaje1").style.color = color1;
        document.getElementById("alerta1").style.display = (porcentaje < 25) ? 'block' : 'none';

        // Actualizar DOM T2
        document.getElementById("dato2").innerHTML = `Dist: ${dist2} cm<br>Llenado: ${porcentaje2}% | ${litros2} L`;
        let circle2 = document.getElementById("progress2");
        let total2 = 327.0;
        let offset2 = total2 - (porcentaje2 / 100) * total2;
        circle2.setAttribute("stroke-dashoffset", offset2);
        document.getElementById("porcentaje2").innerHTML = porcentaje2 + "%";
        let color2 = "#4caf50";
        if (porcentaje2 < 25) color2 = "#f44336";
        else if (porcentaje2 < 50) color2 = "#ff9800";
        circle2.setAttribute("stroke", color2);
        document.getElementById("porcentaje2").style.color = color2;
        document.getElementById("alerta2").style.display = (porcentaje2 < 25) ? 'block' : 'none';

        // Actualizar DOM T3 (nuevo)
        document.getElementById("dato3").innerHTML = `Dist: ${dist3} cm<br>Llenado: ${porcentaje3}% | ${litros3} L`;
        let circle3 = document.getElementById("progress3");
        let total3 = 327.0;
        let offset3 = total3 - (porcentaje3 / 100) * total3;
        circle3.setAttribute("stroke-dashoffset", offset3);
        document.getElementById("porcentaje3").innerHTML = porcentaje3 + "%";
        let color3 = "#4caf50";
        if (porcentaje3 < 25) color3 = "#f44336";
        else if (porcentaje3 < 50) color3 = "#ff9800";
        circle3.setAttribute("stroke", color3);
        document.getElementById("porcentaje3").style.color = color3;
        document.getElementById("alerta3").style.display = (porcentaje3 < 25) ? 'block' : 'none';

      } catch (e) {
        document.getElementById("dato1").innerHTML = "Error de conexión";
        document.getElementById("dato2").innerHTML = "Error de conexión";
        // Asegurar que el nuevo campo también se actualice en caso de error
        if (document.getElementById("dato3")) document.getElementById("dato3").innerHTML = "Error de conexión";
        document.getElementById("porcentaje1").innerHTML = "0%";
        document.getElementById("porcentaje2").innerHTML = "0%";
        if (document.getElementById("porcentaje3")) document.getElementById("porcentaje3").innerHTML = "0%";
        document.getElementById("progress1").setAttribute("stroke-dashoffset", 327.0);
        document.getElementById("progress2").setAttribute("stroke-dashoffset", 327.0);
        if (document.getElementById("progress3")) document.getElementById("progress3").setAttribute("stroke-dashoffset", 327.0);
        document.getElementById("progress1").setAttribute("stroke", "#2196f3");
        document.getElementById("progress2").setAttribute("stroke", "#2196f3");
        if (document.getElementById("progress3")) document.getElementById("progress3").setAttribute("stroke", "#2196f3");
        document.getElementById("porcentaje1").style.color = "#2196f3";
        document.getElementById("porcentaje2").style.color = "#2196f3";
        if (document.getElementById("porcentaje3")) document.getElementById("porcentaje3").style.color = "#2196f3";
        document.getElementById("alerta1").style.display = "none";
        document.getElementById("alerta2").style.display = "none";
        if (document.getElementById("alerta3")) document.getElementById("alerta3").style.display = "none";
      }
    }
    setInterval(actualizar, 2000);
    window.onload = actualizar;

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

