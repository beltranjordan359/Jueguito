<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../../login.php");
    exit();
}

// Aquí se puede guardar el progreso del nivel 2 en la base de datos.
echo "Nivel 2 guardado correctamente";
