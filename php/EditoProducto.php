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
    $tamaño = $_POST['tamaño'];
    $color = $_POST['color'];
    $marca = $_POST['marca'];
    $cantidad = $_POST['cantidad'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $dia_adquisicion = $_POST['dia_adquisicion'];
    $proveedores = $_POST['proveedores'];
    $ven_tot = $_POST['ventas_totales']; // Cambiado de 'ven_tot' a 'ventas_totales'

    // Preparar y ejecutar consulta SQL
    $sql = "INSERT INTO producto (Nombre, Tamaño, Color, Marca, Cantidad, PrecioCompra, PrecioVenta, DiaAdquisicion, Proveedores, VenTot)
    VALUES ('$nombre', '$tamaño', '$color', '$marca', '$cantidad', '$precio_compra', '$precio_venta', '$dia_adquisicion', '$proveedores', '$ven_tot')";

    if ($conn->query($sql) === TRUE) {
        //echo "<p>Producto guardado exitosamente</p>";
    } else {
        //echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
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

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CAMNBIO DE CARACTERES</title>
    <link rel="icon" type="image/png" href="../assets/img/bienes.png">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/material.min.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/main.css">
    <script>
    $(function() {
        $("#dia_adquisicion").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });

    function confirmar() {
        if (confirm('¿Deseas guardar los cambios y regresar a la lista de productos?')) {
            return true; // Continuar con el envío del formulario
        } else {
            // Redirige a ejemplo.php sin realizar ninguna edición
            window.location.href = 'ejemplo.php';
            return false; // Detiene el envío del formulario
        }
    }

    $(document).ready(function() {
        // Captura el envío del formulario
        $("#guardarForm").submit(function(event) {
            // Previene el envío del formulario si confirmar() devuelve false
            if (!confirmar()) {
                event.preventDefault();
            }
        });
    });
    </script>


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
                    <img src="../assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
                </div>


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
                        <a href="../client1.html" class="full-width">
                            <div class="navLateral-body-cl">
                                <i class="zmdi zmdi-washing-machine"></i>
                            </div>
                            <div class="navLateral-body-cr">
                                PRODUCTOS
                            </div>
                        </a>
                    </li>
                    <li class="full-width divider-menu-h"></li>
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
        <section class="full-width text-center" style="padding: 10px 0;">
            <section class="full-width header-well">
                <div class="full-width header-well-icon">
                    <i class="zmdi zmdi-accounts"></i>
                </div>
                <div class="full-width header-well-text">
                    <p class="text-condensedLight">
                        ¿QUÉ SALIÓ MAL?
                    </p>
                </div>
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



</body>

</html>