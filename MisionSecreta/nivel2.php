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
    <title>Nivel 2 - Misión Secreta</title>
    <link rel="stylesheet" href="css/nivel2.css">
</head>
<body>
    <div class="contenedor">
        <h1>🧩 Nivel 2</h1>
        <p>Continúa tu avance.</p>
        <a href="nivel3.php">Siguiente nivel</a>
    </div>
    <script src="js/nivel2.js"></script>
</body>
</html>
