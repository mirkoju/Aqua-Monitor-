💧 Aqua Monitor

Aqua Monitor es un sistema web diseñado para el monitoreo y gestión de tanques de agua en tiempo real.
Permite visualizar el estado de los tanques, registrar alertas, gestionar usuarios y mantener un historial de lecturas para facilitar el control y la toma de decisiones.

🚀 Características principales

📊 Monitoreo en tiempo real: muestra los niveles de agua de cada tanque conectado.

⚠️ Alertas automáticas: genera avisos cuando los niveles se encuentran por debajo o por encima de los umbrales definidos.

👥 Gestión de usuarios: permite registrar, modificar y eliminar usuarios con diferentes permisos.

🕓 Historial y reportes: guarda las lecturas anteriores para analizar tendencias y detectar irregularidades.

🌐 Interfaz web accesible: desarrollada en PHP y compatible con navegadores modernos.

🗄️ Base de datos integrada: utiliza MySQL para almacenar lecturas, alertas y datos de usuario.

🧩 Tecnologías utilizadas

Frontend: HTML, CSS

Backend: PHP

Base de datos: MySQL

Hardware compatible: ESP32 (para enviar datos de sensores)

📁 Estructura del proyecto
Aqua-Monitor/
├── index2.html              # Página de inicio
├── panel.php                # Panel principal de monitoreo
├── alertas.php              # Módulo de alertas
├── lectura.php              # Lectura de datos recibidos
├── recibir.php              # Recepción de datos desde ESP32
├── registrar.php            # Registro de nuevos usuarios
├── monitoreo.sql            # Script de base de datos
├── aquamonitor.png          # Logo del sistema
└── ...                      # Otros archivos complementarios

🔒 Seguridad y mantenimiento

El sistema está pensado para funcionar en redes locales o entornos controlados.
Requiere mantener actualizados los permisos de acceso a la base de datos y realizar copias de seguridad periódicas.

📸 Vista previa

<img width="1353" height="636" alt="image" src="https://github.com/user-attachments/assets/b4f2dbb7-3bc4-41a5-b939-43b0c68fae2d" />


🧠 Objetivo del proyecto

Optimizar el control de recursos hídricos mediante la automatización del monitoreo y la digitalización del registro de datos, brindando información clara y accesible para la gestión eficiente del agua.
