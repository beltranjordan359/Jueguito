<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel 3 - Misión Secreta</title>
</head>
<body>
    <div class="contenedor">
        <h1>🏁 Nivel 3</h1>
        <p>Has completado la misión secreta.</p>
        <a href="../menu.php">Volver al menú</a>
    </div>
</body>
</html>
