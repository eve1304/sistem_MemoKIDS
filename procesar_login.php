<?php
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombredelacaja"];

    // Conexión a la base de datos
    $con = mysqli_connect("localhost", "root", "", "proyecto");

    // Verificar la conexión
    if (!$con) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    // Consultar la base de datos para verificar el nombre y obtener la edad
    $sql = "SELECT edad FROM alumnos WHERE nombre = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nombre);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró el usuario
    if ($fila = mysqli_fetch_assoc($resultado)) {
        $edad = $fila['edad'];
        $_SESSION["usuario"] = $nombre;

        // Redirigir según la edad
        if ($edad >= 5 && $edad <= 7) {
            header("Location: nfacil.html");
        } elseif ($edad >= 8 && $edad <= 10) {
            header("Location: nmedio.html");
        } elseif ($edad >= 11) {
            header("Location: ndificil.html");
        }
        exit();
    } else {
        // Mostrar mensaje de error y regresar
        echo "<script>alert('Usuario incorrecto, intente de nuevo.'); window.history.back();</script>";
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
