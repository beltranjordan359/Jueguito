<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nivel 1 - Habitación del Código Perdido</title>

<link rel="stylesheet" href="nivel1.css">

</head>

<body>


<div class="encabezado">

    <h1>MISIÓN SECRETA</h1>

    <p>Nivel 1 - Habitación del Código Perdido</p>

</div>



<!-- HISTORIA DEL NIVEL -->

<div class="historia">

<h2>📡 NIVEL 1: LA PRIMERA SEÑAL</h2>

<p>
Un agente encontró una transmisión secreta enviada por un grupo desconocido.
La información fue protegida mediante un código simple y varias pistas ocultas.
Para avanzar deberá descifrar el mensaje inicial y encontrar la primera clave de acceso.
</p>

</div>


<div class="panelSuperior">

    <div id="cronometro">
        ⏱ Tiempo: 00:00
    </div>

</div>


<!-- BARRA DE PROGRESO -->

<div class="progreso">

<h3>⭐ Progreso de misión</h3>

<div class="barra">

<div id="avance"></div>

</div>

</div>






<div class="habitacion">

    <div class="pared"></div>

    <div class="piso"></div>


    <!-- Escritorio -->

    <div class="escritorio"></div>


    <!-- Computadora -->

    <div class="computadora"
    onclick="abrirComputadora()">

        <div class="monitor"></div>

        <div class="baseMonitor"></div>

    </div>


    <!-- Librero -->

    <div class="librero"
    onclick="abrirLibrero()">

        <div class="repisa r1"></div>
        <div class="repisa r2"></div>
        <div class="repisa r3"></div>

    </div>


    <!-- Archivador -->

    <div class="archivador"
    onclick="abrirArchivador()">

        <div class="cajon"></div>

        <div class="cajon"></div>

        <div class="cajon"></div>

    </div>


    <!-- Caja -->

    <div class="caja"
    onclick="abrirCaja()">

        <div class="tapa"></div>

    </div>


    <!-- Nota -->

    <div class="nota"
    onclick="abrirNota()">

    </div>



    <!-- Puerta -->

    <div class="puerta"
    onclick="abrirPuerta()">

        <div class="manija"></div>

    </div>



</div>





<div
id="modal"
class="modal">


<div class="contenidoModal">


<button
class="cerrar"
onclick="cerrarModal()">

×

</button>


<h2 id="tituloModal"></h2>


<div id="contenidoModal"></div>


</div>


</div>





<!-- SONIDO DE CLIC -->

<audio id="clickSound">

<source src="click.mp3" type="audio/mpeg">

</audio>






<script src="nivel1.js?v=<?php echo filemtime(__DIR__ . '/nivel1.js'); ?>"></script>






</body>

</html>