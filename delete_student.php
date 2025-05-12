<?php
$conn = new mysqli('localhost', 'root', '', 'proyecto');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

$sql = "DELETE FROM alumnos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    echo "Alumno eliminado correctamente.";
} else {
    echo "Error al eliminar el alumno.";
}

$conn->close();
?>
