<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

// Inicializamos los ID.
$id_residente = null;
$id_propiedad = null;

// Verifica si se recibieron los IDs en la URL.
if (isset($_GET['id'])) {
    $id_residente = $_GET['id'];
}
if (isset($_GET['id_propiedad'])) {
    $id_propiedad = $_GET['id_propiedad'];
}

// Si no se proporciona el ID de la propiedad, manejar el caso.
if (!$id_propiedad) {
    echo "<p>Error: ID de propiedad no proporcionado.</p>";
    exit;
}

// Verifica si se confirma la eliminación.
if (isset($_POST['confirmar'])) {
    $id_residente = $_POST['id_residente'];
    $id_propiedad = $_POST['id_propiedad']; // Obtén el ID de la propiedad desde el formulario.

    // Consulta para eliminar el residente.
    $sql_eliminar = "DELETE FROM t_residentes WHERE Id_residente = $id_residente";

    if (mysqli_query($cone, $sql_eliminar)) {
        // Redirige a propiedad.php con un mensaje de éxito.
        header("Location: propiedad.php?id=$id_propiedad&msg=Residente eliminado exitosamente");
        exit;
    } else {
        echo "<p>Error al eliminar el residente: " . mysqli_error($cone) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Residente</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <div>
            <a class="header-container" href="home.php">
                <img src="img/banner.jpg" class="logo">
                <h1 class="title">Eliminar Residente</h1>
            </a>
        </div>
    </header>

    <main>
        <div class="container">
            <section class="tarjeta">
                <h2>¿Estás seguro de que deseas eliminar este residente?</h2>
                <form method="POST" class="tarjeta-container">
                    <!-- Campos ocultos para enviar los IDs -->
                    <input type="hidden" name="id_residente" value="<?php echo $id_residente; ?>">
                    <input type="hidden" name="id_propiedad" value="<?php echo $id_propiedad; ?>">
                    <div class="button-container">
                        <button type="submit" name="confirmar" class="button-container-texto">
                            <span>Confirmar</span>
                        </button>
                        <a href="propiedad.php?id=<?php echo $id_propiedad; ?>" class="button-container-texto">
                            <span>Cancelar</span>
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