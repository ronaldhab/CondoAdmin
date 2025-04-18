<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Equipo de Beisbol</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="container">
        <a href="home.php">
            <img src="img/banner.jpg" class="logo">
            <h1> Gestion de Equipo de Beisbol</h1>
        </div>
    </header>

    <?php
    include "nav_jugador.php";
    session_start();
    $permiso = $_SESSION['nivel_permiso'];

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($cone, $_GET['id']);
        $sql = "SELECT j.*, e.nombre_equipo, e.ruta_img_equipo
            FROM t_jugadores j
            INNER JOIN t_equipos e ON j.id_equipo = e.id_equipo
            WHERE j.id_jugador = $id";
        $resultado = mysqli_query($cone, $sql);
    } else {
        echo "<h1>Error: ID de jugador faltante.</h1>";
    }
    $row = mysqli_fetch_assoc($resultado);
    $fecha_nacimiento = $row['fecha_nacimiento_jugador'];
    $fecha_actual = new DateTime();
    $fecha_nacimiento_obj = new DateTime($fecha_nacimiento);
    $diferencia = $fecha_actual->diff($fecha_nacimiento_obj);
    $edad = $diferencia->y;

    $posiciones = [
        'P' => 'Pitcher',
        'C' => 'Catcher',
        '1B' => '1ra Base',
        '2B' => '2da Base',
        '3B' => '3ra Base',
        'IF' => 'Infield',
        'OF' => 'Outfield'
    ];

    $posicion_abreviada = $row['posicion'];
    $posicion_completa = $posiciones[$posicion_abreviada] ?? 'Posición Desconocida';

    $pagina_anterior = $row["id_equipo"];
    ?>

    <main>
        <div class="container">
            <section class="tabla-container">
                <table>
                    <tr>

                        <td>
                            <p><?php echo $row["numero"]; ?></p>
                            <h2><?php echo $row["nombre_jugador"]; ?></h2>
                            <p><?php echo $posicion_completa; ?></p>
                            <br>
                            <p>Edad: <?php echo $edad; ?> años (<?php echo $row["fecha_nacimiento_jugador"]; ?>) <?php echo $row["lugar_nacimiento_jugador"]; ?></p>
                            <p><img src="img/banderas/<?php echo strtolower($row['nacionalidad_jugador']) . '.png'; ?>" height="20" alt="<?php echo $row['nacionalidad_jugador']; ?>"> <?php echo $row['nacionalidad_jugador']; ?> </p>
                            <p>Altura:<?php echo $row["altura"]; ?>cm. | Peso:<?php echo $row["peso"]; ?>kg. </p>
                            <p>Brazo Bateo: <?php echo $row["brazo_bateo"]; ?> | Brazo Lanzamiento: <?php echo $row["brazo_lanzamiento"]; ?> </p>
                        </td>
                        <td>
                            <p>Jugador de <a href="equipo.php?id=<?php echo $row["id_equipo"]; ?>"> <b><?php echo $row["nombre_equipo"]; ?></b></a></p>
                            <a href="equipo.php?id=<?php echo $row["id_equipo"]; ?>">
                                <img src="<?php echo $row["ruta_img_equipo"]; ?>" width="150" height="150">
                            </a>
                            <?php
                            if ($permiso == 2) {
                                echo '<div class="botones-tarjeta">
                                    <a href="editar_jugador.php?id=' . $row["id_jugador"] . '">
                                    <img src="img/editar_jugador.jpg">
                                    </a>
                                    </div>';
                            }
                            if ($permiso == 3) {
                                echo '<div class="botones-tarjeta">
                                    <a href="editar_jugador.php?id=' . $row["id_jugador"] . '">
                                    <img src="img/editar_jugador.jpg">
                                    </a>
                                    <a href="eliminar_jugador.php?id=' . $row["id_jugador"] . '">
                                    <img src="img/eliminar_jugador.jpg">
                                    </a>
                                    </div>';
                            }
                            ?>
                        </td>

                    </tr>
                </table>
            </section>
        </div>
        <div class="contenedor">
            <?php
            if ($permiso >= 2) {
                echo '<a href="insertar_jugador.php">
                    <div class="button-container button-container-texto">
                    <img src="img/insertar_jugador.jpg" width="40" height="40">
                    <span>Insertar jugador</span>
                    </div>
                    </a>';
            }
            ?>
            <a href="equipo.php?id=<?php echo $pagina_anterior; ?>">
                <div class="button-container button-container-texto">
                    <img src="img/atras.jpg" width="40" height="40">
                    <span>Volver</span>
                </div>
            </a>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2024 Manuel Salas</p>
        </div>
    </footer>
</body>

</html>