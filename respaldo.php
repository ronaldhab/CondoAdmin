<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Respaldo</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <h1>Panel de Administración</h1>
        </div>
    </header>
<main>
<div class="tarjeta">
    <div class= "tarjeta-container">
            <h2>Opciones de Respaldo</h2>
            <button id="backup-db" class="button-container-texto">Respaldar Base de Datos</button>
            <button id="backup-files" class="button-container-texto">Respaldar Archivos</button>
            <p id="backup-status"></p>
        </div></div>



        <div class="contenedor">
            <a href="home.php">
                <div class="btn-volver">
                    <img src="img/volver.jpg" width="40" height="40">
                    <span>Volver</span>
                </div>
            </a>
</main>
    <footer>
        <div class="container">
            <p>&copy; 2025 Samueldhb</p>
        </div>
    </footer>

    <script>
        $(document).ready(function () {
            $("#backup-db").click(function () {
                $.post("backup_db.php", function (response) {
                    let data = JSON.parse(response);
                    $("#backup-status").text(data.success ? data.success : data.error);
                });
            });

            $("#backup-files").click(function () {
                $.post("backup_files.php", function (response) {
                    let data = JSON.parse(response);
                    $("#backup-status").text(data.success ? data.success : data.error);
                });
            });
        });
    </script>
</body>
</html>
