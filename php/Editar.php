<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/bienes.png">
    <title>Editar Producto</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url("../assets/img/oficina.jpg");
        background-size: cover;
        background-position: center;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    #form-container {
        margin-top: 50px;
        /* Margen superior */
        margin-bottom: 30px;
        /* Margen inferior */
    }

    form {
        margin-top: 200px;
        margin-bottom: 200px;
        background-color: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 100%;
        /* Máximo ancho del formulario */
        max-height: 100%;

        width: 800px;
        /* Ancho del formulario */
        box-sizing: border-box;
        /* Evita que el padding y el borde aumenten el ancho del formulario */
    }

    .form-row {
        margin-bottom: 20px;
        /* Agrega separación entre cada fila */
        display: flex;
    }

    .form-row input[type="text"] {
        flex: 1;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-right: 10px;
        /* Añade separación entre cada casilla */
    }

    input[type="submit"] {
        margin-top: 20px;
        /* Agrega separación entre las casillas y el botón de enviar */
        background-color: orange;
        color: white;
        cursor: pointer;
        width: 200px;
        /* Hace que el botón sea más grande */
        align-self: center;
        border: none;
        border-radius: 25px;
        /* Hace que las esquinas del botón sean más redondeadas */
        padding: 15px;
        font-size: 16px;
        /* Ajusta el tamaño de la fuente para que sea proporcional al botón */
    }
    </style>
</head>

<body>
    <section>
        <div id="form-container">
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
                    $codigo = $_POST['codigo']; // Nuevo campo 'Codigo'
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
                    $sql = "UPDATE producto SET Codigo='$codigo', Tamaño='$tamaño', Color='$color', Marca='$marca', Cantidad='$cantidad', PrecioCompra='$precio_compra', PrecioVenta='$precio_venta', DiaAdquisicion='$dia_adquisicion', Proveedores='$proveedores', VenTot='$ven_tot' WHERE Nombre='$nombre'";
            
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
            <form id="guardarForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                onsubmit="return confirmar();">
                <div class="form-row">
                    <input type="text" name="codigo" value="<?php echo $row['Codigo']; ?>" placeholder="Código">
                    <!-- Nuevo campo 'Codigo' -->
                    <input type="text" name="nombre" value="<?php echo $row['Nombre']; ?>" placeholder="Nombre">
                </div>
                <div class="form-row">
                    <input type="text" name="color" value="<?php echo $row['Color']; ?>" placeholder="Color">
                    <input type="text" name="marca" value="<?php echo $row['Marca']; ?>" placeholder="Marca">
                </div>
                <div class="form-row">
                    <input type="text" name="cantidad" value="<?php echo $row['Cantidad']; ?>" placeholder="Cantidad">
                    <input type="text" name="precio_compra" value="<?php echo $row['PrecioCompra']; ?>"
                        placeholder="Precio Compra">
                </div>
                <div class="form-row">
                    <input type="text" name="precio_venta" value="<?php echo $row['PrecioVenta']; ?>"
                        placeholder="Precio Venta">
                    <input type="text" id="dia_adquisicion" name="dia_adquisicion"
                        value="<?php echo $row['DiaAdquisicion']; ?>" placeholder="Día Adquisición">
                </div>
                <div class="form-row">
                    <input type="text" name="proveedores" value="<?php echo $row['Proveedores']; ?>"
                        placeholder="Proveedores">
                    <input type="text" name="ventas_totales" value="<?php echo $row['VenTot']; ?>"
                        placeholder="Ventas Totales">
                </div>
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
    </section>
</body>

</html>