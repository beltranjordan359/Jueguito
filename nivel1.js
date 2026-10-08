// ============================
// ESTADO DEL NIVEL
// ============================

let misiones = {

    computadora: false,
    librero: false,
    archivador: false,
    caja: false

};

// ============================
// VARIABLES DEL JUEGO
// ============================

let sonido;

// Tiempo
let inicioTiempo = Date.now();
let intervaloTiempo;

// Puntaje
let puntaje = 0;

// ============================
// INICIAR JUEGO
// ============================

window.onload = function () {

    sonido = document.getElementById("clickSound");

    iniciarCronometro();

    actualizarBarra();

};

// ============================
// SONIDO
// ============================

function reproducirSonido() {
3
    if (sonido) {

        sonido.currentTime = 0;

        sonido.play().catch(() => { });

    }

}

// ============================
// CRONÓMETRO
// ============================

function iniciarCronometro() {

    intervaloTiempo = setInterval(actualizarTiempo, 1000);

}

function actualizarTiempo() {

    let segundos = Math.floor((Date.now() - inicioTiempo) / 1000);

    let minutos = Math.floor(segundos / 60);

    segundos = segundos % 60;

    let tiempo =
        String(minutos).padStart(2, "0") +
        ":" +
        String(segundos).padStart(2, "0");

    let reloj = document.getElementById("cronometro");

    if (reloj) {

        reloj.innerHTML = "⏱ Tiempo: " + tiempo;

    }

}

function detenerCronometro() {

    clearInterval(intervaloTiempo);

}

// ============================
// MODAL
// ============================

function abrirModal(titulo, contenido) {

    document.getElementById("modal").style.display = "flex";

    document.getElementById("tituloModal").innerHTML = titulo;

    document.getElementById("contenidoModal").innerHTML = contenido;

}

function cerrarModal() {

    document.getElementById("modal").style.display = "none";

}

// ============================
// PROGRESO
// ============================

function completarMision(nombre) {

    if (!misiones[nombre]) {

        misiones[nombre] = true;

        actualizarBarra();

    }

}

function actualizarBarra() {

    let total = 0;

    for (let m in misiones) {

        if (misiones[m]) {

            total++;

        }

    }

    let porcentaje = Math.floor((total / 4) * 100);

    let barra = document.getElementById("avance");

    if (barra) {

        barra.style.width = porcentaje + "%";

        barra.innerHTML = porcentaje + "%";

    }

}

// ============================
// PUNTAJE SEGÚN EL TIEMPO
// ============================

function calcularPuntaje() {

    let minutos = (Date.now() - inicioTiempo) / 60000;

    if (minutos < 2) {

        puntaje = 300;

    }

    else if (minutos <= 4) {

        puntaje = 250;

    }

    else {

        puntaje = 100;

    }

    localStorage.setItem("puntaje", puntaje);

    return puntaje;

}



// ============================
// 💻 COMPUTADORA
// MISIÓN 1
// CIFRADO CÉSAR
// ============================

function abrirComputadora() {

    reproducirSonido();

    abrirModal(

        "💻 Misión 1: Mensaje Oculto",

        `

        <h3>📡 Transmisión Interceptada</h3>

        <br>

        <p>
        Un agente dejó un mensaje protegido.
        </p>

        <br>

        <h1 style="color:#00ffcc;">
        KROD DJHQWH
        </h1>

        <br>

        <p>
        Encuentra la pista para descubrir el mensaje (minusculas).
        </p>

        <br>

        <input
            id="respuesta"
            placeholder="Escribe el mensaje">

        <br><br>

        <button onclick="verificarComputadora()">

            Descifrar

        </button>

        `

    );

}

function verificarComputadora() {

    let respuesta = document
        .getElementById("respuesta")
        .value
        .trim()
        .toUpperCase();

    if (respuesta == "HOLA AGENTE") {

        completarMision("computadora");

        abrirModal(

            "✅ Mensaje Descifrado",

            `

            <h2>Excelente trabajo Agente</h2>

            <br>

            <h1 style="color:#00ff66;">
            HOLA AGENTE
            </h1>

            <br>

            <p>
            Has recuperado la primera transmisión.
            </p>

            <br>

            <p>
            ✔ Progreso actualizado.
            </p>

            `

        );

    }

    else {

        alert("❌ El mensaje aún sigue cifrado.");

    }

}







// ============================
// 📚 LIBRERO
// MISIÓN 2
// PALABRA OCULTA
// ============================

function abrirLibrero() {

    reproducirSonido();

    abrirModal(

        "📚 Misión 2: Libro Perdido",

        `

        <h3>Documento Encontrado</h3>

        <br>

        <p>

        Entre las páginas aparece una secuencia.

        </p>

        <br>

        <h2>

        C - 4 - O - 9 - D - 7 - I - 3 - G - 6 - O

        </h2>

        <br>

        <p>

        Elimina todos los números.

        </p>

        <br>

        <input
            id="libroRespuesta"
            placeholder="Palabra encontrada">

        <br><br>

        <button onclick="resolverLibro()">

            Resolver

        </button>

        `

    );

}

function resolverLibro() {

    let respuesta = document
        .getElementById("libroRespuesta")
        .value
        .trim()
        .toUpperCase();

    if (respuesta == "CODIGO") {

        completarMision("librero");

        abrirModal(

            "✅ Documento Recuperado",

            `

            <h2>Muy bien</h2>

            <br>

            <h1 style="color:#00ff66;">

            CÓDIGO

            </h1>

            <br>

            <p>

            La palabra será utilizada
            para abrir la puerta final.

            </p>

            <br>

            <p>

            ✔ Progreso actualizado.

            </p>

            `

        );

    }

    else {

        alert("❌ Esa no es la palabra correcta.");

    }

}



// ============================
// 📦 CAJA FUERTE
// MISIÓN 3
// PATRÓN DE SEGURIDAD
// ============================

function abrirCaja(){

    reproducirSonido();

    abrirModal(

    "📦 Caja Fuerte",

    `

    <h2>Sistema de Seguridad</h2>

    <br>

    <p>
    Para abrir la caja debes descubrir la secuencia.
    </p>

    <br>

    <h2>

    ☀️ 🌙 ⭐ 🌙 ☀️

    </h2>

    <br>

    <p>

    ☀️ = 1

    <br>

    🌙 = 2

    <br>

    ⭐ = 3

    </p>

    <br>

    <input
    id="cajaRespuesta"
    placeholder="Código">

    <br><br>

    <button onclick="resolverCaja()">

    Abrir

    </button>

    `

    );

}



function resolverCaja(){

    let respuesta=document
    .getElementById("cajaRespuesta")
    .value
    .trim();

    if(respuesta=="12321"){

        completarMision("caja");

        abrirModal(

        "✅ Caja Abierta",

        `

        <h2>Pista Recuperada</h2>

        <br>

        <p>

        Has encontrado una nueva pista.

        </p>

        <br>

        <p>

        ✔ Progreso actualizado.

        </p>

        `

        );

    }

    else{

        alert("❌ El código es incorrecto.");

    }

}













// ============================
// 🗄️ ARCHIVADOR
// MISIÓN 4
// ============================

function abrirArchivador(){

    reproducirSonido();

    abrirModal(

    "🗄️ Archivo Clasificado",

    `

    <h2>

    EXPEDIENTE CONFIDENCIAL

    </h2>

    <br>

    <p>

    Se encontró un expediente perteneciente a un antiguo agente.

    </p>

    <br>

    <img

        src="img/pista.png"

        style="

        width:300px;

        border-radius:12px;

        border:3px solid #00d9ff;

        box-shadow:0 0 15px #00d9ff;

        "

    >

    <br><br>

    <p>

    Escanee el Código QR para obtener la pista.

    </p>

    <br>

    <button onclick="resolverPista()">

    ✔ Confirmar lectura

    </button>

    `

    );

}


function resolverPista(){

    completarMision("archivador");

    cerrarModal();

    alert("✔ Pista registrada. Continúe con la misión.");

}






// ============================
// 📝 NOTA FINAL
// ============================

function abrirNota(){

    reproducirSonido();

    abrirModal(

    "📝 Nota del Agente",

    `

    <h2>Mensaje Encontrado</h2>

    <br>

    <p>

    "Si encontraste este documento,

    significa que estás muy cerca

    de completar la misión."

    </p>

    <br>

    <p>

    ✔ La computadora mostró una transmisión.

    </p>

    <p>

    ✔ El librero reveló una palabra.

    </p>

    <p>

    ✔ El archivador escondía un Código QR.

    </p>

    <p>

    ✔ La caja confirmó el orden correcto.

    </p>

    <br>

    <h3>

    Cinco letras resguardan el secreto; todo comienza con la primera CLAVE y el PRIMER  NÚMERO completa la respuesta.

    </h3>

    `

    );

}









// ============================
// 🚪 PUERTA FINAL
// ============================

function abrirPuerta(){

    reproducirSonido();

    abrirModal(

    "🚪 Puerta de Seguridad",

    `

    <h2>

    Acceso Restringido

    </h2>

    <br>

    <p>

    Introduzca la clave final.

    </p>

    <br>

    <input

    id="claveFinal"

    placeholder="Ingrese la clave">

    <br><br>

    <button onclick="verificarClaveFinal()">

    Desbloquear

    </button>

    `

    );

}










function verificarClaveFinal(){

    let clave=document

    .getElementById("claveFinal")

    .value

    .trim()

    .toUpperCase();



    if(

        clave=="CLAVE 1"

        &&

        misiones.computadora

        &&

        misiones.librero

        &&

        misiones.archivador

        &&

        misiones.caja

    ){

        detenerCronometro();

        let puntos=calcularPuntaje();

        let tiempoFinal=Math.floor(

            (Date.now()-inicioTiempo)/1000

        );



        localStorage.setItem(

            "nivel",

            "2"

        );



        localStorage.setItem(

            "puntaje",

            puntos

        );



        localStorage.setItem(

            "tiempo",

            tiempoFinal

        );



        localStorage.setItem(

            "rango",

            "AGENTE ESPECIAL"

        );



        abrirModal(

        "🏆 MISIÓN COMPLETADA",

        `

        <h1 style="color:#00ff66">

        MISIÓN EXITOSA

        </h1>

        <br>

        <h2>

        ⭐ AGENTE ESPECIAL ⭐

        </h2>

        <br>

        <p>

        Tiempo empleado:

        <strong>

        ${Math.floor(tiempoFinal/60)}

        min

        ${tiempoFinal%60}

        seg

        </strong>

        </p>

        <br>

        <p>

        Puntaje obtenido:

        <strong>

        ${puntos}

        </strong>

        puntos

        </p>

        <br>

        <p>

        ✔ Nivel 2 desbloqueado

        </p>

        <br>

        <button onclick="finalizarNivel()">

        Continuar

        </button>

        `

        );

    }

    else{

        alert(

        "❌ Todavía no has conseguido todas las pistas o la clave es incorrecta."

        );

    }

}







// ============================
// CONTINUAR AL MENÚ
// ============================

function finalizarNivel(){

    let datos = new URLSearchParams({

        nivel: localStorage.getItem("nivel") || "2",

        puntaje: localStorage.getItem("puntaje") || "0",

        tiempo: localStorage.getItem("tiempo") || "0",

        rango: localStorage.getItem("rango") || ""

    });

    fetch("actualizarnivel1.php", {

        method: "POST",

        headers: {

            "Content-Type": "application/x-www-form-urlencoded"

        },

        body: datos

    })

    .catch(function(){})

    .finally(function(){

        location.href="menu.php";

    });

}







// ============================
// BARRA DE PROGRESO
// ============================

function actualizarBarra(){

    let total = 0;

    for(let m in misiones){

        if(misiones[m]){

            total++;

        }

    }

    let porcentaje = Math.floor((total / 4) * 100);

    let barra = document.getElementById("avance");

    if(barra){

        barra.style.width = porcentaje + "%";

        barra.innerHTML = porcentaje + "%";

        barra.style.transition = "1s";

    }

    // Cuando completa todas las misiones

    if(porcentaje == 100){

        setTimeout(function(){

            abrirModal(

                "🎉 Todas las pistas encontradas",

                `

                <h2>

                ¡Excelente trabajo!

                </h2>

                <br>

                <p>

                Has encontrado todas las pistas del nivel.

                </p>

                <br>

                <p>

                Ahora ya puedes abrir la puerta final.

                </p>

                <br>

                <button onclick="cerrarModal()">

                Continuar

                </button>

                `

            );

        },500);

    }

}








// ============================
// REINICIAR NIVEL
// ============================

function reiniciarNivel(){

    if(confirm("¿Deseas reiniciar la misión?")){

        location.reload();

    }

}








// ============================
// EFECTO AL PASAR EL MOUSE
// ============================

document.addEventListener("DOMContentLoaded",function(){

    let objetos=document.querySelectorAll(

        ".computadora,.librero,.archivador,.caja,.nota,.puerta"

    );

    objetos.forEach(function(objeto){

        objeto.addEventListener("mouseenter",function(){

            objeto.style.transform="scale(1.05)";

            objeto.style.transition=".25s";

        });

        objeto.addEventListener("mouseleave",function(){

            objeto.style.transform="scale(1)";

        });

    });

});








// ============================
// GUARDAR PROGRESO
// ============================

function guardarProgreso(){

    localStorage.setItem(

        "nivel",2

    );

    localStorage.setItem(

        "puntaje",puntaje

    );

    localStorage.setItem(

        "tiempo",

        Math.floor((Date.now()-inicioTiempo)/1000)

    );

}








// ============================
// MENSAJE DE BIENVENIDA
// ============================

setTimeout(function(){

    abrirModal(

        "🕵 Bienvenido Agente",

        `

        <h2>

        Misión: La Primera Señal

        </h2>

        <br>

        <p>

        Busca todas las pistas ocultas en la habitación.

        </p>

        <br>

        <p>

        El tiempo ya comenzó.

        </p>

        <br>

        <button onclick="cerrarModal()">

        Comenzar misión

        </button>

        `

    );

},500);