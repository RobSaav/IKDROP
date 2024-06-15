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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Producto</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url('tu_imagen.png');
        background-size: cover;
        background-repeat: no-repeat;
    }

    #formulario {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        padding: 20px;
        width: 300px;
    }

    input[type="text"] {
        width: calc(100% - 20px);
        margin-bottom: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: orange;
        border: none;
        border-radius: 5px;
        color: white;
        cursor: pointer;
    }
    </style>
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
    <div id="formulario">
        <form id="guardarForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Nombre: <input type="text" name="nombre"><br>
            Tamaño: <input type="text" name="tamaño"><br>
            Color: <input type="text" name="color"><br>
            Marca: <input type="text" name="marca"><br>
            Cantidad: <input type="text" name="cantidad"><br>
            Precio Compra: <input type="text" name="precio_compra"><br>
            Precio Venta: <input type="text" name="precio_venta"><br>
            Día Adquisición: <input type="text" id="dia_adquisicion" name="dia_adquisicion"><br>
            Proveedores: <input type="text" name="proveedores"><br>
            Ventas Totales: <input type="text" name="ventas_totales"><br>
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
    </div>

</body>

</html>