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

// Preparar y ejecutar consulta SQL para la gráfica de pastel de productos y cantidades
$sql_pastel_productos_cantidades = "SELECT Nombre, Cantidad FROM producto";
$result_pastel_productos_cantidades = $conn->query($sql_pastel_productos_cantidades);

// Arreglos para almacenar los nombres de los productos y sus cantidades para la gráfica de pastel
$productos_pastel = array();
$cantidades_pastel = array();

// Verificar si la consulta retornó resultados para la gráfica de pastel de productos y cantidades
if ($result_pastel_productos_cantidades !== false && $result_pastel_productos_cantidades->num_rows > 0) {
    // Iterar sobre los resultados y almacenarlos en los arreglos
    while ($row_pastel_productos_cantidades = $result_pastel_productos_cantidades->fetch_assoc()) {
        // Almacenar los datos en los arreglos
        $productos_pastel[] = $row_pastel_productos_cantidades['Nombre'];
        $cantidades_pastel[] = $row_pastel_productos_cantidades['Cantidad'];
    }
} else {
    // No se encontraron resultados o hubo un error en la consulta para la gráfica de pastel de productos y cantidades
}

// Preparar y ejecutar consulta SQL para la gráfica de barras de productos y precios
$sql_barras_productos_precios = "SELECT Nombre, PrecioCompra, PrecioVenta FROM producto";
$result_barras_productos_precios = $conn->query($sql_barras_productos_precios);

// Arreglos para almacenar los nombres de los productos, precios de compra y precios de venta para la gráfica de barras
$productos_precios = array();
$precios_compra = array();
$precios_venta = array();

// Verificar si la consulta retornó resultados para la gráfica de barras de productos y precios
if ($result_barras_productos_precios !== false && $result_barras_productos_precios->num_rows > 0) {
    // Iterar sobre los resultados y almacenarlos en los arreglos
    while ($row_barras_productos_precios = $result_barras_productos_precios->fetch_assoc()) {
        // Almacenar los datos en los arreglos
        $productos_precios[] = $row_barras_productos_precios['Nombre'];
        $precios_compra[] = $row_barras_productos_precios['PrecioCompra'];
        $precios_venta[] = $row_barras_productos_precios['PrecioVenta'];
    }
} else {
    // No se encontraron resultados o hubo un error en la consulta para la gráfica de barras de productos y precios
}

// Preparar y ejecutar consulta SQL para la gráfica de barras de productos, marcas y cantidades
$sql_barras_productos_marcas_cantidades = "SELECT CONCAT(Nombre, ' - ', Marca) AS ProductoMarca, Cantidad FROM producto";
$result_barras_productos_marcas_cantidades = $conn->query($sql_barras_productos_marcas_cantidades);

// Arreglos para almacenar los nombres de los productos y marcas, y sus cantidades para la gráfica de barras de productos, marcas y cantidades
$productos_marcas_cantidades = array();
$cantidades_marcas = array();

// Verificar si la consulta retornó resultados para la gráfica de barras de productos, marcas y cantidades
if ($result_barras_productos_marcas_cantidades !== false && $result_barras_productos_marcas_cantidades->num_rows > 0) {
    // Iterar sobre los resultados y almacenarlos en los arreglos
    while ($row_barras_productos_marcas_cantidades = $result_barras_productos_marcas_cantidades->fetch_assoc()) {
        // Almacenar los datos en los arreglos
        $productos_marcas_cantidades[] = $row_barras_productos_marcas_cantidades['ProductoMarca'];
        $cantidades_marcas[] = $row_barras_productos_marcas_cantidades['Cantidad'];
    }
} else {
    // No se encontraron resultados o hubo un error en la consulta para la gráfica de barras de productos, marcas y cantidades
}

// Preparar y ejecutar consulta SQL para la gráfica de barras de productos, precios y ventas totales
$sql_barras_productos_precios_ventas = "SELECT Nombre, PrecioCompra, PrecioVenta, VenTot FROM producto";
$result_barras_productos_precios_ventas = $conn->query($sql_barras_productos_precios_ventas);

// Arreglos para almacenar los nombres de los productos, precios de compra, precios de venta y ventas totales para la gráfica de barras
$productos_barras = array();
$precios_compra_barras = array();
$precios_venta_barras = array();
$ventas_totales_barras = array();

// Verificar si la consulta retornó resultados para la gráfica de barras de productos, precios y ventas totales
if ($result_barras_productos_precios_ventas !== false && $result_barras_productos_precios_ventas->num_rows > 0) {
    // Iterar sobre los resultados y almacenarlos en los arreglos
    while ($row_barras_productos_precios_ventas = $result_barras_productos_precios_ventas->fetch_assoc()) {
        // Almacenar los datos en los arreglos
        $productos_barras[] = $row_barras_productos_precios_ventas['Nombre'];
        $precios_compra_barras[] = $row_barras_productos_precios_ventas['PrecioCompra'];
        $precios_venta_barras[] = $row_barras_productos_precios_ventas['PrecioVenta'];
        $ventas_totales_barras[] = $row_barras_productos_precios_ventas['VenTot'];
    }
} else {
    // No se encontraron resultados o hubo un error en la consulta para la gráfica de barras de productos, precios y ventas totales
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Productos</title>
    <link rel="icon" type="imagen/png" href="../assets/img/reporte1.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
    body {
        background-image: url('../assets/img/doficina.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        font-family: 'Roboto', sans-serif;
        /* Establecer Roboto como la fuente predeterminada */
    }

    .dropdown {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .dropdown-menu {
        position: relative;
    }

    .dropdown-menu-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        padding: 12px 16px;
        z-index: 1;
    }

    .dropdown:hover .dropdown-menu-content {
        display: block;
    }

    .dropdown-item {
        cursor: pointer;
        margin-bottom: 5px;
    }

    .custom-button {
        background-color: orange;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
    }

    .container {
        display: none;
        /* Oculta todas las secciones de gráficas por defecto */
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 20px;
    }

    canvas {
        margin-top: 20px;
    }

    .buttons-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .custom-button {
        background-color: orange;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        margin-right: 10px;
        /* Espacio entre los botones */
    }
    </style>
</head>

<body>
    <!-- Menú desplegable -->
    <div class="dropdown">
        <div class="dropdown-menu">
            <button class="custom-button">Seleccionar Gráfico</button>
            <div class="dropdown-menu-content">
                <div class="dropdown-item" data-target="productosCantidadesChartSection">Cantidades</div>
                <div class="dropdown-item" data-target="productosPreciosChartSection">Precios</div>
                <div class="dropdown-item" data-target="productosMarcasCantidadesChartSection">Marcas</div>
                <div class="dropdown-item" data-target="productosPreciosVentasChartSection">Ventas</div>
            </div>
        </div>

    </div>

    <!-- Gráfica de pastel de productos y cantidades -->
    <section id="productosCantidadesChartSection" class="container">
        <h2>Gráfica de Pastel: Productos y Cantidades</h2>
        <canvas id="productosCantidadesChart" width="400" height="400"></canvas>
    </section>

    <!-- Gráfica de barras de productos y precios -->
    <section id="productosPreciosChartSection" class="container">
        <h2>Gráfica de Barras: Productos y Precios</h2>
        <canvas id="productosPreciosChart" width="400" height="400"></canvas>
    </section>

    <!-- Gráfica de barras de productos, marcas y cantidades -->
    <section id="productosMarcasCantidadesChartSection" class="container">
        <h2>Gráfica de Barras: Productos, Marcas y Cantidades</h2>
        <canvas id="productosMarcasCantidadesChart" width="400" height="400"></canvas>
    </section>

    <!-- Gráfica de barras de productos, precios y ventas totales -->
    <section id="productosPreciosVentasChartSection" class="container">
        <h2>Gráfica de Barras: Productos, Precios y Ventas Totales</h2>
        <canvas id="productosPreciosVentasChart" width="400" height="400"></canvas>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownItems = document.querySelectorAll(".dropdown-item");
        dropdownItems.forEach(item => {
            item.addEventListener("click", function() {
                const targetId = this.getAttribute("data-target");
                const targetSection = document.getElementById(targetId);
                // Ocultar todas las secciones de gráficas
                const chartSections = document.querySelectorAll(".container");
                chartSections.forEach(section => {
                    section.style.display = "none";
                });
                // Mostrar la sección de gráfica seleccionada
                if (targetSection) {
                    targetSection.style.display = "flex";
                }
            });
        });
    });
    </script>



    <script>
    // Configurar la gráfica de pastel de productos y cantidades
    var ctxProductosCantidades = document.getElementById("productosCantidadesChart").getContext('2d');
    var productosCantidadesChart = new Chart(ctxProductosCantidades, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productos_pastel); ?>,
            datasets: [{
                label: 'Cantidad',
                data: <?php echo json_encode($cantidades_pastel); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Cantidad de productos en la tienda'
            }
        }
    });




    // Configurar la gráfica de barras de productos y precios
    var ctxProductosPrecios = document.getElementById("productosPreciosChart").getContext('2d');
    var productosPreciosChart = new Chart(ctxProductosPrecios, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productos_precios); ?>,
            datasets: [{
                label: 'Precio de Compra',
                data: <?php echo json_encode($precios_compra); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Precio de Venta',
                data: <?php echo json_encode($precios_venta); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Precios de compra y venta de productos'
            }
        }
    });

    // Configurar la gráfica de barras de productos, marcas y cantidades
    var ctxProductosMarcasCantidades = document.getElementById("productosMarcasCantidadesChart").getContext('2d');
    var productosMarcasCantidadesChart = new Chart(ctxProductosMarcasCantidades, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productos_marcas_cantidades); ?>,
            datasets: [{
                label: 'Cantidad',
                data: <?php echo json_encode($cantidades_marcas); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Cantidad de productos por marca'
            }
        }
    });

    // Configurar la gráfica de barras de productos, precios y ventas totales
    var ctxProductosPreciosVentas = document.getElementById("productosPreciosVentasChart").getContext('2d');
    var productosPreciosVentasChart = new Chart(ctxProductosPreciosVentas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($productos_barras); ?>,
            datasets: [{
                label: 'Precio de Compra',
                data: <?php echo json_encode($precios_compra_barras); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Precio de Venta',
                data: <?php echo json_encode($precios_venta_barras); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Ventas Totales',
                data: <?php echo json_encode($ventas_totales_barras); ?>,
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: true,
                text: 'Precios de compra, venta y ventas totales por producto'
            }
        }
    });
    </script>



</body>

</html>