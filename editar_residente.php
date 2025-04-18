<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

// Inicializamos los ID.
$id_residente = null;
$id_propiedad = null;

// Verifica si se recibieron los IDs.
if (isset($_GET['id'])) {
    $id_residente = $_GET['id'];
}
if (isset($_GET['id_propiedad'])) {
    $id_propiedad = $_GET['id_propiedad'];
}

// Si no hay un ID de propiedad, redirigir al usuario o manejar el caso.
if (!$id_propiedad) {
    echo "<p>Error: ID de propiedad no proporcionado.</p>";
    exit;
}

// Consulta para obtener la información del residente.
$sql_residente = "SELECT * FROM t_residentes WHERE Id_residente = $id_residente";
$resultado_residente = mysqli_query($cone, $sql_residente);

if ($row_residente = mysqli_fetch_assoc($resultado_residente)) {
    // Actualización de datos en la base de datos.
    if (isset($_POST['guardar'])) {
        $id_residente = $_POST['id_residente'];
        $id_propiedad = $_POST['id_propiedad']; // Obtén el ID de propiedad desde el formulario.
        $nombre = mysqli_real_escape_string($cone, $_POST['nombre']);
        $cedula = mysqli_real_escape_string($cone, $_POST['cedula']);
        $telefono = mysqli_real_escape_string($cone, $_POST['telefono']);
        $tipo = mysqli_real_escape_string($cone, $_POST['tipo']);

        // Asegurar que solo se guarden "Propietario" o "Alquiler" en Tipo_res
        if ($tipo === "Propietario" || $tipo === "Alquiler") {
            $sql_actualizar = "UPDATE t_residentes SET 
                Nombre = '$nombre', 
                Cedula = '$cedula', 
                Telefono = '$telefono', 
                Tipo_res = '$tipo' 
                WHERE Id_residente = $id_residente";

            if (mysqli_query($cone, $sql_actualizar)) {
                // Redirige incluyendo el ID de la propiedad en la URL.
                header("Location: propiedad.php?id=$id_propiedad&msg=Residente actualizado exitosamente");
                exit;
            } else {
                echo "<p>Error al actualizar el residente: " . mysqli_error($cone) . "</p>";
            }
        } else {
            echo "<p>Error: Tipo de residente inválido.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Residente</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container">
            <h1>Editar Residente</h1>
        </div>
    </header>

    <main>
        <div class="container">
            <section class="tarjeta">
                <?php if ($row_residente): ?>
                    <form method="POST" class="tarjeta-container">
                        <h2>Editar Información del Residente</h2>
                        <!-- Campos ocultos para enviar el ID del residente y la propiedad -->
                        <input type="hidden" name="id_residente" value="<?php echo $id_residente; ?>">
                        <input type="hidden" name="id_propiedad" value="<?php echo $id_propiedad; ?>">
                        <input type="text" name="nombre" value="<?php echo htmlspecialchars($row_residente['Nombre']); ?>" required>
                        <input type="text" name="cedula" value="<?php echo htmlspecialchars($row_residente['Cedula']); ?>" required>
                        <input type="text" name="telefono" value="<?php echo htmlspecialchars($row_residente['Telefono']); ?>" required>
                        <select name="tipo" required>
                            <option value="Propietario" <?php echo ($row_residente['Tipo_res'] === 'Propietario') ? 'selected' : ''; ?>>Propietario</option>
                            <option value="Alquiler" <?php echo ($row_residente['Tipo_res'] === 'Alquiler') ? 'selected' : ''; ?>>Alquiler</option>
                        </select>
                        <div class="button-container">
                            <button type="submit" name="guardar" class="button-container-texto guardar">
                                Guardar Cambios
                            </button><br>
                            <a href="propiedad.php?id=<?php echo $id_propiedad; ?>" class="button-container-texto">
                                Cancelar
                            </a>
                        </div>
                    </form>
                <?php else: ?>
                    <!-- Mensaje si no hay residente -->
                    <div class="tarjeta">
                        <h2>Residente no encontrado</h2>
                        <p>El ID proporcionado no corresponde a ningún residente existente.</p>
                        <a href="propiedad.php?id=<?php echo $id_propiedad; ?>" class="button-container-texto">
                            Volver
                        </a>
                    </div>
                <?php endif; ?>
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

