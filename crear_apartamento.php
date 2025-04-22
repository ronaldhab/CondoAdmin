<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

if (isset($_POST['guardar'])) {
  $nro_apartamento = mysqli_real_escape_string($cone, $_POST['nro_apartamento']);
  $id_propiedad = mysqli_real_escape_string($cone, $_POST['id_propiedad']);

  $sql_insertar = "INSERT INTO t_apartamentos (Nro_apartamento, Id_propiedad) VALUES ('$nro_apartamento', '$id_propiedad')";
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
  <title>Crear Apartamento</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <div>
      <a class="header-container" href="home.php">
        <img src="img/banner.jpg" class="logo">
        <h1 class="title">Crear Apartamento</h1>
      </a>
    </div>
  </header>

  <main>
    <div class="container">
      <section class="tarjeta">

        <form method="POST" class="tarjeta-container">
          <h2>Agregar Nuevo Apartamento</h2>
          <!-- Campo oculto para enviar el ID de la propiedad -->
          <input type="text" name="nro_apartamento" placeholder="Número del apartamento" required>
          <select name="id_propiedad" id="id_propiedad" required>
            <option value="">Seleccionar Propiedad</option>
            <?php
            $sql_propiedades = "SELECT * FROM t_propiedades";
            $resultado_propiedades = mysqli_query($cone, $sql_propiedades);
            while ($row_propiedades = mysqli_fetch_assoc($resultado_propiedades)) { ?>
              <option value="<?php echo $row_propiedades['Id_propiedad']; ?>">
                <?php echo htmlspecialchars($row_propiedades['Nom_propiedad'] . " - " . $row_propiedades['Direccion']); ?>
              </option>
            <?php } ?>
          </select>
          <div class="button-container">
            <button type="submit" name="guardar" class="button-container-texto guardar">
              Guardar
            </button><br>
            <a href="propiedades.php" class="button-container-texto">
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