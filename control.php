<?php
include "db_condominios.php"; // Conexión a la base de datos.
session_start();

// Variables para manejo de mensajes
$mensaje = "";
$error = "";

// Filtrar por mes
$mes_seleccionado = isset($_POST['mes']) ? mysqli_real_escape_string($cone, $_POST['mes']) : "";

// Consulta para obtener los meses disponibles
$sql_meses = "SELECT DISTINCT Meses FROM t_cobranzas";
$resultado_meses = mysqli_query($cone, $sql_meses);

// Consulta para filtrar residentes según el mes seleccionado
$sql_cobranzas = "SELECT c.Id_cobranza, r.Nombre, r.Cedula, c.Meses, c.Pagos, c.Nro_apartamento
                  FROM t_cobranzas c
                  JOIN t_residentes r ON c.Id_residente = r.Id_residente";
if ($mes_seleccionado) {
    $sql_cobranzas .= " WHERE c.Meses = '$mes_seleccionado'";
}
$resultado_cobranzas = mysqli_query($cone, $sql_cobranzas);

// Eliminar deuda
if (isset($_POST['eliminar'])) {
    $id_cobranza = mysqli_real_escape_string($cone, $_POST['id_cobranza']);

    $sql_delete = "DELETE FROM t_cobranzas WHERE Id_cobranza = '$id_cobranza'";

    if (mysqli_query($cone, $sql_delete)) {
        $mensaje = "Deuda eliminada exitosamente.";
    } else {
        $error = "Error al eliminar la deuda: " . mysqli_error($cone);
    }
    // Redirigir para recargar la página y evitar reenvío del formulario
    header("Location: control.php");
    exit();
}

// Editar estado de pago existente
if (isset($_POST['editar'])) {
    $id_cobranza = mysqli_real_escape_string($cone, $_POST['id_cobranza']);
    $estado_pago = mysqli_real_escape_string($cone, $_POST['estado_pago']);

    $sql_update = "UPDATE t_cobranzas SET Pagos = '$estado_pago' WHERE Id_cobranza = $id_cobranza";

    if (mysqli_query($cone, $sql_update)) {
        $mensaje = "Estado de pago actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el estado de pago: " . mysqli_error($cone);
    }
    // Redirigir para recargar la página y evitar reenvío del formulario
    header("Location: control.php");
    exit();
}

// Validar y agregar nuevo estado de pago
if (isset($_POST['agregar'])) {
    $id_residente = mysqli_real_escape_string($cone, $_POST['id_residente']);
    $mes = mysqli_real_escape_string($cone, $_POST['mes_nuevo']);
    $estado_pago = mysqli_real_escape_string($cone, $_POST['estado_pago']);
    $nro_apartamento = mysqli_real_escape_string($cone, $_POST['nro_apartamento']);

    // Verificar si el apartamento existe
    $sql_validar_apto = "SELECT * FROM t_apartamentos WHERE Nro_apartamento = '$nro_apartamento'";
    $resultado_validar_apto = mysqli_query($cone, $sql_validar_apto);

    if (mysqli_num_rows($resultado_validar_apto) > 0) {
        $sql_insert = "INSERT INTO t_cobranzas (Id_residente, Meses, Pagos, Nro_apartamento) 
                       VALUES ('$id_residente', '$mes', '$estado_pago', '$nro_apartamento')";

        if (mysqli_query($cone, $sql_insert)) {
            $mensaje = "Estado de pago añadido exitosamente.";
        } else {
            $error = "Error al agregar el estado de pago: " . mysqli_error($cone);
        }
    } else {
        $error = "El número de apartamento no existe.";
    }
    // Redirigir para recargar la página y evitar reenvío del formulario
    header("Location: control.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Control de Pagos</title>
</head>

<body>
    <header>
        <div class="container">
            <a href="home.php">
                <img src="img/banner.jpg" class="logo">
                <h1>Control de Pagos</h1>
            </a>
        </div>
    </header>

    <?php include "nav_home.php"; ?>

    <main>
        <div class="container">
            <h2>Gestión de Pagos</h2>

            <!-- Mostrar mensajes -->
            <?php if ($mensaje) { ?>
                <p class="success"><?php echo htmlspecialchars($mensaje); ?></p>
            <?php } ?>
            <?php if ($error) { ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php } ?>

            <!-- Formulario para filtrar por mes -->
            <section>
                <h3>Filtrar por Mes</h3>
                <form method="POST" class="tarjeta">
                    <label for="mes">Mes:</label>
                    <select name="mes" id="mes">
                        <option value="">Seleccionar Mes</option>
                        <?php while ($row_mes = mysqli_fetch_assoc($resultado_meses)) { ?>
                            <option value="<?php echo htmlspecialchars($row_mes['Meses']); ?>" <?php echo ($mes_seleccionado === $row_mes['Meses']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($row_mes['Meses']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="guardar">Filtrar</button>
                </form>
            </section>

            <!-- Formulario para agregar estado de pago -->
            <section>
                <h3>Añadir Estado de Pago</h3>
                <form method="POST" class="tarjeta">
                    <label for="id_residente">Residente:</label>
                    <select name="id_residente" id="id_residente" required>
                        <option value="">Seleccionar Residente</option>
                        <?php
                        $sql_residentes = "SELECT Id_residente, Nombre, Cedula FROM t_residentes";
                        $resultado_residentes = mysqli_query($cone, $sql_residentes);
                        while ($row_residente = mysqli_fetch_assoc($resultado_residentes)) { ?>
                            <option value="<?php echo $row_residente['Id_residente']; ?>">
                                <?php echo htmlspecialchars($row_residente['Nombre'] . " - " . $row_residente['Cedula']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="nro_apartamento">Número de Apartamento:</label>
                    <input type="text" id="nro_apartamento" name="nro_apartamento" required>
                    <label for="mes_nuevo">Mes:</label>
                    <select name="mes_nuevo" id="mes_nuevo" required>
                        <option value="">Seleccionar Mes</option>
                        <option value="Abril">Abril</option>
                        <option value="Mayo">Mayo</option>
                        <option value="Junio">Junio</option>
                        <option value="Julio">Julio</option>
                        <option value="Agosto">Agosto</option>
                    </select>
                    <label for="estado_pago">Estado de Pago:</label>
                    <select name="estado_pago" id="estado_pago" required>
                        <option value="Pagado">Pagado</option>
                        <option value="Deuda">Deuda</option>
                    </select>
                    <button type="submit" name="agregar" class="guardar">Añadir</button>
                </form>
            </section>

            <!-- Tabla para mostrar residentes según el mes seleccionado -->
            <section>
                <h3>Residentes del Mes: <?php echo htmlspecialchars($mes_seleccionado ? $mes_seleccionado : "Todos"); ?></h3>
                <div class="tabla-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cédula</th>
                                <th>Mes</th>
                                <th>Apartamento</th>
                                <th>Estado Actual</th>
                                <th>Nuevo Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_cobranza = mysqli_fetch_assoc($resultado_cobranzas)) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row_cobranza['Nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row_cobranza['Cedula']); ?></td>
                                    <td><?php echo htmlspecialchars($row_cobranza['Meses']); ?></td>
                                    <td><?php echo htmlspecialchars($row_cobranza['Nro_apartamento']); ?></td>
                                    <td><?php echo htmlspecialchars($row_cobranza['Pagos']); ?></td>
                                    <td>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="id_cobranza" value="<?php echo $row_cobranza['Id_cobranza']; ?>">
                                            <select name="estado_pago" required>
                                                <option value="Pagado">Pagado</option>
                                                <option value="Deuda">Deuda</option>
                                            </select>
                                    </td>
                                    <td>
                                        <button type="submit" name="editar" class="actualizar">Actualizar</button>
                                        </form>
                                        <form method="POST" style="display:inline;">
                                            <input type="hidden" name="id_cobranza" value="<?php echo $row_cobranza['Id_cobranza']; ?>">
                                            <button type="submit" name="eliminar" class="button-container-texto">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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