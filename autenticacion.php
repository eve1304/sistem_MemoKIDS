<?php
session_start();

// Redirige a la página de inicio de sesión si no hay usuario en sesión
if (!isset($_SESSION["usuario"])) {
    header("Location: sesionusuario.html");
    exit();
}
?>
