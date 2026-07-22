<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit();
}

include "php/conexion.php";

$id = $_SESSION["id"];
$nombre = $_SESSION["nombre"];
$usuario = $_SESSION["usuario"];
$nivel = $_SESSION["nivel"];
$puntaje = $_SESSION["puntaje"];
$rango = $_SESSION["rango"];
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Nivel 2 | Laboratorio de las Matrices</title>

<link rel="stylesheet" href="nivel2.css">

<script src="nivel2-logic.js" defer></script>

</head>

<body>

<div class="pantalla">

<!--=====================================
ENCABEZADO
======================================-->

<header class="panelSuperior">

    <div class="titulo">

        <h1>MISIÓN SECRETA</h1>

        <p>Laboratorio de las Matrices</p>

    </div>

    <div class="datosJugador">

        <div class="dato">

            <span>Agente</span>

            <strong><?php echo htmlspecialchars($nombre); ?></strong>

        </div>

        <div class="dato">

            <span>Rango</span>

            <strong><?php echo htmlspecialchars($rango); ?></strong>

        </div>

        <div class="dato">

            <span>Nivel</span>

            <strong><?php echo htmlspecialchars($nivel); ?></strong>

        </div>

    </div>

</header>

<!--=====================================
BARRA
======================================-->

<section class="barraJuego">

    <div class="cronometro">

        ⏱ Tiempo

        <div id="tiempo">05:00</div>

    </div>

    <div class="progreso">

        <p>Progreso</p>

        <div class="barra">

            <div id="avance">0%</div>

        </div>

    </div>

    <div class="puntaje">

        ⭐ Puntaje

        <div id="puntos">300</div>

    </div>

</section>

<!--=====================================
MENSAJE
======================================-->

<section class="mensajeSistema">

<div id="mensaje">

Bienvenido Agente.

Debes resolver las cuatro misiones para encontrar las pistas ocultas y desbloquear la puerta del laboratorio.

</div>

</section>

<!--=====================================
ESCENARIO
======================================-->

<section class="habitacion">

<div class="escenario">

<div class="pared"></div>

<div class="piso"></div>

<div class="cartel">

LABORATORIO DE MATRICES

</div>

<!--=========================
LIBRERO
==========================-->

<button id="librero"
class="objeto"
onclick="mision2()"></button>

<!--=========================
MESA COMPUTADORA
==========================-->

<div class="mesaComputadora"></div>

<button id="computadora"
class="objeto"
onclick="mision1()"></button>

<!--=========================
LABORATORIO
==========================-->

<button id="laboratorio"
class="objeto"
onclick="mision3()"></button>

<!--=========================
VENTANA
==========================-->

<button id="ventana"
class="objeto"
onclick="mision4()"></button>

<!--=========================
INTERRUPTOR
==========================-->

<div id="interruptor"></div>

<!--=========================
PUERTA
==========================-->

<button id="puerta"
class="objeto"
onclick="abrirPuerta()"></button>

<div id="panelLector"></div>

<!--=========================
QR CAMUFLADOS
==========================-->

<button
id="qr1"
class="qr"
onclick="leerQR1()"></button>

<button
id="qr2"
class="qr"
onclick="leerQR2()"></button>

<button
id="qr3"
class="qr"
onclick="leerQR3()"></button>

<button
id="qr4"
class="qr"
onclick="leerQR4()"></button>

</div>

</section>

<!--=====================================
MODAL MISIONES
======================================-->

<div
id="ventanaMision"
class="modal">

<div class="contenidoModal">

<h2 id="tituloMision"></h2>

<p id="preguntaMision"></p>

<div id="respuestas">

<button
class="respuesta"
onclick="respuesta(1)">
A
</button>

<button
class="respuesta"
onclick="respuesta(2)">
B
</button>

<button
class="respuesta"
onclick="respuesta(3)">
C
</button>

<button
class="respuesta"
onclick="respuesta(4)">
D
</button>

</div>

<button
class="cerrarModal"
onclick="cerrarVentana()">

Cancelar

</button>

</div>

</div>

<!--=====================================
QR
======================================-->

<div
id="ventanaQR"
class="modal">

<div class="contenidoQR">

<h2>

Pista Encontrada

</h2>

<img
id="imagenQR"
src=""
alt="QR">

<p id="mensajeQR"></p>

<button
onclick="cerrarQR()">

Continuar

</button>

</div>

</div>

<!--=====================================
PUERTA
======================================-->

<div
id="panelPuerta"
class="modal">

<div class="contenidoPuerta">

<h2>

Panel de Seguridad

</h2>

<p>

Ingrese el código secreto.

</p>

<input

type="password"

maxlength="4"

id="codigoPuerta"


<br><br>

<button

id="btnAbrir"

onclick="verificarPuerta()">

Abrir Puerta

</button>

<br><br>

<button

onclick="cerrarPuerta()">

Cancelar

</button>

</div>

</div>

<!--=====================================
FINAL
======================================-->

<div

id="pantallaFinal"

class="modal">

<div class="contenidoFinal">

<h1>

MISIÓN COMPLETADA

</h1>

<p>

Has escapado del laboratorio.

</p>

<div class="estadisticas">

<p>


<p>

Tiempo empleado

<span id="tiempoFinal"></span>

</p>

<p>

Puntaje

<span id="puntajeFinal"></span>

</p>

</div>

<form

action="actualizarNivel2.php"

method="POST">

<input

type="hidden"

name="puntaje"

id="puntajeGuardar">

<input

type="hidden"

name="tiempo"

id="tiempoGuardar">

<input

type="hidden"

name="nivel"

id="nivelGuardar">

<input

type="hidden"

name="rango"

id="rangoGuardar">

<button>

CONTINUAR

</button>

</form>

</div>

</div>

<!--=====================================
SONIDOS
======================================-->

<audio id="clic">

<source src="sonidos/click.mp3">

</audio>

<audio id="correcto">

<source src="sonidos/correcto.mp3">

</audio>

<audio id="incorrecto">

<source src="sonidos/error.mp3">

</audio>

<audio id="victoria">

<source src="sonidos/victoria.mp3">

</audio>

</div>

</body>

</html>