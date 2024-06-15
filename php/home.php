<?php
// Iniciar sesión
session_start();

// Verificar si se ha enviado el formulario de salida
if (isset($_POST['confirmar_salida'])) {
    // Verificar si se ha confirmado la salida
    if ($_POST['confirmar_salida'] === 'Si') {
        // Si se confirma la salida, destruir la sesión y redirigir a index.php
        session_destroy();
        header("location: index.php");
    } else {
        // Si se decide permanecer, simplemente cerrar la ventana modal
        echo '<script>document.getElementById("modalSalida").style.display = "none";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio</title>
    <link rel="icon" type="imagen/png" href="../assets/img/home.png">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/material.min.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
    /* Estilos para la ventana modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .modal-content {
        padding: 20px;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-content p {
        margin: 0;
        color: #333;
        font-size: 16px;
        text-align: center;
    }

    .modal-content button {
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .modal-content button:hover {
        background-color: #555;
    }
    </style>
</head>

<body>
    <!-- navLateral -->
    <section class="full-width navLateral">
        <div class="full-width navLateral-bg btn-menu"></div>
        <div class="full-width navLateral-body">
            <div class="full-width navLateral-body-logo text-center tittles">
                <i class="zmdi zmdi-close btn-menu"></i> Inventory
            </div>
            <figure class="full-width navLateral-body-tittle-menu">
                <div>
                    <img src="../assets/img/home.png" alt="Avatar" class="img-responsive">
                </div>
                <figcaption>
                    <span>
                        <?php 
                        // Verificar si el nombre del usuario está en la sesión
                        if(isset($_SESSION['usuario'])) {
                            echo $_SESSION['usuario'];
                        } else {
                            // Si no está en la sesión, muestra un nombre por defecto
                            echo "Inicio";
                        }
                        ?><br>
                        <small>Admin</small>
                    </span>
                </figcaption>

            </figure>
            <nav class="full-width">
                <ul class="full-width list-unstyle menu-principal">
                    <li class="full-width">
                        <a href="home.php" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="zmdi zmdi-view-dashboard"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                INICIO
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <!-- Aquí van tus elementos de menú adicionales -->
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="productos.php" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="zmdi zmdi-washing-machine"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                PRODUCTOS
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="EditarProducto.php" class="full-width">
                            <div class="navLateral-body-cl">
                                <img src="../assets/img/cartulina.png" alt="Cartulina" class="nav-icon"
                                    style="width: 24px; height: 24px;">
                            </div>
                            <div class="navLateral-body-cr">
                                ADMINISTRAR PRODUCTOS
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="admins.php" class="full-width">
                            <div class="navLateral-body-cl">
                                <img src="../assets/img/gerente.png" alt="Cartulina" class="nav-icon"
                                    style="width: 24px; height: 24px;">
                            </div>
                            <div class="navLateral-body-cr">
                                ADMINISTRADORES
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="tickets.php" class="full-width">
                            <div class="navLateral-body-cl">
                                <img src="../assets/img/cuenta.png" alt="Cartulina" class="nav-icon"
                                    style="width: 24px; height: 24px;">
                            </div>
                            <div class="navLateral-body-cr">
                                TICKETS
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <a href="Reportes.php" class="full-width">
                            <div class="navLateral-body-cl">
                                <img src="../assets/img/reporte.png" alt="Cartulina" class="nav-icon"
                                    style="width: 24px; height: 24px;">
                            </div>
                            <div class="navLateral-body-cr">
                                REPORTES
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <!-- Reemplazar el icono con la imagen salida.png -->
                        <a href="#" class="full-width" onclick="mostrarModalSalida()">
                            <div class="navLateral-body-cl">
                                <img src="../assets/img/salida.png" alt="Salir" style="width: 24px; height: 24px;">
                            </div>
                            <div class="navLateral-body-cr">
                                SALIR
                            </div>
                        </a>

                    </li>
                    <li class="full-width divider-menu-h"></li>

                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">

                        <ul class="full-width menu-principal sub-menu-options">

                            <li class="full-width">
                                <a href="#!" class="full-width">
                                    <div class="navLateral-body-cl">
                                        <i class="zmdi zmdi-widgets"></i>
                                    </div>
                                    <div class="navLateral-body-cr">
                                        OPTION
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </section>
    <!-- pageContent -->
    <section class="full-width pageContent">
        <!-- navBar -->
        <div class="full-width navBar">
            <div class="full-width navBar-options">
                <i class="zmdi zmdi-swap btn-menu" id="btn-menu"></i>
                <div class="mdl-tooltip" for="btn-menu">Hide / Show MENU</div>
                <nav class="navBar-options-list">
                    <ul class="list-unstyle">
                        <li class="btn-exit" id="btn-exit">
                            <i class="zmdi zmdi-power"></i>
                            <div class="mdl-tooltip" for="btn-exit">Salir</div>
                        </li>
                        <li class="text-condensedLight noLink">
                            <span>
                                <?php 
                                // Verificar si el nombre del usuario está en la sesión
                                if(isset($_SESSION['usuario'])) {
                                    echo $_SESSION['usuario'];
                                } else {
                                    // Si no está en la sesión, muestra un nombre por defecto
                                    echo "Administrador";
                                }
                                ?><br>
                                <small>Admin</small>
                            </span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <section class="full-width text-center" style="padding: 40px 0;">
            <h3 class="text-center tittles">Menú de inicio</h3>
            <!-- Tiles -->
            <article class="full-width tile">
                <a href="admins.php">
                    <div class="tile-text">
                        <span class="text-condensedLight">
                            <br>
                            <small>Administradores</small>
                        </span>
                    </div>
                    <i class="zmdi zmdi-account tile-icon"></i>
                </a>
            </article>
            <article class="full-width tile">
                <a href="productos.php">
                    <div class="tile-text">
                        <span class="text-condensedLight">
                            <br>
                            <small>Productos</small>
                        </span>
                    </div>
                    <i class="zmdi zmdi-truck tile-icon"></i>
                </a>
            </article>
            <article class="full-width tile">
                <a href="tickets.php">
                    <div class="tile-text">
                        <span class="text-condensedLight">
                            <br>
                            <small>Tickets</small>
                        </span>
                    </div>
                    <i class="zmdi zmdi-label tile-icon"></i>
                </a>
            </article>
            <article class="full-width tile">
                <a href="Reportes.php">
                    <div class="tile-text">
                        <span class="text-condensedLight">
                            <br>
                            <small>REPORTES</small>
                        </span>
                    </div>
                    <img src="../assets/img/reporte.png" alt="Reporte" style="width: 100px; height: auto;">
                    <i class="zmdi zmdi-label tile-icon"></i>
                </a>
            </article>
        </section>

    </section>

    <!-- Scripts adicionales -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="../js/material.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/main.js"></script>

    <!-- Ventana Modal Salida -->
    <div id="modalSalida" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModalSalida()">&times;</span>
            <p>¿Seguro que quieres salir?</p>
            <form method="post">
                <input type="hidden" id="salidaConfirmada" name="salida_confirmada" value="0">
                <button type="submit" name="confirmar_salida" value="Si">Si, salir</button>
                <button type="button" onclick="permanecerEnPagina()">No, permanecer</button>
            </form>
        </div>
    </div>

    <script>
    function mostrarModalSalida() {
        document.getElementById("modalSalida").style.display = "block";
        document.getElementById("salidaConfirmada").value = "0";
    }

    function cerrarModalSalida() {
        document.getElementById("modalSalida").style.display = "none";
    }

    function permanecerEnPagina() {
        document.getElementById("salidaConfirmada").value = "1";
        document.getElementById("modalSalida").style.display = "none";
    }
    </script>
</body>

</html>