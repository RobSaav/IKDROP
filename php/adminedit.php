<?php
// Verificar si se recibió el parámetro 'nombre' en la URL
if (isset($_GET['nombre'])) {
    // Obtener el nombre del administrador de los parámetros GET
    $nombre_administrador = $_GET['nombre'];

    // Establecer los detalles de la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "inkdrop";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Si se envió el formulario de edición, procesar los datos y actualizar la base de datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        // Consulta SQL para actualizar los datos del administrador
        $sql_update = "UPDATE administrador SET Nombre='$nombre', Correo='$correo', Contraseña='$contraseña' WHERE Nombre='$nombre_administrador'";
        if ($conn->query($sql_update) === TRUE) {
            // Redirigir al usuario a la página admins.php después de editar los datos
            header("Location: admins.php");
            exit();
        } else {
            echo "Error al guardar los cambios: " . $conn->error;
        }
    }

    // Consulta SQL para obtener los datos del administrador
    $sql_select = "SELECT * FROM administrador WHERE Nombre = '$nombre_administrador'";
    $result = $conn->query($sql_select);

    // Verificar si la consulta fue exitosa
    if ($result) {
        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Obtener los datos del administrador
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];
            $correo = $row['Correo'];
            $contraseña = $row['Contraseña'];

            // Mostrar el formulario de edición con los datos del administrador
            echo "<div style='text-align: center; margin-top: 50px;'>";
            echo "<div style='max-width: 400px; margin: 0 auto; border-radius: 15px; background-color: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 30px;'>";
            echo "<form action='' method='POST'>";
            echo "<label for='nombre'>Nombre:</label><br>";
            echo "<input type='text' id='nombre' name='nombre' value='$nombre' style='margin-bottom: 20px;'><br>";
            echo "<label for='correo'>Correo:</label><br>";
            echo "<input type='text' id='correo' name='correo' value='$correo' style='margin-bottom: 20px;'><br>";
            echo "<label for='contraseña'>Contraseña:</label><br>";
            echo "<input type='password' id='contraseña' name='contraseña' value='$contraseña' style='margin-bottom: 20px;'><br>";
            echo "<input type='submit' value='Guardar Cambios' style='border: none; border-radius: 5px; background-color: #f90; color: #fff; padding: 10px 20px; cursor: pointer; margin-top: 20px;'>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "No se encontraron datos para el administrador.";
        }
    } else {
        // Mostrar el error si la consulta falla
        echo "Error en la consulta: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el parámetro 'nombre', redireccionar a otra página
    header("Location: otra_pagina.php");
    exit();
}
?>
<style>
body {
    background-image: url("../assets/img/oficina.jpg");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    height: 100vh;
    width: 100%;
}
</style>
