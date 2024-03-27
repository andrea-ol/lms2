<?php
// Iniciar sesión
session_start();
// Destruir la sesión
unset($_SESSION['username']);
// Redirigir al usuario a la página de inicio de sesión
header("Location: login.php");
exit();
?>