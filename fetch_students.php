<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'proyecto');

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$group = $_GET['group'];
$sql = "SELECT id, nombre, edad, grado, grupo FROM alumnos WHERE CONCAT(grado, ' ', grupo) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $group);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Grado</th>
                <th>Grupo</th>
                <th>Acciones</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['edad']}</td>
                <td>{$row['grado']}</td>
                <td>{$row['grupo']}</td>
                <td>
                    <button onclick=\"editStudent({$row['id']}, '{$row['nombre']}', {$row['edad']}, '{$row['grado']}', '{$row['grupo']}')\">Modificar</button>
                    <button class='delete' onclick=\"deleteStudent({$row['id']})\">Eliminar</button>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay alumnos registrados en este grupo.";
}

$conn->close();
?>
