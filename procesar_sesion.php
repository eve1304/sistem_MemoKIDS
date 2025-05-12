<?php
// Datos de conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$password = '';
$base_datos = 'proyecto';

// Conexión a la base de datos
$con = mysqli_connect($host, $usuario, $password, $base_datos);

// Verificar conexión
if (!$con) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Capturar los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$contraseña = $_POST['contraseña'] ?? '';

// Consulta SQL para buscar el usuario
$sql = "SELECT * FROM docentes WHERE nombre = ? AND contraseña = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $nombre, $contraseña);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si existe el usuario
if ($resultado->num_rows > 0) {
    // Credenciales válidas: redirigir al usuario
    header("Location: administrador.html");
    exit;
} else {
    // Credenciales inválidas: mostrar alerta
    echo "<script>
        alert('Usuario no encontrado');
        window.location.href = 'index.html';
    </script>";
}

// Cerrar la conexión
$stmt->close();
mysqli_close($con);
?>
