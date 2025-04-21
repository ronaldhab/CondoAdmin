<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

if (isset($_POST['guardar'])) {
  $nombre = mysqli_real_escape_string($cone, $_POST['nombre']);
  $cedula = mysqli_real_escape_string($cone, $_POST['cedula']);
  $telefono = mysqli_real_escape_string($cone, $_POST['telefono']);
  $tipo = mysqli_real_escape_string($cone, $_POST['tipo']);

  // Asegurar que solo se guarden "Propietario" o "Alquiler" en Tipo_res
  if ($tipo === "Propietario" || $tipo === "Alquiler") {
    $sql_insertar = "INSERT INTO t_residentes (Nombre, Cedula, Telefono, Tipo_res)  
                      VALUES ('$nombre', 
                              '$cedula', 
                              '$telefono', 
                              '$tipo')";
    if (mysqli_query($cone, $sql_insertar)) {
      // Redirige incluyendo el ID de la propiedad en la URL.
      header("Location: residentes.php?&alert=Residente añadido exitosamente");
      exit;
    } else {
      echo "<p>Error al agregar el residente: " . mysqli_error($cone) . "</p>";
    }
  } else {
    echo "<p>Error: Tipo de residente inválido.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Residente</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <div>
      <a class="header-container" href="home.php">
        <img src="img/banner.jpg" class="logo">
        <h1 class="title">Crear Residente</h1>
      </a>
    </div>
  </header>

  <main>
    <div class="container">
      <section class="tarjeta">

        <form method="POST" class="tarjeta-container">
          <h2>Agregar Nuevo Residente</h2>
          <!-- Campo oculto para enviar el ID de la propiedad -->
          <input type="hidden" name="id_propiedad" value="<?php echo $id_propiedad; ?>">
          <input type="text" name="nombre" placeholder="Nombre del Residente" required>
          <input type="text" name="cedula" placeholder="Cédula del Residente" required>
          <input type="text" name="telefono" placeholder="Teléfono del Residente" required>
          <select name="tipo" required>
            <option value="Propietario">Propietario</option>
            <option value="Alquiler">Alquiler</option>
          </select>
          <div class="button-container">
            <button type="submit" name="guardar" class="button-container-texto guardar">
              Guardar Residente
            </button><br>
            <a href="residentes.php" class="button-container-texto">
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