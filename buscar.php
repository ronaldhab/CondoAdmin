<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

// Procesar la búsqueda cuando el usuario envía un término.
$residente = null;
$meses_pagados = [];
$meses_deuda = [];
if (isset($_POST['buscar'])) {
    $cedula = mysqli_real_escape_string($cone, $_POST['cedula']); // Sanitizar entrada para mayor seguridad.

    // Consulta principal para obtener datos del residente.
    $sql_residente = "SELECT 
                        r.Nombre, 
                        r.Cedula, 
                        r.Telefono, 
                        r.Tipo_res AS Tipo, 
                        c.Pagos AS EstadoPago, 
                        a.Nro_apartamento 
                    FROM 
                        t_residentes r,
                        t_cobranzas c,
                        t_apartamentos a
                    WHERE 
                        r.Id_residente = c.Id_residente 
                        AND c.Nro_apartamento = a.Nro_apartamento 
                        AND r.Cedula = '$cedula'";
    $resultado = mysqli_query($cone, $sql_residente);

    if (mysqli_num_rows($resultado) > 0) {
        $residente = mysqli_fetch_assoc($resultado);

        // Consulta para obtener los meses pagados.
        $sql_meses_pagados = "SELECT 
                                    Meses 
                                FROM 
                                    t_cobranzas c,
                                    t_residentes r
                                WHERE
                                    r.Id_residente = c.Id_residente
                                    AND r.Cedula = '$cedula' 
                                    AND c.Pagos = 'Pagado'";
        $resultado_meses = mysqli_query($cone, $sql_meses_pagados);

        while ($row_mes = mysqli_fetch_assoc($resultado_meses)) {
            $meses_pagados[] = $row_mes['Meses'];
        }

        // Consulta para obtener los meses con deuda.
        $sql_meses_deuda = "SELECT 
                                Meses 
                            FROM 
                                t_cobranzas c,
                                t_residentes r
                            WHERE
                                r.Id_residente = c.Id_residente 
                                AND r.Cedula = '$cedula' 
                                AND c.Pagos = 'Deuda'";
        $resultado_deudas = mysqli_query($cone, $sql_meses_deuda);

        while ($row_deuda = mysqli_fetch_assoc($resultado_deudas)) {
            $meses_deuda[] = $row_deuda['Meses'];
        }
    } else {
        $error = "Residente no encontrado.";
    }
}
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
                <h1 class="title">Buscar Residente</h1>
            </a>
        </div>
    </header>

    <?php include "nav_home.php"; ?>

    <main>
        <div class="container">
            <h2>Buscar Residente</h2>
            <form method="POST">
                <label for="cedula">Cédula del Residente:</label>
                <input type="text" id="cedula" name="cedula" required>
                <button type="submit" name="buscar">Buscar</button>
            </form>

            <?php if (isset($residente)) { ?>
                <section class="tarjeta-residente">
                    <h3>Información del Residente</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($residente['Nombre']); ?></p>
                    <p><strong>Cédula:</strong> <?php echo htmlspecialchars($residente['Cedula']); ?></p>
                    <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($residente['Telefono']); ?></p>
                    <p><strong>Tipo de Residente:</strong> <?php echo htmlspecialchars($residente['Tipo']); ?></p>
                    <p><strong>Estado de Pago:</strong> <?php echo htmlspecialchars($residente['EstadoPago']); ?></p>
                    <p><strong>Nro. Apartamento:</strong> <?php echo htmlspecialchars($residente['Nro_apartamento']); ?></p>
                    <h4>Meses Pagados:</h4>
                    <?php if (!empty($meses_pagados)) { ?>
                        <ul>
                            <?php foreach ($meses_pagados as $mes) { ?>
                                <li><?php echo htmlspecialchars($mes); ?></li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>No hay meses pagados registrados.</p>
                    <?php } ?>
                    <h4>Meses con Deuda:</h4>
                    <?php if (!empty($meses_deuda)) { ?>
                        <ul>
                            <?php foreach ($meses_deuda as $mes) { ?>
                                <li><?php echo htmlspecialchars($mes); ?></li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <p>No hay meses con deuda registrados.</p>
                    <?php } ?>
                </section>
            <?php } elseif (isset($error)) { ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 Samueldhb</p>
        </div>
    </footer>
</body>

</html>