<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Borrado</title>
    <!-- Estilos CSS para el cuadro de confirmación -->
    <style>
        /* Estilos para el cuadro de confirmación */
        .confirmation-box {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        /* Estilos para el contenido del cuadro de confirmación */
        .confirmation-content {
            background-color: #fefefe;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border: 1px solid #888;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Cuadro de confirmación -->
    <div id="confirmationBox" class="confirmation-box">
        <div class="confirmation-content">
            <h2>Confirmar Borrado</h2>
            <p>¿Seguro que deseas borrar este dato?</p>
            <!-- Botones para confirmar o cancelar el borrado -->
            <button id="confirmButton" onclick="confirmarBorrado()">Sí</button>
            <button id="cancelButton" onclick="cancelarBorrado()">No</button>
        </div>
    </div>

    <!-- Script JavaScript para mostrar/ocultar el cuadro de confirmación -->
    <script>
        // Función para mostrar el cuadro de confirmación
        function mostrarConfirmacion() {
            document.getElementById('confirmationBox').style.display = 'block';
        }

        // Función para ocultar el cuadro de confirmación
        function ocultarConfirmacion() {
            document.getElementById('confirmationBox').style.display = 'none';
        }

        // Función para confirmar el borrado
        function confirmarBorrado() {
            // Aquí puedes realizar la acción de borrado
            console.log('Borrado confirmado');
            ocultarConfirmacion(); // Ocultar el cuadro de confirmación después de confirmar el borrado
        }

        // Función para cancelar el borrado
        function cancelarBorrado() {
            console.log('Borrado cancelado');
            ocultarConfirmacion(); // Ocultar el cuadro de confirmación después de cancelar el borrado
        }
    </script>
</body>
</html>
