<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function () {
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

        $(document).ready(function () {
            // Captura el envío del formulario
            $("#guardarForm").submit(function (event) {
                // Previene el envío del formulario si confirmar() devuelve false
                if (!confirmar()) {
                    event.preventDefault();
                }
            });
        });
    </script>
</head>

<body>
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['guardar'])) {
            // Guardar cambios en el producto
            $nombre = $_POST['nombre'];
            $tamaño = $_POST['tamaño'];
            $color = $_POST['color'];
            $marca = $_POST['marca'];
            $cantidad = $_POST['cantidad'];
            $precio_compra = $_POST['precio_compra'];
            $precio_venta = $_POST['precio_venta'];
            $dia_adquisicion = $_POST['dia_adquisicion'];
            $proveedores = $_POST['proveedores'];
            $ven_tot = $_POST['ventas_totales'];

            // Preparar y ejecutar consulta SQL para actualizar el producto
            $sql = "UPDATE producto SET Tamaño='$tamaño', Color='$color', Marca='$marca', Cantidad='$cantidad', PrecioCompra='$precio_compra', PrecioVenta='$precio_venta', DiaAdquisicion='$dia_adquisicion', Proveedores='$proveedores', VenTot='$ven_tot' WHERE Nombre='$nombre'";

            if ($conn->query($sql) === TRUE) {
                // Redirige a ejemplo.php después de actualizar
                header("Location: EditarProducto.php");
                exit();
            } else {
                echo "Error al actualizar el producto: " . $conn->error;
            }
        }
    }

    if (isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];

        // Obtener información del producto
        $sql = "SELECT * FROM producto WHERE Nombre='$nombre'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Mostrar el formulario de edición
            ?>
            <form id="guardarForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmar();">
                Nombre: <input type="text" name="nombre" value="<?php echo $row['Nombre']; ?>"><br>
                Tamaño: <input type="text" name="tamaño" value="<?php echo $row['Tamaño']; ?>"><br>
                Color: <input type="text" name="color" value="<?php echo $row['Color']; ?>"><br>
                Marca: <input type="text" name="marca" value="<?php echo $row['Marca']; ?>"><br>
                Cantidad: <input type="text" name="cantidad" value="<?php echo $row['Cantidad']; ?>"><br>
                Precio Compra: <input type="text" name="precio_compra" value="<?php echo $row['PrecioCompra']; ?>"><br>
                Precio Venta: <input type="text" name="precio_venta" value="<?php echo $row['PrecioVenta']; ?>"><br>
                Día Adquisición: <input type="text" id="dia_adquisicion" name="dia_adquisicion" value="<?php echo $row['DiaAdquisicion']; ?>"><br>
                Proveedores: <input type="text" name="proveedores" value="<?php echo $row['Proveedores']; ?>"><br>
                Ventas Totales: <input type="text" name="ventas_totales" value="<?php echo $row['VenTot']; ?>"><br>
                <input type="submit" name="guardar" value="Guardar cambios">
            </form>
            <?php
        } else {
            echo "<p>No se encontró el producto \"$nombre\".</p>";
        }
    }

    // Cerrar conexión
    $conn->close();
    ?>
</body>

</html>
