<?php
header('Content-Type: text/html; charset=utf-8');

include 'con_db.php';
$conn = $conex;

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

echo "<h2>Verificación y Creación de Tablas</h2>";

// 1. Crear tabla historial_agua
$sql_historial = "CREATE TABLE IF NOT EXISTS historial_agua (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tanque_id INT NOT NULL,
  tanque VARCHAR(50),
  distancia FLOAT,
  porcentaje FLOAT,
  litros FLOAT,
  estado VARCHAR(20),
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($conn->query($sql_historial)) {
    echo "<p style='color:green;'>✓ Tabla historial_agua verificada/creada</p>";
} else {
    echo "<p style='color:red;'>✗ Error historial_agua: " . $conn->error . "</p>";
}

// 2. Crear tabla alertas_llenado
$sql_alertas = "CREATE TABLE IF NOT EXISTS alertas_llenado (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tanque_id INT,
  tanque VARCHAR(50),
  porcentaje FLOAT,
  estado VARCHAR(20),
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($conn->query($sql_alertas)) {
    echo "<p style='color:green;'>✓ Tabla alertas_llenado verificada/creada</p>";
} else {
    echo "<p style='color:red;'>✗ Error alertas_llenado: " . $conn->error . "</p>";
}

// 3. Mostrar estructura de historial_agua
echo "<h3>Estructura de historial_agua:</h3>";
$result = $conn->query("DESCRIBE historial_agua");
echo "<table border='1'>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row['Field'] . "</td><td>" . $row['Type'] . "</td><td>" . $row['Null'] . "</td></tr>";
}
echo "</table>";

// 4. Mostrar últimos registros
echo "<h3>Últimos 5 registros en historial_agua:</h3>";
$result = $conn->query("SELECT * FROM historial_agua ORDER BY id DESC LIMIT 5");
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tanque</th><th>Distancia</th><th>Porcentaje</th><th>Litros</th><th>Fecha</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['tanque'] . "</td><td>" . $row['distancia'] . "</td><td>" . $row['porcentaje'] . "</td><td>" . $row['litros'] . "</td><td>" . $row['fecha'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:orange;'>⚠ No hay registros aún</p>";
}

echo "<h3>Últimas alertas:</h3>";
$result = $conn->query("SELECT * FROM alertas_llenado ORDER BY id DESC LIMIT 5");
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Tanque</th><th>Porcentaje</th><th>Estado</th><th>Fecha</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['tanque'] . "</td><td>" . $row['porcentaje'] . "</td><td>" . $row['estado'] . "</td><td>" . $row['fecha'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:orange;'>⚠ No hay alertas aún</p>";
}

$conn->close();
?>
