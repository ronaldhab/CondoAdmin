<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();


// Consulta principal para obtener datos del residente.
$sql_residente = "SELECT 
                        r.Nombre, 
                        r.Cedula, 
                        r.Telefono
                    FROM 
                        t_residentes r";
$resultado = mysqli_query($cone, $sql_residente);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Buscar Residente</title>
</head>

<body>
    <header>
        <div>
            <a class="header-container" href="home.php">
                <img src="img/banner.jpg" class="logo">
                <h1 class="title">Residentes</h1>
            </a>
        </div>
    </header>

    <?php include "nav_home.php"; ?>

    <main>
        <div class="residentes-container">
            <div class="container">
                <section class="tabla-container">
                    <h3>Residentes actuales</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cedula</th>
                                <th>Telefono</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Cedula']); ?></td>
                                    <td><?php echo htmlspecialchars($row['Telefono']); ?></td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </div>
            <!-- Botón para crear un nuevo residente -->
            <div class="crear-residente-container">
                <a href="crear_residente.php" class="crear-residente-boton">Crear Residente</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Samueldhb</p>
        </div>
    </footer>
</body>

</html>