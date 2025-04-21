<?php
// archivo: crear_propiedad.php
// Incluir la conexión a la base de datos
include_once "db_condominios.php"; 
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'] ?? '';
  $direccion = $_POST['direccion'] ?? '';
  $precio = $_POST['precio'] ?? '';
  $descripcion = $_POST['descripcion'] ?? '';

  if ($nombre && $direccion && $precio && $descripcion) {
    $query = "INSERT INTO propiedades (nombre, direccion, precio, descripcion) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssds", $nombre, $direccion, $precio, $descripcion);

    if ($stmt->execute()) {
      echo "Propiedad creada exitosamente.";
    } else {
      echo "Error al crear la propiedad: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Por favor, complete todos los campos.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Propiedad</title>
</head>
<body>
  <h1>Crear Propiedad</h1>
  <form method="POST" action="crear_propiedad.php">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" required><br><br>

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" step="0.01" required><br><br>

    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="descripcion" required></textarea><br><br>

    <button type="submit">Crear Propiedad</button>
  </form>
</body>
</html>