<?php
// Conexión a la base de datos
$con = mysqli_connect('localhost', 'root', '', 'proyecto');

// Verificar la conexión
if (!$con) {
    http_response_code(500);
    echo "Error al conectar a la base de datos.";
    exit;
}

// Capturar datos del formulario
$nombre = $_POST["nombre"] ?? '';
$edad = $_POST["edad"] ?? '';
$grado = $_POST["grado"] ?? '';
$grupo = $_POST["grupo"] ?? '';

// Crear el SQL
$sql = "INSERT INTO alumnos (id, nombre, edad, grado, grupo) VALUES (NULL, '$nombre', '$edad', '$grado', '$grupo')";

// Ejecutar la consulta
if (mysqli_query($con, $sql)) {
    echo "Datos registrados correctamente:\nNombre: $nombre\nEdad: $edad\nGrado: $grado\nGrupo: $grupo";
} else {
    http_response_code(500);
    echo "Error al registrar los datos: " . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>
