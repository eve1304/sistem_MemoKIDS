<?php
session_start(); // Inicia la sesión

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombredelacaja"];

    // Conexión a la base de datos
    $con = mysqli_connect("localhost", "root", "", "proyecto");

    // Verificar la conexión
    if (!$con) {
        die("Error en la conexión: " . mysqli_connect_error());
    }

    // Consultar la base de datos para verificar el nombre
    $sql = "SELECT nombre, grado, grupo FROM alumnos WHERE nombre = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $nombre);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Verificar si se encontró el usuario
    if ($row = mysqli_fetch_assoc($resultado)) {
        // Guardar datos del usuario en la sesión
        $_SESSION["usuario"] = [
            "nombre" => $row["nombre"],
            "grado" => $row["grado"],
            "grupo" => $row["grupo"]
        ];
        // Redirigir a la página principal
        echo "<script>window.location.href = 'principal.html';</script>";
    } else {
        echo "<script>window.onload = function() { alert('Usuario incorrecto, intente de nuevo'); window.history.back(); }</script>";
    }

    // Cerrar la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
