<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyecto');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtener los datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'], $data['nombre'], $data['edad'], $data['grado'], $data['grupo'])) {
    echo "Faltan campos obligatorios.";
    exit;
}

$id = $data['id'];
$nombre = $data['nombre'];
$edad = $data['edad'];
$grado = $data['grado'];
$grupo = $data['grupo'];

// Preparar y ejecutar la consulta
$sql = "UPDATE alumnos SET nombre = ?, edad = ?, grado = ?, grupo = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error en la preparación de la consulta: " . $conn->error;
    exit;
}

$stmt->bind_param('siisi', $nombre, $edad, $grado, $grupo, $id);

if ($stmt->execute()) {
    echo "Alumno actualizado correctamente.";
} else {
    echo "Error al actualizar el alumno: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
