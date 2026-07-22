<?php
session_start();
include "php/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ingresar"])) {

    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = trim($_POST["contrasena"] ?? "");
    $imagen = trim($_POST["imagen"] ?? "");

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ? LIMIT 1");
    $stmt->bind_param("s",$usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if($resultado->num_rows==1){

        $datos=$resultado->fetch_assoc();

        if(password_verify($contrasena,$datos["contrasena"])){

            if($datos["imagen_seguridad"]==$imagen){

                $_SESSION["id"]=$datos["id"];
                $_SESSION["nombre"]=$datos["nombre"];
                $_SESSION["usuario"]=$datos["usuario"];
                $_SESSION["nivel"]=$datos["nivel"];
                $_SESSION["puntaje"]=$datos["puntaje"];
                $_SESSION["rango"]=$datos["rango"];
                $_SESSION["tiempo"]=$datos["tiempo"] ?? 0;

                header("Location: menu.php");
                exit();

            }else{

                $mensaje="La imagen de seguridad es incorrecta.";

            }

        }else{

            $mensaje="Usuario, contraseña o imagen de seguridad incorrectos.";

        }

    }else{

        $mensaje="Usuario, contraseña o imagen de seguridad incorrectos.";

    }

}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Acceso de Agentes</title>

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

/* EFECTO DE FONDO */

body::before{

content:"";

position:absolute;

width:100%;

height:100%;

background-image:

linear-gradient(rgba(255,255,255,.05) 1px,transparent 1px),

linear-gradient(90deg,rgba(255,255,255,.05) 1px,transparent 1px);

background-size:40px 40px;

opacity:.4;

}

/* TARJETA */

.login{

position:relative;

width:430px;

padding:40px;

border-radius:20px;

background:rgba(20,20,35,.92);

box-shadow:0 0 35px rgba(0,170,255,.4);

border:2px solid #1fa2ff;

backdrop-filter:blur(8px);

z-index:10;

}

/* TITULO */

h1{

text-align:center;

color:#00d9ff;

margin-bottom:8px;

font-size:34px;

letter-spacing:2px;

}

.subtitulo{

text-align:center;

color:#ccc;

margin-bottom:30px;

font-size:15px;

}

/* LABELS */

label{

display:block;

color:#fff;

margin-top:15px;

margin-bottom:6px;

font-weight:bold;

}

/* INPUTS */

input,select{

width:100%;

padding:13px;

border:none;

border-radius:8px;

outline:none;

font-size:15px;

background:#ececec;

transition:.3s;

}

input:focus,
select:focus{

box-shadow:0 0 12px #00d9ff;

transform:scale(1.02);

}

/* BOTON */

button{

margin-top:25px;

width:100%;

padding:15px;

font-size:18px;

border:none;

border-radius:10px;

background:#00b4ff;

color:white;

cursor:pointer;

font-weight:bold;

transition:.3s;

}

button:hover{

background:#0084ff;

transform:scale(1.03);

box-shadow:0 0 15px #00d9ff;

}

/* ERROR */

.error{

margin-top:20px;

text-align:center;

color:#ff4b4b;

font-weight:bold;

}

/* PIE */

.footer{

margin-top:30px;

text-align:center;

font-size:13px;

color:#999;

}

</style>

</head>

<body>

<div class="login">

    <h1>🕵 MISIÓN SECRETA</h1>

    <div class="subtitulo">
        Acceso exclusivo para agentes autorizados
    </div>

    <form method="POST">

        <label>👤 Usuario</label>

        <input
        type="text"
        name="usuario"
        placeholder="Ingrese su usuario"
        required>

        <label>🔒 Contraseña</label>

        <input
        type="password"
        name="contrasena"
        placeholder="Ingrese su contraseña"
        required>

        <label>🖼 Imagen de Seguridad</label>

        <select name="imagen" required>

            <option value="">Seleccione su imagen</option>

            <option value="gato.png">🐱 Gato</option>

            <option value="perro.png">🐶 Perro</option>

            <option value="zorro.png">🦊 Zorro</option>

            <option value="panda.png">🐼 Panda</option>

            <option value="leon.png">🦁 León</option>

        </select>

        <button
        type="submit"
        name="ingresar">

        🚀 ACCEDER A LA MISIÓN

        </button>

        <p style="margin-top:15px; text-align:center; color:#ddd;">
            <a href="recuperar.php" style="color:#00b4ff; text-decoration:none;">¿Olvidaste tu contraseña?</a>
        </p>

        <div class="error">

            <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>

        </div>

    </form>

    <div class="footer">

        Universidad Nacional de Chimborazo <br>

        Ingeniería en Tecnologías de la Información

    </div>

</div>

</body>

</html>