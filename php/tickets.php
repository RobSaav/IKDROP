<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inkdrop";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Procesar formulario para borrar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borrar_producto"])) {
    $nombre_producto = $_POST["borrar_producto"];

    // Consulta SQL para borrar el producto por su nombre
    $sql_borrar = "DELETE FROM producto WHERE Nombre = '$nombre_producto'";

    if ($conn->query($sql_borrar) === TRUE) {
        // Producto borrado exitosamente
        //echo "<p>El producto '$nombre_producto' ha sido eliminado.</p>";
    } else {
        // Error al borrar el producto
        //echo "<p>Error al intentar borrar el producto: " . $conn->error . "</p>";
    }
}


// Preparar y ejecutar consulta SQL
$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

// Verificar si la consulta retornó resultados
if ($result !== false && $result->num_rows > 0) {
    // Iterar sobre los resultados y mostrarlos en la tabla
    while ($row = $result->fetch_assoc()) {
        // Procesar los resultados aquí
    }
} else {
    // No se encontraron resultados o hubo un error en la consulta
}

// Cerrar conexión
$conn->close();

  // Realizar una consulta para obtener los administradores registrados
  $conn = new mysqli($servername, $username, $password, $dbname);
  $sql = "SELECT * FROM producto";
  $result = $conn->query($sql);
?>

<!-- Mensaje de éxito -->
<?php if(isset($_POST["confirmar_salida"])) {
    if($_POST["confirmar_salida"] == "Si") {
        echo "<div class='modal' id='modalSuccess' style='display:block;'>";
        echo "<div class='modal-content'>";
        echo "<span class='close' onclick='cerrarModalSuccess()'>&times;</span>";
        //echo "<p>¡El producto se ha agregado correctamente!</p>";
        echo "</div>";
        echo "</div>";
    }
} ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TICKETS</title>
    <link rel="icon" type="image/png" href="../assets/img/ticket.png">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/material.min.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/main.css">


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
                    <img src="../assets/img/ticket.png" alt="Avatar" class="img-responsive">
                </div>
                <figcaption>
                    <span>
                        <?php 
                        // Verificar si el nombre del usuario está en la sesión
                        if(isset($_SESSION['usuario'])) {
                            echo $_SESSION['usuario'];
                        } else {
                            // Si no está en la sesión, muestra un nombre por defecto
                            echo "Tickets";
                        }
                        ?><br>
                        <small>Producto</small>
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
                                    style="width: 24px; height: 24px;">
                            </div>
                            <div class="navLateral-body-cr">
                                ADMINISTRAR PRODUCTOS
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
                </ul>
            </nav>

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
        <section class="full-width text-center" style="padding: 10px 0;">
            <section class="full-width header-well">
                <div class="full-width header-well-icon">
                    <i class="zmdi zmdi-accounts"></i>
                </div>
                <div class="full-width header-well-text">
                    <p class="text-condensedLight">
                        Revise los productos actuales
                    </p>
                </div>
            </section>
        </section>
        <div style="margin-left: 100px; margin-right: 40px;">
            <section class="container">
                <style>
                .centered {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 0 auto;
                }

                .centered th,
                .centered td {
                    border: 1px solid #dddddd;
                    padding: 8px;
                    text-align: left;
                    vertical-align: middle;
                    /* Alineación vertical al centro */
                }

                .centered th {
                    background-color: #f2f2f2;
                }

                .centered tr:nth-child(even) {
                    background-color: #f9f9f9;
                }

                .centered img {
                    width: 32px;
                    /* Modificamos el ancho de la imagen */
                    height: 32px;
                    /* Modificamos el alto de la imagen */
                    display: block;
                    /* Hacemos que la imagen sea un elemento de bloque */
                    margin: 0 auto;
                    /* Centramos horizontalmente */
                    cursor: pointer;
                    /* Cambiamos el cursor al pasar sobre la imagen para indicar que es clickeable */
                }
                </style>
                <table class="centered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>Marca</th>
                            <th>Cantidad</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Día Adquisición</th>
                            <th>Proveedores</th>
                            <th>Ventas Totales</th>
                            <th>Generar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        // Mostrar los datos del producto en la tabla
                        echo "<td>" . $row['Nombre'] . "</td>";
                        echo "<td>" . $row['Color'] . "</td>";
                        echo "<td>" . $row['Marca'] . "</td>";
                        echo "<td>" . $row['Cantidad'] . "</td>";
                        echo "<td>" . $row['PrecioCompra'] . "</td>";
                        echo "<td>" . $row['PrecioVenta'] . "</td>";
                        echo "<td>" . $row['DiaAdquisicion'] . "</td>";
                        echo "<td>" . $row['Proveedores'] . "</td>";
                        echo "<td>" . $row['VenTot'] . "</td>";
                        echo "<td>";
                        // Enlace para generar el ticket con los datos del producto
                        echo "<a href='generarticket.php?";
                        echo "nombre=" . urlencode($row['Nombre']) . "&";
                        echo "color=" . urlencode($row['Color']) . "&";
                        echo "marca=" . urlencode($row['Marca']) . "&";
                        echo "cantidad=" . urlencode($row['Cantidad']) . "&";
                        echo "preciocompra=" . urlencode($row['PrecioCompra']) . "&";
                        echo "precioventa=" . urlencode($row['PrecioVenta']) . "&";
                        echo "diaadquisicion=" . urlencode($row['DiaAdquisicion']) . "&";
                        echo "proveedores=" . urlencode($row['Proveedores']) . "&";
                        echo "ventot=" . urlencode($row['VenTot']) . "'";
                        echo ">";
                        // Imagen de ticket para generar
                        echo "<img src='../assets/img/ticket.png' alt='Generar' />";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No hay productos registrados</td></tr>";
                }
                ?>
                    </tbody>
                </table>
            </section>
        </div>
        <br>
        <br>
        <br>

        <!-- Scripts adicionales -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
        </script>
        <script src="../js/material.min.js"></script>
        <script src="../js/sweetalert2.min.js"></script>
        <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="../js/main.js"></script>


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