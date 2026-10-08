<?php
// Conexión directa a la base de datos de InfinityFree
$host = "sql208.infinityfree.com"; 
$usuario = "if0_42472418"; 
$password = "k2QMfWyxKl"; // <-- Pon aquí la contraseña de tu cuenta de InfinityFree
$dbname = "if0_42472418_JUEGUITO";

$conn = new mysqli($host, $usuario, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta del ranking
$resultado = $conn->query(
    "SELECT nombre, puntaje, tiempo, rango, puntaje_nivel1, puntaje_nivel2
     FROM usuarios
     WHERE nivel >= 3
     ORDER BY puntaje DESC, tiempo ASC
     LIMIT 2"
);

$mejores = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];

function formatearTiempo($segundos) {
    $segundos = (int) $segundos;
    $minutos = floor($segundos / 60);
    $resto = $segundos % 60;
    return str_pad($minutos, 2, "0", STR_PAD_LEFT) . ":" . str_pad($resto, 2, "0", STR_PAD_LEFT);
}

$medallas = ["🥇", "🥈", "🥉", "🏅", "🏅"];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking General</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #020024, #090979, #000428);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
        }

        .panel {
            position: relative;
            width: 750px;
            max-width: 92%;
            padding: 35px;
            border-radius: 20px;
            background: rgba(20, 20, 35, .92);
            border: 2px solid #7c3aed;
            box-shadow: 0 0 30px rgba(124, 58, 237, .5);
            backdrop-filter: blur(8px);
        }

        h1 {
            text-align: center;
            color: #c4b5fd;
            font-size: 34px;
            margin-bottom: 10px;
            letter-spacing: 2px;
        }

        .subtitulo {
            text-align: center;
            color: #ddd;
            margin-bottom: 25px;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: white;
            margin-bottom: 25px;
        }

        thead th {
            text-align: left;
            padding: 12px 10px;
            color: #c4b5fd;
            border-bottom: 2px solid #7c3aed;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tbody td {
            padding: 14px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            font-size: 16px;
        }

        tbody tr:hover {
            background: rgba(124, 58, 237, .15);
        }

        .puesto {
            font-size: 22px;
            width: 50px;
        }

        .vacio {
            text-align: center;
            color: #aaa;
            padding: 30px 0;
        }
    </style>
</head>

<body>

    <div class="panel">
        <h1>🏆 RANKING GENERAL</h1>

        <div class="subtitulo">
            Los 2 mejores agentes: mejor puntaje y menor tiempo en los 2 niveles
        </div>

        <?php if (empty($mejores)): ?>
            <div class="vacio">
                Todavía nadie ha completado los 2 niveles de la misión.
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Agente</th>
                        <th>Rango</th>
                        <th>Puntaje</th>
                        <th>Tiempo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mejores as $indice => $fila): ?>
                        <tr>
                            <td class="puesto"><?php echo $medallas[$indice] ?? ($indice + 1); ?></td>
                            <td><?php echo htmlspecialchars($fila["nombre"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($fila["rango"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo (int) $fila["puntaje"]; ?> pts</td>
                            <td><?php echo formatearTiempo($fila["tiempo"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

</body>
</html>