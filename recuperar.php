<?php

include "php/conexion.php";

$mensaje = "";
$correcto = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = trim($_POST["usuario"] ?? "");
    $imagen = trim($_POST["imagen"] ?? "");
    $respuesta = trim($_POST["respuesta"] ?? "");
    $nueva = trim($_POST["nueva"] ?? "");
    $confirmar = trim($_POST["confirmar"] ?? "");

    if(
        $usuario=="" ||
        $imagen=="" ||
        $respuesta=="" ||
        $nueva=="" ||
        $confirmar==""
    ){

        $mensaje="Debe completar todos los campos.";

    }else{

        $stmt=$conn->prepare("SELECT * FROM usuarios WHERE usuario=? LIMIT 1");

        $stmt->bind_param("s",$usuario);

        $stmt->execute();

        $resultado=$stmt->get_result();

        if($resultado->num_rows==1){

            $datos=$resultado->fetch_assoc();

            if($datos["imagen_seguridad"]==$imagen){

                if(password_verify($respuesta,$datos["respuesta_secreta"])){

                    if($nueva==$confirmar){

                        $passwordHash=password_hash($nueva,PASSWORD_DEFAULT);

                        $stmt=$conn->prepare("UPDATE usuarios SET contrasena=? WHERE id=?");

                        $stmt->bind_param("si",$passwordHash,$datos["id"]);

                        if($stmt->execute()){

                            $correcto=true;

                            $mensaje="Contraseña actualizada correctamente.";

                        }else{

                            $mensaje="No fue posible actualizar la contraseña.";

                        }

                    }else{

                        $mensaje="Las contraseñas no coinciden.";

                    }

                }else{

                    $mensaje="La respuesta de seguridad es incorrecta.";

                }

            }else{

                $mensaje="La imagen de seguridad es incorrecta.";

            }

        }else{

            $mensaje="El usuario no existe.";

        }

    }

}

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Recuperar Contraseña</title>

<style>

*{

margin:0;
padding:0;
box-sizing:border-box;

}

body{

font-family:Arial,Helvetica,sans-serif;

background:linear-gradient(135deg,#020024,#090979,#000428);

display:flex;

justify-content:center;

align-items:center;

height:100vh;

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

.panel{

position:relative;

width:470px;

background:rgba(20,20,35,.93);

padding:35px;

border-radius:20px;

border:2px solid #00bfff;

box-shadow:0 0 25px rgba(0,180,255,.5);

z-index:2;

}

h1{

text-align:center;

color:#00d9ff;

margin-bottom:10px;

}

.subtitulo{

text-align:center;

color:#ddd;

margin-bottom:25px;

}

label{

display:block;

color:white;

margin-top:15px;

margin-bottom:6px;

font-weight:bold;

}

input,select{

width:100%;

padding:12px;

border:none;

border-radius:8px;

outline:none;

font-size:15px;

}

input:focus,
select:focus{

box-shadow:0 0 10px #00d9ff;

}

button{

margin-top:25px;

width:100%;

padding:15px;

font-size:18px;

background:#00a8ff;

border:none;

border-radius:10px;

color:white;

cursor:pointer;

transition:.3s;

}

button:hover{

background:#0084ff;

transform:scale(1.02);

}

.mensaje{

margin-top:20px;

text-align:center;

font-weight:bold;

color:#ffb347;

}

.exito{

color:#7CFC00;

}

.enlace{

margin-top:12px;

display:block;

text-align:center;

color:#00d9ff;

text-decoration:none;

font-size:0.95rem;

}

.enlace:hover{

text-decoration:underline;

}

</style>

</head>

<body>

<div class="panel">

    <h1>🔑 RECUPERAR CONTRASEÑA</h1>

    <div class="subtitulo">
        Verifique su identidad para crear una nueva contraseña.
    </div>

    <form method="POST">

        <label>👤 Usuario</label>

        <input
        type="text"
        name="usuario"
        placeholder="Ingrese su usuario"
        required>

        <label>🖼 Imagen de seguridad</label>

        <select
        name="imagen"
        required>

            <option value="">Seleccione su imagen</option>

            <option value="gato.png">🐱 Gato</option>

            <option value="perro.png">🐶 Perro</option>

            <option value="zorro.png">🦊 Zorro</option>

            <option value="panda.png">🐼 Panda</option>

            <option value="leon.png">🦁 León</option>

        </select>

        <label>❓ ¿Cuál es el nombre de tu primera mascota?</label>

        <input
        type="text"
        name="respuesta"
        placeholder="Respuesta de seguridad"
        required>

        <label>🔒 Nueva contraseña</label>

        <input
        type="password"
        name="nueva"
        placeholder="Nueva contraseña"
        required>

        <label>🔒 Confirmar contraseña</label>

        <input
        type="password"
        name="confirmar"
        placeholder="Repita la contraseña"
        required>

        <button
        type="submit">

            🔄 ACTUALIZAR CONTRASEÑA

        </button>

    </form>

    <div class="<?php echo $correcto ? 'mensaje exito' : 'mensaje'; ?>">

        <?php echo htmlspecialchars($mensaje, ENT_QUOTES, 'UTF-8'); ?>

    </div>

    <?php if($correcto){ ?>

        <form action="login.php">

            <button
            style="background:#28a745;">

                🔐 IR AL INICIO DE SESIÓN

            </button>

        </form>

    <?php } ?>

    <a href="login.php" class="enlace">← Volver al inicio de sesión</a>

    <div style="
        text-align:center;
        margin-top:25px;
        color:#999;
        font-size:14px;">

        Universidad Nacional de Chimborazo

        <br>

        Ingeniería en Tecnologías de la Información

    </div>

</div>

</body>

</html>
