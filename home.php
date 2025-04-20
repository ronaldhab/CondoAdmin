<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Facturas de clientes</title>
</head>

<body>

    <header>
        <div class="container">
            <a href="home.php">
                <img src="img/banner.jpg" class="logo">
            </a>
            <h1 class="title">Control de Condominios</h1>
        </div>
    </header>

    <?php
    include "nav_home.php";
    session_start();
    ?>

    <?php
    include 'db_condominios.php';

    // Consulta SQL
    $SQL = "SELECT 
                r.Nombre, 
                r.Cedula, 
                r.Telefono, 
                p.Nom_propiedad AS Propiedad, 
                a.Nro_apartamento, 
                r.Tipo_res AS Tipo, 
                c.Meses, 
                c.Pagos
            FROM 
                t_residentes r,
                t_cobranzas c,
                t_apartamentos a,
                t_propiedades p
            WHERE
                r.Id_residente = c.Id_residente
                AND c.Nro_apartamento = a.Nro_apartamento
                AND a.Id_propiedad = p.Id_propiedad;";

    $resultado = mysqli_query($cone, $SQL);


    //Consulta para contar el total de residentes
    $SQL2 = "SELECT COUNT(*) FROM t_residentes;";
    $resultado2 = mysqli_query($cone, $SQL2);
    $row2 = mysqli_fetch_array($resultado2);
    $total_residentes = $row2[0];

    //Consulta para contar el total de propiedades
    $SQL3 = "SELECT COUNT(*) FROM t_propiedades;";
    $resultado3 = mysqli_query($cone, $SQL3);
    $row3 = mysqli_fetch_array($resultado3);
    $total_propiedades = $row3[0];

    //Consulta para contar el total de deudas
    $SQL4 = "SELECT COUNT(*) 
            FROM t_cobranzas 
            WHERE Pagos = 'Deuda';";
    $resultado4 = mysqli_query($cone, $SQL4);
    $row4 = mysqli_fetch_array($resultado4);
    $total_deudas = $row4[0];

    //Consulta para obtener las propiedades
    $SQL5 = "SELECT *
            FROM t_propiedades";
    $resultado5 = mysqli_query($cone, $SQL5);

    //Consulta para obtener los residentes deudores del mes de abril
    $SQL6 = "SELECT 
                r.Nombre, 
                r.Cedula, 
                r.Telefono, 
                p.Nom_propiedad AS Propiedad, 
                a.Nro_apartamento, 
                r.Tipo_res AS Tipo, 
                c.Meses, 
                c.Pagos
            FROM 
                t_residentes r,
                t_cobranzas c,
                t_apartamentos a,
                t_propiedades p
            WHERE
                r.Id_residente = c.Id_residente
                AND c.Nro_apartamento = a.Nro_apartamento
                AND a.Id_propiedad = p.Id_propiedad
                AND c.Pagos = 'Deuda'";
    $deudores = mysqli_query($cone, $SQL6);
    ?>

    <main class="main-content">
        <div class="overview">
            <div class="overview-card">
                <h3>Total Propiedades</h3>
                <span class="value"><?php echo $total_propiedades; ?></span>
            </div>
            <div class="overview-card">
                <h3>Residentes Activos</h3>
                <span class="value"><?php echo $total_residentes; ?></span>
            </div>
            <div class="overview-card">
                <h3>Pagos Pendientes</h3>
                <span class="value"><?php echo $total_deudas; ?></span>
            </div>
        </div>

        <div class="content-area">
            <div class="widget">
                <h3>Propiedades Recientes</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la propiedad</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row5 = mysqli_fetch_assoc($resultado5)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row5['Id_propiedad']); ?></td>
                                <td><?php echo htmlspecialchars($row5['Nom_propiedad']); ?></td>
                                <td><?php echo htmlspecialchars($row5['Direccion']); ?></td>
                                <td><a href="propiedad.php?id=<?php echo $row5["Id_propiedad"]; ?>">Ver</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="widget">
                <h3>Residentes deudores en el mes</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Propiedad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row6 = mysqli_fetch_assoc($deudores)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row6['Cedula']); ?></td>
                                <td><?php echo htmlspecialchars($row6['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row6['Telefono']); ?></td>
                                <td><?php echo htmlspecialchars($row6['Propiedad']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="row">
        <section class="widget">
            <h2>Registros más recientes</h2>
            <center>
                <table border="12">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cedula</th>
                            <th>Telefono</th>
                            <th>Propiedad</th>
                            <th>N° de Apartamento</th>
                            <th>Dueño / Alquiler</th>
                            <th>Mes actual</th>
                            <th>Pagos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultado)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['Nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['Cedula']); ?></td>
                                <td><?php echo htmlspecialchars($row['Telefono']); ?></td>
                                <td><?php echo htmlspecialchars($row['Propiedad']); ?></td>
                                <td><?php echo htmlspecialchars($row['Nro_apartamento']); ?></td>
                                <td><?php echo htmlspecialchars($row['Tipo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Meses']); ?></td>
                                <td><?php echo htmlspecialchars($row['Pagos']); ?></td>
                                </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </center>
    </div> -->
    </main>
</body>

<br><br><br><br><br><br><br><br><br><br><br><br><br>

<footer>
    <div class="container">
        <p>&copy; 2025 Samueldhb</p>
    </div>
</footer>

</html>