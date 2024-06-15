<?php
// Verificar si se recibió el parámetro 'borrar_administrador' mediante POST
if (isset($_POST['borrar_administrador'])) {
    // Obtener el nombre del administrador a borrar
    $nombre_administrador = $_POST['borrar_administrador'];

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

    // Consulta SQL para borrar el administrador
    $sql = "DELETE FROM administrador WHERE Nombre = '$nombre_administrador'";
    if ($conn->query($sql) === TRUE) {
        // Redirigir al usuario a la página admins.php después de borrar el administrador
        header("Location: admins.php");
        exit();
    } else {
        echo "Error al borrar el administrador: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    // Si no se recibió el parámetro 'borrar_administrador', redireccionar a otra página o mostrar un mensaje de error
    echo "No se recibió el parámetro 'borrar_administrador'.";
}
?>
