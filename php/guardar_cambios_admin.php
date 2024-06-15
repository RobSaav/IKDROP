<?php
// Verificar si se recibieron los parámetros del formulario
if (isset($_POST['nombre'], $_POST['correo'], $_POST['contraseña'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

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

    // Consulta SQL para actualizar los datos del administrador
    $sql = "UPDATE administrador SET Correo='$correo', Contraseña='$contraseña' WHERE Nombre='$nombre'";
    
    // Ejecutar la consulta de actualización
    if ($conn->query($sql) === TRUE) {
        echo "Los datos del administrador fueron actualizados correctamente.";
    } else {
        echo "Error al actualizar los datos del administrador: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibieron los parámetros del formulario, redireccionar a otra página
    header("Location: otra_pagina.php");
    exit();
}
?>
