<?php
$conn = new mysqli('localhost', 'root', '', 'proyecto');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtener los datos enviados
$data = json_decode(file_get_contents('php://input'), true);
$nombre = $data['nombre'];
$edad = $data['edad'];
$grado = $data['grado'];
$grupo = $data['grupo'];
$selectedGroup = $data['selectedGroup']; // Asegurarnos de que este campo exista

// Validar que el grupo ingresado coincida con el grupo seleccionado
if ($grado . ' ' . $grupo !== $selectedGroup) {
    echo "Error: El grupo ingresado no coincide con el grupo seleccionado.";
    exit();
}

// Realizar la inserción en la base de datos
$sql = "INSERT INTO alumnos (nombre, edad, grado, grupo) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('siss', $nombre, $edad, $grado, $grupo);

if ($stmt->execute()) {
    echo "Alumno agregado correctamente.";
} else {
    echo "Error al agregar el alumno.";
}

$conn->close();
?>
