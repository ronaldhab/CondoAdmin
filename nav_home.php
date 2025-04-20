<nav>
    <div class="contenedor">
        <a href="home.php">
            <div class="home btn">
                <img class="home_symbol" src="img/home.jpg" width="40" height="40">
            </div>
        </a>
        <a href="propiedades.php">
            <div class="nav_container">
                <img class="nav_image" src="img/propiedades.jpg" alt="Imagen 2" width="40" height="40">
                <span class="nav_text">Propiedades</span>
            </div>
        </a>
        <a href="control.php">
            <div class="nav_container">
                <img class="nav_image" src="img/control.jpg" alt="Imagen 2" width="40" height="40">
                <span class="nav_text">Control</span>
            </div>
        </a>
        <a href="deudas.php">
            <div class="nav_container">
                <img class="nav_image" src="img/deuda.jpg" alt="Imagen 3" width="40" height="40">
                <span class="nav_text">Deudas</span>
            </div>
        </a>
        <a href="buscar.php">
            <div class="nav_container">
                <img class="nav_image" src="img/buscar.jpg" alt="Imagen 4" width="40" height="40">
                <span class="nav_text">Buscar</span>
            </div>
        </a>
        <a href="logout.php" class="elemento-derecha">
            <div class="elemento-derecha-texto">
                <span>
                    <?php
                    include "db_condominios.php";
                    $sql = "select * from t_residentes";
                    $resultado = mysqli_query($cone, $sql);
                    ?>
                </span>
                <span>CONECTADO</span>
                <img src="img/logout.jpg" width="40" height="40">
            </div>
        </a>

    </div>
</nav>