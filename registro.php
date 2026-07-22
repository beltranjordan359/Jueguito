<?php

//=====================================
// CÓDIGO SECRETO DEL QR
//=====================================

$codigo = "UNACH2026";

// Si no viene el código correcto en la URL,
// regresar al inicio.
if (!isset($_GET["codigo"]) || $_GET["codigo"] != $codigo) {
    header("Location: index.php");
    exit();
}

include "php/conexion.php";

$mensaje = "";

//=====================================
// VERIFICAR NOMBRE Y CÉDULA
//=====================================

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["verificar"])) {

    $nombre = trim($_POST["nombre"] ?? "");
    $cedula = trim($_POST["cedula"] ?? "");

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre = ? AND cedula = ? LIMIT 1");
    $stmt->bind_param("ss", $nombre, $cedula);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        $usuario = $resultado->fetch_assoc();

        if ((int)$usuario["registrado"] === 1) {

            $mensaje = "Esta cuenta ya fue creada. Inicie sesión.";

        } else {

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Crear Cuenta | Misión Secreta</title>

<style>

    *{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:Arial,Helvetica,sans-serif;

    background:linear-gradient(135deg,#020024,#090979,#000428);

    min-height:100vh;

    display:flex;

    justify-content:center;

    align-items:center;

    overflow:hidden;

}

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

.contenedor{

    position:relative;

    width:520px;

    background:rgba(20,20,35,.95);

    border:2px solid #00bfff;

    border-radius:20px;

    padding:35px;

    box-shadow:0 0 30px rgba(0,191,255,.55);

    z-index:2;

}

.logo{

    text-align:center;

    font-size:60px;

    margin-bottom:10px;

}

h2{

    text-align:center;

    color:#00d9ff;

    letter-spacing:2px;

    margin-bottom:10px;

}

.subtitulo{

    color:#d7d7d7;

    text-align:center;

    margin-bottom:30px;

    line-height:25px;

}

label{

    display:block;

    color:white;

    margin-top:15px;

    margin-bottom:8px;

    font-weight:bold;

}

input,
select{

    width:100%;

    padding:13px;

    border:none;

    border-radius:8px;

    outline:none;

    font-size:15px;

    transition:.3s;

}

input:focus,
select:focus{

    box-shadow:0 0 12px #00d9ff;

}

.pregunta{

    background:rgba(0,191,255,.12);

    border-left:5px solid #00bfff;

    color:white;

    padding:12px;

    border-radius:8px;

    line-height:24px;

}

button{

    width:100%;

    padding:15px;

    margin-top:30px;

    background:#00a8ff;

    color:white;

    border:none;

    border-radius:10px;

    font-size:18px;

    cursor:pointer;

    transition:.3s;

}

button:hover{

    background:#0084ff;

    transform:scale(1.03);

}

footer{

    margin-top:25px;

    text-align:center;

    color:#bdbdbd;

    font-size:13px;

    line-height:22px;

}

</style>

</head>

<body>

<div class="contenedor">

<div class="logo">

🛡️

</div>

<h2>CREAR CUENTA</h2>

<div class="subtitulo">

Configure sus credenciales para convertirse en un agente autorizado de la misión.

</div>

<form action="guardarRegistro.php" method="POST">

<input
type="hidden"
name="cedula"
value="<?php echo htmlspecialchars($cedula, ENT_QUOTES, 'UTF-8'); ?>">

<label>👤 Nombre de usuario</label>

<input
type="text"
name="usuario"
placeholder="Ingrese un nombre de usuario"
required>

<label>🔒 Contraseña</label>

<input
type="password"
name="contrasena"
placeholder="Ingrese una contraseña segura"
required>

<label>🛡 Imagen de seguridad</label>

<select name="imagen" required>

<option value="">Seleccione una imagen</option>

<option value="gato.png">🐱 Gato</option>

<option value="perro.png">🐶 Perro</option>

<option value="zorro.png">🦊 Zorro</option>

<option value="panda.png">🐼 Panda</option>

<option value="leon.png">🦁 León</option>

</select>

<label>❓ Pregunta de seguridad</label>

<div class="pregunta">

¿Cuál es el nombre de tu primera mascota?

</div>

<input
type="text"
name="respuesta"
placeholder="Escriba su respuesta"
required>

<button type="submit">

🚀 CREAR CUENTA

</button>

</form>

<footer>

Universidad Nacional de Chimborazo

<br>

Ingeniería en Tecnologías de la Información

</footer>

</div>

</body>

</html>

<?php

            exit();

        }

    } else {

        $mensaje = "❌ No estás autorizado para registrarte.";

    }

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Registro | Misión Secreta</title>

<style>

   
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }


    body{

        font-family:Arial, Helvetica, sans-serif;

        background:linear-gradient(135deg,#020024,#090979,#000428);

        min-height:100vh;

        display:flex;

        justify-content:center;

        align-items:center;

        overflow:hidden;

    }


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



    .contenedor{

        position:relative;

        width:450px;

        background:rgba(20,20,35,.95);

        border:2px solid #00bfff;

        border-radius:20px;

        padding:35px;

        box-shadow:

        0 0 25px rgba(0,191,255,.6);


        z-index:2;

    }



    .logo{

        text-align:center;

        font-size:60px;

        margin-bottom:15px;

    }



    h2{

        text-align:center;

        color:#00d9ff;

        letter-spacing:2px;

        margin-bottom:15px;

    }



    .subtitulo{


        color:#ddd;

        text-align:center;

        line-height:24px;

        margin-bottom:25px;


    }



    label{

        display:block;

        color:white;

        margin-top:15px;

        margin-bottom:8px;

        font-weight:bold;

    }



    input{


        width:100%;

        padding:13px;

        border:none;

        border-radius:8px;

        outline:none;

        font-size:15px;

        transition:.3s;


    }



    input:focus{


        box-shadow:0 0 12px #00d9ff;


    }



    button{


        width:100%;

        padding:15px;

        margin-top:25px;

        background:#00a8ff;

        border:none;

        border-radius:10px;

        color:white;

        font-size:18px;

        cursor:pointer;

        transition:.3s;


    }



    button:hover{


        background:#0084ff;

        transform:scale(1.03);


    }



    .mensaje{


        background:rgba(255,0,0,.15);

        border-left:5px solid red;

        color:white;

        padding:12px;

        border-radius:8px;

        margin-bottom:20px;

        text-align:center;

        line-height:22px;


    }



    footer{


        margin-top:25px;

        text-align:center;

        color:#aaa;

        font-size:13px;

        line-height:22px;


    }

</style>


</head>


<body>


<div class="contenedor">


<div class="logo">

🔐

</div>



<h2>

VERIFICACIÓN DE AGENTE

</h2>



<div class="subtitulo">

Antes de crear su cuenta debemos confirmar que usted pertenece a la lista de agentes autorizados.

</div>



<?php

if($mensaje != ""){

?>

<div class="mensaje">

<?php echo $mensaje; ?>

</div>


<?php

}

?>



<form method="POST">



<label>

👤 Nombre completo

</label>


<input

type="text"

name="nombre"

placeholder="Ingrese su nombre completo"

required

>



<label>

🪪 Número de cédula

</label>


<input

type="text"

name="cedula"

placeholder="Ingrese su número de cédula"

maxlength="10"

required

>



<button

type="submit"

name="verificar"

>


🔎 VERIFICAR IDENTIDAD


</button>



</form>



<footer>


Universidad Nacional de Chimborazo


<br>


Ingeniería en Tecnologías de la Información


<br>


Proyecto: Misión Secreta


</footer>



</div>



</body>


</html>

