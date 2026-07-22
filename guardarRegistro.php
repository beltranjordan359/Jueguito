<?php
include "php/conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $cedula = trim($_POST["cedula"] ?? "");
    $usuario = trim($_POST["usuario"] ?? "");
    $contrasena = trim($_POST["contrasena"] ?? "");
    $imagen = trim($_POST["imagen"] ?? "gato.png");
    $respuesta = trim($_POST["respuesta"] ?? "");

    if (
        $cedula === "" ||
        $usuario === "" ||
        $contrasena === "" ||
        $respuesta === ""
    ) {

        echo "Debes completar todos los campos.";
        exit();

    }

    // Verificar que el usuario no exista
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ? LIMIT 1");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {

        echo "El nombre de usuario ya está en uso.";
        exit();

    }

    // Cifrar contraseña
    $passwordHash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Cifrar respuesta de seguridad
    $respuestaHash = password_hash($respuesta, PASSWORD_DEFAULT);

    // Actualizar usuario autorizado
    $stmt = $conn->prepare("
        UPDATE usuarios
        SET
            usuario = ?,
            contrasena = ?,
            imagen_seguridad = ?,
            respuesta_secreta = ?,
            registrado = 1
        WHERE cedula = ?
        AND registrado = 0
        LIMIT 1
    ");

    $stmt->bind_param(
        "sssss",
        $usuario,
        $passwordHash,
        $imagen,
        $respuestaHash,
        $cedula
    );

    $stmt->execute();

    if ($stmt->affected_rows > 0) {

        echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Cuenta creada</title>

            <style>

                body{

                    font-family:Arial;
                    background:#021B79;
                    color:white;
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    height:100vh;

                }

                .caja{

                    width:420px;
                    background:white;
                    color:black;
                    padding:30px;
                    border-radius:15px;
                    text-align:center;
                    box-shadow:0px 0px 20px black;

                }

                a{

                    display:inline-block;
                    margin-top:20px;
                    padding:12px 20px;
                    background:#0b4f6c;
                    color:white;
                    text-decoration:none;
                    border-radius:8px;

                }

                a:hover{

                    background:#06384d;

                }

            </style>

        </head>

        <body>

            <div class='caja'>

                <h2>✅ Cuenta creada correctamente</h2>

                <br>

                <p>Tu usuario ya puede iniciar sesión.</p>

                <a href='login.php'>
                    Ir al inicio de sesión
                </a>

            </div>

        </body>

        </html>
        ";

    } else {

        echo "No se pudo crear la cuenta. Verifica que la cédula sea válida o que el usuario aún no haya sido registrado.";

    }

} else {

    header("Location: registro.php");
    exit();

}