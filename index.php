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
        <div class="container">
            <img src="img/banner.jpg" class="logo">
            <h1 class="title">Control de Condominios</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Iniciar de sesión</h2>
            <section class="tarjeta-container">
                <div class="tarjeta">
                    <form method="post" action="login.php">

                        <?php
                        if (isset(($_GET['error']))) {
                        ?>
                            <p class="error">
                                <?php echo $_GET['error'] ?>
                            </p>
                        <?php
                        }
                        ?>

                        <label for="nombre_usuario">Usuario:</label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" required>

                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>

                        <div class="button-container">
                            <div class="elemento-izquierda elemento-izquierda-texto">
                                <img src="img/inisesion.jpg" width="40" height="40">
                                <button type="submit" name="" value="iniciar_sesion">Iniciar sesión</button>
                            </div>
                            <div class="elemento-izquierda elemento-izquierda-texto">
                                <img src="img/crearusu.jpg" width="40" height="40">
                                <a href="crear_usuario.html"><button type="button">Crear usuario</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
<footer>
    <div class="container">
        <p>&copy; 2025 Samueldhb</p>
    </div>
</footer>

</html>