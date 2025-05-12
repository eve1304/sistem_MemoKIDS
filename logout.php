<?php
session_start();
session_destroy();
header('Location: sesionadmin.html'); // Redirige a la página de inicio de sesión
exit();
?>
