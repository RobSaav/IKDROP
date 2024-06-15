<?php
// Incluir el archivo de conexión a la base de datos
include_once 'db_connection.php';

// Iniciar sesión
session_start();

// Variable para controlar la visualización de la ventana modal
$errorModalDisplay = "none";

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $nombre = $_POST['userName'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM administrador WHERE Nombre = '$nombre' AND Correo = '$correo' AND Contraseña = '$contraseña'";
    $result = mysqli_query($conn, $sql);

    // Verificar si se encontró un registro que coincide con las credenciales
    if (mysqli_num_rows($result) == 1) {
        // Iniciar sesión y redirigir al usuario a la página de inicio
        $_SESSION['usuario'] = $nombre;
        header("location: home.php");
    } else {
        // Mostrar la ventana modal de error si las credenciales son incorrectas
        $errorModalDisplay = "block";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inicio de sesión</title>
    <link rel="icon" type="imagen/png" href="../assets/img/sesion.png">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <link rel="stylesheet" href="../css/material.min.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/main.css">
    <style>
        /* Estilo personalizado para la ventana modal */
        .custom-modal {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .custom-modal h2 {
            margin-top: 0;
            color: #FF5722;
        }

        .custom-modal p {
            margin-bottom: 0;
        }

        /* Estilo para el botón de cerrar */
        .close-button {
            background-color: #FF5722;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .close-button:hover {
            background-color: #D84315;
        }
    </style>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="../js/material.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/main.js"></script>
</head>

<body>
    <div class="login-wrap cover">
        <div class="container-login">
            <p class="text-center" style="font-size: 80px;">
                <i class="zmdi zmdi-account-circle"></i>
            </p>
            <p class="text-center text-condensedLight">Ingresa con tu cuenta</p>
            <form action="index.php" method="post">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="userName" name="userName">
                    <label class="mdl-textfield__label" for="userName">Nombre</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="correo" name="correo">
                    <label class="mdl-textfield__label" for="correo">Correo</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="password" id="contraseña" name="contraseña">
                    <label class="mdl-textfield__label" for="contraseña">Contraseña</label>
                </div>
                <button type="submit" class="mdl-button mdl-js-button mdl-js-ripple-effect"
                    style="color: #3F51B5; margin: 0 auto; display: block;">
                    Entrar
                </button>
            </form>
        </div>
    </div>

    <!-- Ventana modal personalizada -->
    <div id="errorModal" class="modal" style="display: <?php echo $errorModalDisplay; ?>;">
        <div class="custom-modal">
            <h2>Error de inicio de sesión</h2>
            <p>Credenciales incorrectas. Por favor, inténtelo de nuevo.</p>
            <button class="close-button" onclick="cerrarModal()">Cerrar</button>
        </div>
    </div>

    <script>
        // Función para cerrar la ventana modal
        function cerrarModal() {
            document.getElementById('errorModal').style.display = 'none';
        }

        // Mostrar la ventana modal de error al cargar la página si es necesario
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && mysqli_num_rows($result) != 1): ?>
            $(document).ready(function() {
                $('#errorModal').show();
            });
        <?php endif; ?>
    </script>
</body>

</html>
