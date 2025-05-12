<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$usuario = 'root'; // Cambia esto si es necesario
$password = ''; // Cambia esto si es necesario
$base_datos = 'proyecto';

// Conexión a la base de datos
$con = mysqli_connect($host, $usuario, $password, $base_datos);

// Verificar conexión
if (!$con) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Capturar datos del formulario
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$edad = $_POST['edad'] ?? '';
$grado = $_POST['grado'] ?? '';
$grupo = $_POST['grupo'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';

// Validar que los campos requeridos no estén vacíos
if (empty($nombre) || empty($apellidos) || empty($edad) || empty($grado) || empty($grupo) || empty($contraseña)) {
    die("Por favor, completa todos los campos.");
}

// Crear la consulta SQL sin encriptación
$sql = "INSERT INTO docentes (nombre, apellidos, edad, grado, grupo, contraseña) VALUES (?, ?, ?, ?, ?, ?)";

// Preparar la consulta
$stmt = $con->prepare($sql);
$stmt->bind_param("ssisss", $nombre, $apellidos, $edad, $grado, $grupo, $contraseña);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Datos guardados correctamente.";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
mysqli_close($con);
?>
