<nav>
    <div class="contenedor">
        <a href="home.php">
            <div class="elemento-izquierda">
                <img src="img/home.jpg" width="40" height="40">
            </div>
        </a>
        <a href="propiedades.php">
            <div class="elemento-izquierda elemento-izquierda-texto seleccionado">
                <img src="img/propiedades.jpg" alt="Imagen 2" width="40" height="40">
                <span>Propiedades</span>
            </div>
        </a>
        <a href="control.php">
            <div class="elemento-izquierda elemento-izquierda-texto seleccionado">
                <img src="img/control.jpg" alt="Imagen 2" width="40" height="40">
                <span>Control</span>
            </div>
        </a>
        <a href="deudas.php">
            <div class="elemento-izquierda elemento-izquierda-texto">
                <img src="img/deuda.jpg" alt="Imagen 3" width="40" height="40">
                <span>Deudas</span>
            </div>
        </a>
        <a href="buscar.php">
            <div class="elemento-izquierda elemento-izquierda-texto">
                <img src="img/buscar.jpg" alt="Imagen 4" width="40" height="40">
                <span>Buscar</span>
            </div>
        </a>
        <a href="logout.php" class="elemento-derecha">
            <div class="elemento-derecha-texto">
                <span>
                    <?php
                    include "dbteams.php";
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