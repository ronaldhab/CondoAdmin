<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

if (isset($_POST['guardar'])) {
  $nombre = mysqli_real_escape_string($cone, $_POST['nombre']);
  $direccion = mysqli_real_escape_string($cone, $_POST['direccion']);

  // Asegurar que solo se guarden "Propietario" o "Alquiler" en Tipo_res

  $sql_insertar = "INSERT INTO t_propiedades (Nom_propiedad, Direccion)  
                      VALUES ('$nombre', 
                              '$direccion')";
  if (mysqli_query($cone, $sql_insertar)) {
    // Redirige incluyendo el ID de la propiedad en la URL.
    header("Location: propiedades.php");
    exit;
  } else {
    echo "<p>Error al agregar la propiedad: " . mysqli_error($cone) . "</p>";
  }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Propiedad</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <div>
      <a class="header-container" href="home.php">
        <img src="img/banner.jpg" class="logo">
        <h1 class="title">Crear Propiedad</h1>
      </a>
    </div>
  </header>

  <main>
    <div class="container">
      <section class="tarjeta">

        <form method="POST" class="tarjeta-container">
          <h2>Agregar Nueva Propiedad</h2>
          <!-- Campo oculto para enviar el ID de la propiedad -->
          <input type="hidden" name="id_propiedad" value="<?php echo $id_propiedad; ?>">
          <input type="text" name="nombre" placeholder="Nombre de la Propiedad" required>
          <input type="text" name="direccion" placeholder="Dirección de la Propiedad" required>
          <div class="button-container">
            <button type="submit" name="guardar" class="button-container-texto guardar">
              Guardar Propiedad
            </button><br>
            <a href="propiedades.php" class="button-container-texto danger">
              Cancelar
            </a>
          </div>
        </form>
      </section>
    </div>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2025 Samueldhb</p>
    </div>
  </footer>
</body>

</html>