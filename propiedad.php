<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

// Verifica si se recibió un ID en la URL o desde un formulario.
if (isset($_GET['id'])) {
    $id_propiedad = $_GET['id'];
} elseif (isset($_POST['id_propiedad'])) {
    $id_propiedad = $_POST['id_propiedad'];
} else {
    echo "ID de propiedad no proporcionado.";
    exit;
}

// Consulta para obtener los datos de la propiedad.
$sql_propiedad = "SELECT * FROM t_propiedades WHERE Id_propiedad = $id_propiedad;";
$resultado_propiedad = mysqli_query($cone, $sql_propiedad);
$row_propiedad = mysqli_fetch_assoc($resultado_propiedad);

// Consulta para obtener los residentes vinculados a la propiedad.
$sql_residentes = "SELECT 
                        r.Id_residente,
                        r.Nombre, 
                        r.Cedula, 
                        r.Telefono, 
                        r.Tipo_res AS Tipo
                    FROM 
                        t_residentes r,
                        t_cobranzas c,
                        t_apartamentos a,
                        t_propiedades p
                    WHERE
                        r.Id_residente = c.Id_residente
                        AND c.Nro_apartamento = a.Nro_apartamento
                        AND a.Id_propiedad = p.Id_propiedad 
                        AND p.Id_propiedad = $id_propiedad;";
$resultado_residentes = mysqli_query($cone, $sql_residentes);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Propiedad</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div>
            <a class="header-container" href="home.php">
                <img src="img/banner.jpg" class="logo">
                <h1 class="title">Detalle de la Propiedad</h1>
            </a>
        </div>
    </header>

    <?php include "nav_home.php"; ?>

    <main>
        <div class="contenedor">
            <a href="propiedades.php">
                <div class="button-container button-container-texto">
                    <img src="img/volver.jpg" width="40" height="40">
                    <span>Volver</span>
                </div>
            </a>
        </div>

        <div class="container">
            <section class="tabla-container">
                <table>
                    <tr>
                        <td>
                            <img src="img/propiedades.jpg" width="150" height="150">
                        </td>
                        <td>
                            <h2><?php echo $row_propiedad["Nom_propiedad"]; ?></h2>
                            <p><strong>Dirección:</strong> <?php echo $row_propiedad["Direccion"]; ?></p>
                            <p><strong>ID de la propiedad:</strong> <?php echo $row_propiedad["Id_propiedad"]; ?></p>
                        </td>
                    </tr>
                </table>

                <h2>Residentes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Teléfono</th>
                            <th>Tipo de Residente</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_residente = mysqli_fetch_assoc($resultado_residentes)) { ?>
                            <tr>
                                <td><?php echo $row_residente["Id_residente"]; ?></td>
                                <td><?php echo $row_residente["Nombre"]; ?></td>
                                <td><?php echo $row_residente["Cedula"]; ?></td>
                                <td><?php echo $row_residente["Telefono"]; ?></td>
                                <td><?php echo $row_residente["Tipo"]; ?></td>
                                <td class="botones-tarjeta">
                                    <!-- Enlace para editar residente -->
                                    <a href="editar_residente.php?id=<?php echo $row_residente["Id_residente"]; ?>&id_propiedad=<?php echo $id_propiedad; ?>">
                                        <img src="img/editar.jpg" alt="Editar">
                                    </a>
                                    <!-- Enlace para eliminar residente -->
                                    <a href="eliminar_residente.php?id=<?php echo $row_residente["Id_residente"]; ?>&id_propiedad=<?php echo $id_propiedad; ?>">
                                        <img src="img/eliminar.jpg" alt="Eliminar">
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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