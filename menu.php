<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

include "php/conexion.php";

if (isset($_SESSION["id"])) {
    $datosUsuario = obtenerDatosUsuario($conn, (int)$_SESSION["id"]);

    if ($datosUsuario) {
        $_SESSION["nivel"] = (int)$datosUsuario["nivel"];
        $_SESSION["rango"] = $datosUsuario["rango"];
        $_SESSION["puntaje"] = (int)$datosUsuario["puntaje"];
        $_SESSION["tiempo"] = (int)$datosUsuario["tiempo"];
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Centro de Operaciones</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{

font-family:Arial, Helvetica, sans-serif;

background:linear-gradient(135deg,#020024,#090979,#000428);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

overflow:hidden;

}

/* EFECTO TECNOLÓGICO */

body::before{

content:"";

position:absolute;

width:100%;

height:100%;

background-image:

linear-gradient(rgba(255,255,255,.05) 1px,transparent 1px),

linear-gradient(90deg,rgba(255,255,255,.05) 1px,transparent 1px);

background-size:40px 40px;

opacity:.35;

}

/* CONTENEDOR */

.panel{

position:relative;

width:700px;

padding:35px;

border-radius:20px;

background:rgba(20,20,35,.92);

border:2px solid #00bfff;

box-shadow:0 0 30px rgba(0,170,255,.5);

backdrop-filter:blur(8px);

z-index:10;

}

/* TITULO */

h1{

text-align:center;

color:#00d9ff;

font-size:36px;

margin-bottom:10px;

letter-spacing:2px;

}

.subtitulo{

text-align:center;

color:#ddd;

margin-bottom:30px;

font-size:18px;

}

/* NOMBRE */

.agente{

background:#101b33;

padding:18px;

border-radius:12px;

border-left:6px solid #00d9ff;

color:white;

font-size:24px;

margin-bottom:25px;

}

/* TARJETAS */

.tarjetas{

display:grid;

grid-template-columns:repeat(3,1fr);

gap:20px;

margin-bottom:30px;

}

.tarjeta{

background:#16213e;

padding:20px;

border-radius:15px;

text-align:center;

color:white;

transition:.3s;

cursor:default;

border:1px solid #2d5cff;

}

.tarjeta:hover{

transform:translateY(-6px);

box-shadow:0 0 18px #00d9ff;

}

.titulo{

font-size:18px;

color:#00d9ff;

margin-bottom:12px;

}

.valor{

font-size:28px;

font-weight:bold;

}

/* BOTONES */

button{

width:100%;

padding:16px;

font-size:18px;

font-weight:bold;

border:none;

border-radius:10px;

cursor:pointer;

transition:.3s;

margin-top:15px;

}

.mision{

background:#00b4ff;

color:white;

}

.mision:hover{

background:#0084ff;

transform:scale(1.02);

box-shadow:0 0 15px #00d9ff;

}

.cerrar{

background:#b71c1c;

color:white;

}

.cerrar:hover{

background:#7f0000;

transform:scale(1.02);

}

.ranking{

background:#7c3aed;

color:white;

}

.ranking:hover{

background:#5b21b6;

transform:scale(1.02);

box-shadow:0 0 15px #a78bfa;

}

/* PIE */

.footer{

margin-top:25px;

text-align:center;

color:#888;

font-size:14px;

}

</style>

</head>

<body>

<div class="panel">

    <h1>🕵 CENTRO DE OPERACIONES</h1>

    <div class="subtitulo">
        Acceso concedido. Bienvenido nuevamente, agente.
    </div>

    <div class="agente">

        👤 Agente:
        <strong>
            <?php echo htmlspecialchars($_SESSION["nombre"], ENT_QUOTES, 'UTF-8'); ?>
        </strong>

    </div>

    <div class="tarjetas">

        <div class="tarjeta">

            <div class="titulo">
                👤 Usuario
            </div>

            <div class="valor">
                <?php echo htmlspecialchars($_SESSION["usuario"], ENT_QUOTES, 'UTF-8'); ?>
            </div>

        </div>

        <div class="tarjeta">

            <div class="titulo">
                ⭐ Rango
            </div>

            <div class="valor">
                <?php echo htmlspecialchars($_SESSION["rango"], ENT_QUOTES, 'UTF-8'); ?>
            </div>

        </div>

        <div class="tarjeta">

            <div class="titulo">
                🎯 Nivel
            </div>

            <div class="valor">
                <?php echo htmlspecialchars($_SESSION["nivel"], ENT_QUOTES, 'UTF-8'); ?>
            </div>

        </div>

    </div>

    <div class="tarjetas">

        <div class="tarjeta">

            <div class="titulo">
                🥇 Nivel 1
            </div>

            <div class="valor">
                <?php echo (int)($datosUsuario["puntaje_nivel1"] ?? 0); ?> pts
            </div>

        </div>

        <div class="tarjeta">

            <div class="titulo">
                🥈 Nivel 2
            </div>

            <div class="valor">
                <?php echo (int)($datosUsuario["puntaje_nivel2"] ?? 0); ?> pts
            </div>

        </div>

        <div class="tarjeta">

            <div class="titulo">
                🏆 Puntaje total
            </div>

            <div class="valor">
                <?php echo htmlspecialchars($_SESSION["puntaje"], ENT_QUOTES, 'UTF-8'); ?> pts
            </div>

        </div>

    </div>

    <?php
        $nivelActual = (int)$_SESSION["nivel"];
        if ($nivelActual < 1) {
            $nivelActual = 1;
        }
        $juegoCompletado = $nivelActual > 2;
        $paginaNivel = "nivel" . min($nivelActual, 2) . ".php";
    ?>

    <?php if ($juegoCompletado): ?>

        <div class="agente" style="text-align:center;">
            🎉 ¡Has completado los 2 niveles de la misión!
        </div>

    <?php else: ?>

        <form action="<?php echo htmlspecialchars($paginaNivel, ENT_QUOTES, 'UTF-8'); ?>">

            <button
            class="mision"
            type="submit">

                🚀 INICIAR MISIÓN

            </button>

        </form>

    <?php endif; ?>

    <form action="ranking.php">

        <button
        class="ranking"
        type="submit">

            📊 RANKING GENERAL

        </button>

    </form>

    <form action="cerrarSesion.php">

        <button
        class="cerrar"
        type="submit">

            🚪 CERRAR SESIÓN

        </button>

    </form>

    <div class="footer">

        Universidad Nacional de Chimborazo <br>

        Ingeniería en Tecnologías de la Información

    </div>

</div>

</body>

</html>