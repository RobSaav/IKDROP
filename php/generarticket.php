<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Ticket</title>
    <link rel="icon" type="image/png" href="../assets/img/ticket.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../assets/img/oficina.jpg'); /* Agregamos la imagen de fondo */
            background-size: cover;
            background-position: center;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8); /* Cambiamos el color de fondo con transparencia */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .button {
            padding: 10px 20px;
            background-color: #ff7f0d; /* Cambiamos el color del botón a naranja */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #e56307; /* Cambiamos el color del botón al pasar el mouse */
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .container, .container * {
                visibility: visible;
            }

            .container {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Datos del Producto</h2>
        <?php
        // Obtener los datos del producto de la URL
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
        $color = isset($_GET['color']) ? $_GET['color'] : '';
        $marca = isset($_GET['marca']) ? $_GET['marca'] : '';
        $cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : '';
        $precioventa = isset($_GET['precioventa']) ? $_GET['precioventa'] : '';
        $preciocompra = isset($_GET['preciocompra']) ? $_GET['preciocompra'] : '';
        $diaadquisicion = isset($_GET['diaadquisicion']) ? $_GET['diaadquisicion'] : '';
        $ventot = isset($_GET['ventot']) ? $_GET['ventot'] : '';

        // Calcular el total a pagar
        $total_pagar = $ventot * $precioventa;

        // Obtener la fecha y hora actual
        $fecha_hora_actual = date('Y-m-d H:i:s');

        // Mostrar los datos del producto, el total a pagar y la fecha y hora actual
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Color:</strong> $color</p>";
        echo "<p><strong>Marca:</strong> $marca</p>";
        echo "<p><strong>Precio Venta:</strong> $precioventa</p>";
        echo "<p><strong>Día Adquisición:</strong> $diaadquisicion</p>";
        echo "<p><strong>Ventas Totales:</strong> $ventot</p>";
        echo "<p><strong>Total a Pagar:</strong> $total_pagar</p>";
        echo "<p><strong>Fecha y Hora Actual:</strong> $fecha_hora_actual</p>";
        ?>
        <button class="button" onclick="window.print()">Imprimir</button>
    </div>
</body>

</html>
