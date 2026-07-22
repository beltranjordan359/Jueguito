<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login.php");
    exit();
}

// Aquí se puede guardar el progreso del nivel 1 en la base de datos.
echo "Nivel 1 guardado correctamente";
