<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Condominios</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div>
            <a class="header-container" href="home.php">
                <img src="img/banner.jpg" class="logo">
                <h1 class="title">Gestión de Propiedades</h1>
            </a>
        </div>
    </header>

    <?php
    include "nav_home.php";
    include "db_condominios.php"; // Conexión a la base de datos.
    session_start();

    // Consulta para obtener todas las propiedades.
    $sql_propiedades = "SELECT * FROM t_propiedades;";
    $resultado_propiedades = mysqli_query($cone, $sql_propiedades);
    ?>

    <main>
        <div class="container">
            <section class="widget">
                <h3>Propiedades en seguimiento</h3>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_propiedad = mysqli_fetch_assoc($resultado_propiedades)) { ?>
                            <tr>
                                <td>
                                    <a href="propiedad.php?id=<?php echo $row_propiedad["Id_propiedad"]; ?>">
                                        <img src="img/propiedades.jpg" width="60" height="60">
                                    </a>
                                </td>
                                <td>
                                    <a href="propiedad.php?id=<?php echo $row_propiedad["Id_propiedad"]; ?>">
                                        <b><?php echo $row_propiedad["Nom_propiedad"]; ?></b>
                                    </a>
                                </td>
                                <td>
                                    <?php echo $row_propiedad["Direccion"]; ?>
                                </td>
                                <td>
                                    <a href="crear_propiedad.php?id=<?php echo $row_propiedad["Id_propiedad"]; ?>">
                                        <img src="img/añadir.png" width="30" height="30">
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