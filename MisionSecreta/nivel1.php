<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

include "../php/conexion.php";

$mensaje = "";
$mensajeTipo = "";
$redirigir = false;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["respuesta"])) {
    $respuesta = trim($_POST["respuesta"] ?? "");

    if (strtoupper($respuesta) === "CLAVE 1") {
        $stmt = $conn->prepare("UPDATE usuarios SET nivel = 2, rango = ?, puntaje = puntaje + 100 WHERE id = ?");
        $nuevoRango = "Agente Especial";
        $stmt->bind_param("si", $nuevoRango, $_SESSION["id"]);

        if ($stmt->execute()) {
            $_SESSION["nivel"] = 2;
            $_SESSION["rango"] = $nuevoRango;
            $_SESSION["puntaje"] = (int)$_SESSION["puntaje"] + 100;

            $mensaje = "Nivel 1 completado con éxito. Avanzando al Nivel 2...";
            $mensajeTipo = "exito";
            $redirigir = true;
        } else {
            $mensaje = "No se pudo actualizar tu progreso. Inténtalo de nuevo.";
            $mensajeTipo = "error";
        }
    } else {
        $mensaje = "Respuesta incorrecta. Inténtalo nuevamente.";
        $mensajeTipo = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel 1 - Misión Secreta</title>
    <link rel="stylesheet" href="css/nivel1.css">
</head>
<body>
    <div class="contenedor">
        <h1>🔐 Nivel 1</h1>
        <p>Completa la misión para avanzar.</p>

        <div class="panel">
            <p class="bienvenida">Agente: <?php echo htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, "UTF-8"); ?></p>
            <p class="instruccion">Ingresa la clave para completar el Nivel 1.</p>

            <?php if ($mensaje !== ""): ?>
                <div class="mensaje <?php echo htmlspecialchars($mensajeTipo, ENT_QUOTES, "UTF-8"); ?>">
                    <?php echo htmlspecialchars($mensaje, ENT_QUOTES, "UTF-8"); ?>
                </div>
            <?php endif; ?>

            <form id="nivel1-form" method="post" action="nivel1.php">
                <input type="text" name="respuesta" id="respuesta" placeholder="Escribe la respuesta" required autocomplete="off">
                <button type="submit">Comprobar respuesta</button>
            </form>

            <div class="acciones">
                <a href="nivel2.php" class="siguiente">Ir al Nivel 2</a>
            </div>
        </div>
    </div>

    <script>
        window.NIVEL1_REDIRECT = <?php echo $redirigir ? "true" : "false"; ?>;
    </script>
    <script src="js/nivel1.js"></script>
</body>
</html>
