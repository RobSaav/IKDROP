<?php
    // Definir las variables de conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inkdrop";

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        // Insertar datos en la tabla
        $sql = "INSERT INTO administrador (nombre, correo, contraseña) VALUES ('$nombre', '$correo', '$contraseña')";

        if ($conn->query($sql) === TRUE) {
            $response = "success";
        } else {
            $response = "error";
        }

        // Cerrar conexión
        $conn->close();
    }

    // Realizar una consulta para obtener los administradores registrados
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = "SELECT * FROM administrador";
    $result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMINISTRADORES</title>
    <link rel="icon" type="image/png" href="../assets/img/admin.png">
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
                <i class="zmdi zmdi-close btn-menu"></i> INKDROP
            </div>
            <figure class="full-width navLateral-body-tittle-menu">
                <div>
                    <img src="../assets/img/admin.png" alt="Avatar" class="img-responsive">
                </div>
                <figcaption>
                    <span>
                        <br>
                        <small>Sección de administradores</small>
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
                                ADMINISTRADORES
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">

                    </li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
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
                                    style="width: 25px; height: 25px;">
                            </div>
                            <div class="navLateral-body-cr">
                                ADMINISTRAR PRODUCTOS
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
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
                    <li class="full-width divider-menu-h"></li>
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
                                <br>
                                <small>Sección de administradores</small>
                            </span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <section class="full-width text-center" style="padding: 40px 0;">
            </div>
            <section class="full-width header-well">
                <div class="full-width header-well-icon">
                    <i class="zmdi zmdi-accounts"></i>
                </div>
                <div class="full-width header-well-text">
                    <p class="text-condensedLight">
                        Revise los administradores actuales
                    </p>
                </div>
            </section>
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                    <a href="#tabNewClient" class="mdl-tabs__tab is-active">INGRESAR ADMINISTRADOR</a>
                    <a href="#tabListClient" class="mdl-tabs__tab">LISTA DE ADMINISTRADORES</a>
                </div>
                <div class="mdl-tabs__panel is-active" id="tabNewClient">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <div class="full-width panel mdl-shadow--2dp">
                                <div class="full-width panel-tittle bg-primary text-center tittles">
                                    NUEVO ADMIN
                                </div>
                                <div class="full-width panel-content">
                                    <form id="formNewAdmin"
                                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="mdl-grid">
                                            <div class="mdl-cell mdl-cell--12-col">
                                                <legend class="text-condensedLight">
                                                    <i class="zmdi zmdi-border-color"></i> &nbsp; DATOS DEL ADMIN
                                                </legend><br>
                                            </div>
                                            <div class="mdl-cell mdl-cell--12-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="adminName"
                                                        name="nombre">
                                                    <label class="mdl-textfield__label" for="adminName">Nombre</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="password"
                                                        id="adminPassword" name="contraseña">
                                                    <label class="mdl-textfield__label"
                                                        for="adminPassword">Contraseña</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="email" id="adminEmail"
                                                        name="correo">
                                                    <label class="mdl-textfield__label" for="adminEmail">Correo
                                                        Electrónico</label>
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <button type="submit"
                                                    class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary"
                                                    id="btn-confirmAdd">
                                                    <i class="zmdi zmdi-plus"></i>
                                                </button>
                                            <div class="mdl-tooltip" for="btn-confirmAdd">Agregar administrador</div>
                                            </p>
                                        </div>
                                        <!-- Dentro del formulario -->
                                        <div id="messageContainer" class="mdl-grid text-center"
                                            style="margin-top: 20px;"></div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                .btn-icon {
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                    margin: 0;
                }

                .btn-icon img {
                    width: 20px;
                    /* Ajusta el tamaño según sea necesario */
                    height: 20px;
                    /* Ajusta el tamaño según sea necesario */
                }
                </style>

                <style>
                .btn-icon {
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                    margin: 0;
                }

                .btn-icon img {
                    width: 20px;
                    /* Ajusta el tamaño según sea necesario */
                    height: 20px;
                    /* Ajusta el tamaño según sea necesario */
                }
                </style>

                <div class="mdl-tabs__panel" id="tabListClient">
                    <div class="mdl-grid">
                        <div
                            class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
                            <div class="full-width panel mdl-shadow--2dp">
                                <div class="full-width panel-tittle bg-success text-center tittles">
                                    Lista de administradores
                                </div>
                                <div class="full-width panel-content" style="text-align: center;">
                                    <!-- Contenedor para centrar la tabla -->
                                    <div style="display: inline-block;">
                                        <!-- Tabla para mostrar los administradores -->
                                        <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                                            <thead>
                                                <tr>
                                                    <th class="mdl-data-table__cell--non-numeric">Nombre</th>
                                                    <th>Correo Electrónico</th>
                                                    <th>Borrar</th>
                                                    <th>Editar</th>
                                                    <!-- Puedes agregar más columnas según tus necesidades -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                // Iterar sobre los resultados y mostrarlos en la tabla
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td class='mdl-data-table__cell--non-numeric'>" . $row['Nombre'] . "</td>";
                                        echo "<td>" . $row['Correo'] . "</td>";
                                        // Puedes agregar más columnas aquí
                                        // Dentro del bucle while
                                        echo "<td>";
                                        // Formulario para enviar la solicitud de borrado al archivo borraradmin.php
                                        echo "<form method='post' action='borraradmin.php'>";
                                        echo "<input type='hidden' name='borrar_administrador' value='" . $row['Nombre'] . "'>";
                                        echo "<button type='submit' style='background:none; border:none; padding:0; margin:0;'><img src='../assets/img/borrar.png' alt='Borrar' style='width: 24px; height: 24px;'></button>";
                                        echo "</form>";
                                        echo "</td>";
                                        echo "<td><a href='adminedit.php?nombre=" . urlencode($row['Nombre']) . "'><button class='btn-icon'><img src='../assets/img/editar.png' alt='Editar' style='width: 24px; height: 24px;'></button></a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No hay administradores registrados</td></tr>";
                                }
                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <button type="submit" name="confirmar_salida" value="Si">Si, salir</button>
                            <button type="submit" name="confirmar_salida" value="No">No, permanecer</button>
                        </form>
                    </div>
                </div>

                <script>
                // Script de JavaScript para manejar el formulario
                $(document).ready(function() {
                    $('#btn-confirmAdd').on('click', function() {
                        var adminName = $('#adminName').val();
                        var adminPassword = $('#adminPassword').val();
                        var adminEmail = $('#adminEmail').val();

                        $.ajax({
                            url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>',
                            type: 'POST',
                            data: {
                                nombre: adminName,
                                correo: adminEmail,
                                contraseña: adminPassword
                            },
                            success: function(response) {
                                // No se muestra ningún mensaje de éxito o error
                                // Limpiar los campos del formulario después de agregar el administrador
                                $('#adminName').val('');
                                $('#adminPassword').val('');
                                $('#adminEmail').val('');
                            },
                            error: function(xhr, status, error) {
                                // No se muestra ningún mensaje de éxito o error
                                console.error('Error:', error);
                            }
                        });
                    });
                });
                </script>



</body>

</html>