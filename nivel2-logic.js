/*=====================================================
VARIABLES GENERALES
=====================================================*/

let tiempo = 300;              // 5 minutos
let intervalo = null;

let puntaje = 300;

let progreso = 0;

let misionActual = 0;

let intentosPuerta = 0;

let puertaBloqueada = false;

let qr1Encontrado = false;
let qr2Encontrado = false;
let qr3Encontrado = false;
let qr4Encontrado = false;

let mision1Lista = false;
let mision2Lista = false;
let mision3Lista = false;
let mision4Lista = false;

/*=====================================================
PREGUNTAS
=====================================================*/

const preguntas = [

{
titulo:"Misión 1",

pregunta:"¿Qué representa el determinante de una matriz?",

opciones:[
"El número de filas.",
"Número de columnas.",
"El valor que permite conocer si una matriz es invertible.",
"Su matriz inversa."
],

correcta:3
},

{
titulo:"Misión 2",

pregunta:"¿Cuál es el objetivo principal del método de Gauss?",

opciones:[
"Multiplicar matrices.",
"Resolver sistemas de ecuaciones lineales simplificando la matriz.",
"Calcular determinantes.",
"Encontrar matrices inversas directamente."
],

correcta:2
},

{
titulo:"Misión 3",

pregunta:"Una matriz tiene inversa únicamente cuando:",

opciones:[
"Su determinante es distinto de cero.",
"Tiene más filas que columnas.",
"Todos sus elementos son positivos.",
"Es una matriz diagonal."
],

correcta:1
},

{
titulo:"Misión 4",

pregunta:"¿Cuál es la principal diferencia entre Gauss y Gauss-Jordan?",

opciones:[
"No existe diferencia.",
"Gauss solo sirve para matrices cuadradas.",
"Gauss-Jordan solo calcula determinantes.",
"Gauss termina con una matriz escalonada, mientras que Gauss-Jordan continúa hasta obtener una matriz escalonada reducida."
],

correcta:4
}

];

/*=====================================================
INICIO
=====================================================*/

window.onload = function(){

    iniciarCronometro();

    actualizarProgreso();

    document.getElementById("puntos").innerHTML = puntaje;

    document.getElementById("mensaje").innerHTML =
    "Explora el laboratorio y comienza por la computadora.";

}

/*=====================================================
CRONÓMETRO
=====================================================*/

function iniciarCronometro(){

intervalo = setInterval(function(){

tiempo--;

if(tiempo<0){

tiempo=0;

}

let minutos = Math.floor(tiempo/60);

let segundos = tiempo%60;

document.getElementById("tiempo").innerHTML=

String(minutos).padStart(2,"0")
+":"
+
String(segundos).padStart(2,"0");

/*==================================
PUNTAJE
==================================*/

if(tiempo>=180){

puntaje=300;

}

else if(tiempo>0){

puntaje=250;

}

else{

puntaje=100;

clearInterval(intervalo);

document.getElementById("mensaje").innerHTML=

"Tiempo agotado. Puedes terminar la misión, pero el puntaje quedó fijo en 100.";

}

document.getElementById("puntos").innerHTML=puntaje;

},1000);

}

/*=====================================================
PROGRESO
=====================================================*/

function actualizarProgreso(){

let porcentaje=0;

if(mision1Lista) porcentaje+=25;

if(mision2Lista) porcentaje+=25;

if(mision3Lista) porcentaje+=25;

if(mision4Lista) porcentaje+=25;

progreso=porcentaje;

document.getElementById("avance").style.width=
porcentaje+"%";

document.getElementById("avance").innerHTML=
porcentaje+"%";

}

/*=====================================================
SONIDOS
=====================================================*/

function sonido(nombre){

let audio=document.getElementById(nombre);

if(audio){

audio.currentTime=0;

audio.play();

}

}

/*=====================================================
CERRAR MODAL
=====================================================*/

function cerrarVentana(){

document.getElementById("ventanaMision").style.display="none";

}

/*=====================================================
CERRAR QR
=====================================================*/

function cerrarQR(){

document.getElementById("ventanaQR").style.display="none";

}

/*=====================================================
ABRIR PANEL PUERTA
=====================================================*/

function abrirPuerta(){

if(puertaBloqueada){

alert("La puerta quedó bloqueada por demasiados intentos.");

return;

}

if(!(qr1Encontrado&&qr2Encontrado&&qr3Encontrado&&qr4Encontrado)){

alert("Todavía faltan pistas por descubrir.");

return;

}

document.getElementById("panelPuerta").style.display="flex";

}

/*=====================================================
CERRAR PANEL
=====================================================*/

function cerrarPuerta(){

document.getElementById("panelPuerta").style.display="none";

}
/*=====================================================
MISIÓN 1
=====================================================*/

function mision1(){

if(mision1Lista){

alert("Esta misión ya fue completada.");

return;

}

misionActual=1;

document.getElementById("ventanaMision").style.display="flex";

document.getElementById("tituloMision").innerHTML=
preguntas[0].titulo;

document.getElementById("preguntaMision").innerHTML=
preguntas[0].pregunta;

let botones=document.querySelectorAll(".respuesta");

for(let i=0;i<4;i++){

botones[i].innerHTML=preguntas[0].opciones[i];

}

}

/*=====================================================
MISIÓN 2
=====================================================*/

function mision2(){

if(!mision1Lista){

alert("Primero debes completar la misión de la computadora.");

return;

}

if(mision2Lista){

alert("Esta misión ya fue completada.");

return;

}

misionActual=2;

document.getElementById("ventanaMision").style.display="flex";

document.getElementById("tituloMision").innerHTML=
preguntas[1].titulo;

document.getElementById("preguntaMision").innerHTML=
preguntas[1].pregunta;

let botones=document.querySelectorAll(".respuesta");

for(let i=0;i<4;i++){

botones[i].innerHTML=preguntas[1].opciones[i];

}

}

/*=====================================================
MISIÓN 3
=====================================================*/

function mision3(){

if(!mision2Lista){

alert("Primero completa la misión del librero.");

return;

}

if(mision3Lista){

alert("Esta misión ya fue completada.");

return;

}

misionActual=3;

document.getElementById("ventanaMision").style.display="flex";

document.getElementById("tituloMision").innerHTML=
preguntas[2].titulo;

document.getElementById("preguntaMision").innerHTML=
preguntas[2].pregunta;

let botones=document.querySelectorAll(".respuesta");

for(let i=0;i<4;i++){

botones[i].innerHTML=preguntas[2].opciones[i];

}

}

/*=====================================================
MISIÓN 4
=====================================================*/

function mision4(){

if(!mision3Lista){

alert("Primero completa la misión del laboratorio.");

return;

}

if(mision4Lista){

alert("Esta misión ya fue completada.");

return;

}

misionActual=4;

document.getElementById("ventanaMision").style.display="flex";

document.getElementById("tituloMision").innerHTML=
preguntas[3].titulo;

document.getElementById("preguntaMision").innerHTML=
preguntas[3].pregunta;

let botones=document.querySelectorAll(".respuesta");

for(let i=0;i<4;i++){

botones[i].innerHTML=preguntas[3].opciones[i];

}

}

/*=====================================================
RESPUESTA
=====================================================*/

function respuesta(opcion){

let correcta=preguntas[misionActual-1].correcta;

if(opcion===correcta){

sonido("correcto");

document.getElementById("ventanaMision").style.display="none";

switch(misionActual){

case 1:

mision1Lista=true;

document.getElementById("qr3").style.display="block";

document.getElementById("mensaje").innerHTML=

"✔ Misión completada. Pista: <br><br><b>La organización oculta información donde nunca llega la luz.</b><br><br>Busca el primer código QR.";

break;

case 2:

mision2Lista=true;

document.getElementById("qr1").style.display="block";

document.getElementById("mensaje").innerHTML=

"✔ Excelente.<br><br><b>Todo agente deja huellas en el suelo.</b><br><br>Busca el siguiente QR.";

break;

case 3:

mision3Lista=true;

document.getElementById("qr4").style.display="block";

document.getElementById("mensaje").innerHTML=

"✔ Bien hecho.<br><br><b>Observa el exterior.</b><br><br>Encuentra el siguiente QR.";

break;

case 4:

mision4Lista=true;

document.getElementById("qr2").style.display="block";

document.getElementById("mensaje").innerHTML=

"✔ Última misión completada.<br><br><b>La oscuridad oculta los secretos.</b><br><br>Busca el último QR para desbloquear la puerta.";

break;

}

actualizarProgreso();

}

else{

sonido("incorrecto");

alert("Respuesta incorrecta. Inténtalo nuevamente.");

}

}
/*=====================================================
LECTURA DE LOS QR
=====================================================*/

function mostrarQR(imagen,mensaje){

    document.getElementById("imagenQR").src=imagen;

    document.getElementById("mensajeQR").innerHTML=mensaje;

    document.getElementById("ventanaQR").style.display="flex";

}

/*=====================================================
QR 1
=====================================================*/

function leerQR1(){

if(qr1Encontrado){

alert("Ya encontraste esta pista.");

return;

}

qr1Encontrado=true;

sonido("clic");

mostrarQR(

"img/qr2.png",

"Segundo código encontrado.<br><br>"

);

}

/*=====================================================
QR 2
=====================================================*/

function leerQR2(){

if(qr2Encontrado){

alert("Ya encontraste esta pista.");

return;

}

qr2Encontrado=true;

sonido("clic");

mostrarQR(

"img/qr4.png",

"Último código encontrado.<br><br><br> Ahora ya puedes abrir la puerta.<br>"

);

}

/*=====================================================
QR 3
=====================================================*/

function leerQR3(){

if(qr3Encontrado){

alert("Ya encontraste esta pista.");

return;

}

qr3Encontrado=true;

sonido("clic");

mostrarQR(

"img/qr1.png",

"Primer código encontrado.<br><br>"

);

}

/*=====================================================
QR 4
=====================================================*/

function leerQR4(){

if(qr4Encontrado){

alert("Ya encontraste esta pista.");

return;

}

qr4Encontrado=true;

sonido("clic");

mostrarQR(

"img/qr3.png",

"tercer código encontrado.<br><br>"

);

}

/*=====================================================
VERIFICAR PUERTA
=====================================================*/

function verificarPuerta(){

if(puertaBloqueada){

alert("La puerta fue bloqueada.");

return;

}

let codigo=document.getElementById("codigoPuerta").value;

if(codigo==="1531"){

clearInterval(intervalo);

sonido("victoria");

document.getElementById("panelPuerta").style.display="none";

mostrarPantallaFinal();

return;

}

intentosPuerta++;

alert("Código incorrecto.");

document.getElementById("codigoPuerta").value="";

/*=====================================================
BLOQUEO
=====================================================*/

if(intentosPuerta>=10){

puertaBloqueada=true;

document.getElementById("codigoPuerta").disabled=true;

document.getElementById("btnAbrir").disabled=true;

document.getElementById("mensaje").innerHTML=

"❌ El sistema detectó demasiados intentos.<br><br>La puerta quedó bloqueada permanentemente.";

alert("Has alcanzado el límite de 10 intentos.");

}

}

/*=====================================================
PANTALLA FINAL
=====================================================*/

function mostrarPantallaFinal(){

// Tiempo empleado
let tiempoEmpleado = 300 - tiempo;

let minutos = Math.floor(tiempoEmpleado / 60);

let segundos = tiempoEmpleado % 60;

document.getElementById("tiempoFinal").innerHTML =
String(minutos).padStart(2, "0") + ":" +
String(segundos).padStart(2, "0");

document.getElementById("puntajeFinal").innerHTML=puntaje;

document.getElementById("puntajeGuardar").value=puntaje;

document.getElementById("tiempoGuardar").value = tiempoEmpleado;

document.getElementById("nivelGuardar").value=3;

/*==========================================
RANGO
==========================================*/

let rango="Agente";

if(puntaje>=300){

rango="Agente Especial";

}

else if(puntaje>=250){

rango="Agente Avanzado";

}

else{

rango="Agente";

}

document.getElementById("rangoGuardar").value=rango;

document.getElementById("pantallaFinal").style.display="flex";

}