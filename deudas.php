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
            <h1>Control de Condominios</h1>
        </div>
    </header>

    <?php
    include "nav_home.php";
    session_start();
    ?>
    
    <?php
        include 'dbteams.php'; 

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
    t_residentes r
JOIN
    t_cobranzas c ON r.Id_residente = c.Id_residente
JOIN
    t_apartamentos a ON c.Nro_apartamento = a.Nro_apartamento
JOIN
    t_propiedades p ON a.Id_propiedad = p.Id_propiedad
WHERE 
    c.Pagos = 'Deuda'";

        $resultado = mysqli_query($cone, $SQL);
    ?>

    <div class="row">
    <section class="tabla-container">
        <h2>Deudas Actuales</h2>
        <center><table border="12">
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
                <?php while($row = mysqli_fetch_assoc($resultado)) { ?> 
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
        </table></center>
    </div>
    </div>
    </main>
    </body>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
        <div class="container">
            <p>&copy; 2025 Samueldhb</p>
        </div>
    </footer>
    </html>



        