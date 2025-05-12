<?php
// Conexión a la base de datos
$con = mysqli_connect('localhost', 'root', '', 'proyecto');

// Verificar conexión
if (!$con) {
    http_response_code(500);
    echo "Error al conectar a la base de datos.";
    exit;
}

// Capturar datos del formulario
$nombre     = $_POST["nombre"]     ?? '';
$apellidos  = $_POST["apellidos"]  ?? '';
$edad       = $_POST["edad"]       ?? '';
$grado      = $_POST["grado"]      ?? '';
$grupo      = $_POST["grupo"]      ?? '';
$contraseña = $_POST["contraseña"] ?? '';

// Encriptar la contraseña
$contraseña_encriptada = password_hash($contraseña, PASSWORD_BCRYPT);

// Crear la consulta preparada
$sql = "INSERT INTO docentes (nombre, apellidos, edad, grado, grupo, contraseña) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    // Enlazar los parámetros
    mysqli_stmt_bind_param($stmt, "ssisss", 
        $nombre, 
        $apellidos, 
        $edad, 
        $grado, 
        $grupo, 
        $contraseña_encriptada
    );

    // Ejecutar la consulta
    if (mysqli_stmt_execute($stmt)) {
        echo "Datos registrados correctamente.....";
        echo "Nombre: $nombre";
        echo ".....Apellidos: $apellidos";
        echo ".....Edad: $edad";
        echo ".....Grado: $grado";
        echo ".....Grupo: $grupo";
    } else {
        http_response_code(500);
        echo "Error al ejecutar la consulta: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    http_response_code(500);
    echo "Error al preparar la consulta: " . mysqli_error($con);
}

mysqli_close($con);
?>

