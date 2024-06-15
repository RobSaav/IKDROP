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

// Procesar formulario y guardar datos en la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $color = $_POST['color'];
    $marca = $_POST['marca'];
    $cantidad = $_POST['cantidad'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $dia_adquisicion = $_POST['dia_adquisicion'];
    $proveedores = $_POST['proveedores'];
    $ven_tot = $_POST['ventas_totales']; // Cambiado de 'ven_tot' a 'ventas_totales'
    $codigo = $_POST['codigo']; // Nuevo campo 'Codigo'

    // Calcular descuento en base a la cantidad
    if ($cantidad > 500) {
        // Aplicar un descuento del 45%
        $descuento = 0.45;
    } elseif ($cantidad >= 400 && $cantidad < 500) {
        // Aplicar un descuento del 25%
        $descuento = 0.25;
    } elseif ($cantidad >= 300 && $cantidad < 400) {
        // Aplicar un descuento del 20%
        $descuento = 0.20;
    } elseif ($cantidad >= 200 && $cantidad < 300) {
        // Aplicar un descuento del 15%
        $descuento = 0.15;
    } elseif ($cantidad >= 100 && $cantidad < 200) {
        // Aplicar un descuento del 10%
        $descuento = 0.10;
    } else {
        // No aplicar descuento
        $descuento = 0;
    }

    // Aplicar el descuento al precio de compra
    $precio_compra_con_descuento = $precio_compra - ($precio_compra * $descuento);

    // Verificar si el dato de ventas totales es mayor que el de cantidad
    if ($ven_tot > $cantidad) {
        //echo "<p>Error: El dato de ventas totales no puede ser mayor que el de cantidad.</p>";
    } else {
        // Preparar y ejecutar consulta SQL
        $sql = "INSERT INTO producto (Nombre, Codigo, Color, Marca, Cantidad, PrecioCompra, PrecioVenta, DiaAdquisicion, Proveedores, VenTot)
        VALUES ('$nombre', '$codigo', '$color', '$marca', '$cantidad', '$precio_compra_con_descuento', '$precio_venta', '$dia_adquisicion', '$proveedores', '$ven_tot')";

        if ($conn->query($sql) === TRUE) {
            //echo "<p>Producto guardado exitosamente</p>";
        } else {
            //echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
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
        echo "<p>¡El producto se ha agregado correctamente!</p>";
        echo "</div>";
        echo "</div>";
    }
} ?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PRODUCTOS</title>
    <link rel="icon" type="image/png" href="../assets/img/bienes.png">
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

    .responsive-table-container {
        overflow-x: auto;
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
                    <img src="../assets/img/bienes.png" alt="Avatar" class="img-responsive">
                </div>
                <figcaption>
                    <span>
                        <?php 
                        // Verificar si el nombre del usuario está en la sesión
                        if(isset($_SESSION['usuario'])) {
                            echo $_SESSION['usuario'];
                        } else {
                            // Si no está en la sesión, muestra un nombre por defecto
                            echo "Productos";
                        }
                        ?><br>
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
                                    style="width: 25px; height: 25px;">
                            </div>
                            <div class="navLateral-body-cr">
                                ADMINISTRAR PRODUCTOS
                            </div>
                        </a>
                    </li>


                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width divider-menu-h"></li>
                    <li class="full-width">
                        <!-- Reemplazar el icono con la imagen salida.png -->
                        <a href="index.php" class="full-width" onclick="mostrarModalSalida()">
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
                                    echo "PRODUCTOS";
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
            </div>
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
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                <div class="mdl-tabs__tab-bar">
                    <a href="#tabNewClient" class="mdl-tabs__tab is-active">INGRESAR UN PRODUCTO</a>

                </div>
                <div class="mdl-tabs__panel is-active" id="tabNewClient">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <div class="full-width panel mdl-shadow--2dp">
                                <div class="full-width panel-tittle bg-primary text-center tittles">
                                    NUEVO PRODUCTO
                                </div>
                                <div class="full-width panel-content">
                                    <form id="formNewAdmin"
                                        action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="mdl-grid">
                                            <div class="mdl-cell mdl-cell--12-col">
                                                <legend class="text-condensedLight">
                                                    <i class="zmdi zmdi-border-color"></i> &nbsp; DATOS DEL PRODUCTO
                                                </legend><br>
                                            </div>

                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="productCode"
                                                        name="codigo" pattern="[0-9]{1,11}">
                                                    <label class="mdl-textfield__label" for="productCode">Código</label>
                                                    <span class="mdl-textfield__error">Ingrese un código válido (máximo
                                                        11 dígitos numéricos).</span>
                                                </div>
                                            </div>


                                            <div class="mdl-cell mdl-cell--12-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="productName"
                                                        name="nombre">
                                                    <label class="mdl-textfield__label text-condensedLight"
                                                        for="productName">Nombre del producto</label>
                                                </div>
                                            </div>

                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="productColor"
                                                        name="color">
                                                    <label class="mdl-textfield__label" for="productColor">Color</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text" id="productBrand"
                                                        name="marca">
                                                    <label class="mdl-textfield__label" for="productBrand">Marca</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="number"
                                                        id="productQuantity" name="cantidad">
                                                    <label class="mdl-textfield__label"
                                                        for="productQuantity">Cantidad</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="number"
                                                        id="productPurchasePrice" name="precio_compra">
                                                    <label class="mdl-textfield__label"
                                                        for="productPurchasePrice">Precio de Compra</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="number"
                                                        id="productSalePrice" name="precio_venta">
                                                    <label class="mdl-textfield__label" for="productSalePrice">Precio de
                                                        Venta</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="date"
                                                        id="productAcquisitionDate" name="dia_adquisicion">
                                                    <label class="mdl-textfield__label"
                                                        for="productAcquisitionDate"></label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="text"
                                                        id="productSuppliers" name="proveedores">
                                                    <label class="mdl-textfield__label"
                                                        for="productSuppliers">Proveedores</label>
                                                </div>
                                            </div>
                                            <div class="mdl-cell mdl-cell--6-col">
                                                <div
                                                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                                    <input class="mdl-textfield__input" type="number"
                                                        id="productTotalSales" name="ventas_totales">
                                                    <label class="mdl-textfield__label" for="productTotalSales">Ventas
                                                        Totales</label>
                                                </div>
                                            </div>
                                            <p class="text-center">
                                                <button type="submit"
                                                    class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary"
                                                    id="btn-confirmAdd">
                                                    <i class="zmdi zmdi-plus"></i>
                                                </button>
                                            <div class="mdl-tooltip" for="btn-confirmAdd">Agregar producto</div>
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

                </tbody>
                </table>

        </section>



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

        <!-- Mensaje de éxito -->
        <?php if(isset($response) && $response === "success"): ?>
        <div class="modal" id="modalSuccess">
            <div class="modal-content">
                <span class="close" onclick="cerrarModalSuccess()">&times;</span>
                <p>¡El producto se ha agregado correctamente!</p>
            </div>
        </div>
        <script>
        // Función para cerrar el modal de éxito
        function cerrarModalSuccess() {
            document.getElementById('modalSuccess').style.display = 'none';
        }
        </script>
        <?php endif; ?>

        <!-- Mensaje de error -->
        <?php if(isset($response) && $response === "error"): ?>
        <div class="modal" id="modalError">
            <div class="modal-content">
                <span class="close" onclick="cerrarModalError()">&times;</span>
                <p>Ocurrió un error al agregar el producto. Por favor, inténtalo de nuevo.</p>
            </div>
        </div>
        <script>
        // Función para cerrar el modal de error
        function cerrarModalError() {
            document.getElementById('modalError').style.display = 'none';
        }
        </script>
        <?php endif; ?>

        <!-- Ventana Modal de Éxito -->
        <div id="modalSuccess" class="modal">
            <div class="modal-content">
                <span class="close" onclick="cerrarModalSuccess()">&times;</span>
                <p>¡El producto se ha agregado correctamente!</p>
            </div>
        </div>

        <script>
        // Función para cerrar el modal de éxito
        function cerrarModalSuccess() {
            document.getElementById('modalSuccess').style.display = 'none';
        }
        </script>
        <script>
        function mostrarBorrarModal() {
            var modal = document.getElementById("borrarModal");
            modal.style.display = "block";

            var confirmarBorrado = document.getElementById("confirmarBorrado");
            confirmarBorrado.onclick = function() {
                // Aquí puedes agregar el código para realizar la acción de borrado
                // Por ejemplo, redireccionar a la página de borrado con el parámetro correcto
                modal.style.display = "none"; // Cerrar modal después de confirmar el borrado
            };

            var cancelarBorrado = document.getElementById("cancelarBorrado");
            cancelarBorrado.onclick = function() {
                modal.style.display = "none"; // Cerrar modal si se cancela el borrado
            };
        }
        </script>
</body>

</html>