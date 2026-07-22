<?php
//=====================================
// CERRAR SESIÓN
//=====================================

// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Evitar que el navegador guarde la página en caché
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirigir al inicio
header("Location: index.php");

// Finalizar el script
exit();
?>
