<?php
$host = getenv("DB_HOST") ?: "localhost";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "";
$dbname = getenv("DB_NAME") ?: "mision_secreta";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

function actualizarProgresoUsuario($conn, $usuarioId, $nivel, $rango, $puntaje, $tiempo = null) {
    if ($tiempo === null) {
        $stmt = $conn->prepare("UPDATE usuarios SET nivel = ?, rango = ?, puntaje = ? WHERE id = ?");
        $stmt->bind_param("isii", $nivel, $rango, $puntaje, $usuarioId);
    } else {
        $stmt = $conn->prepare("UPDATE usuarios SET nivel = ?, rango = ?, puntaje = ?, tiempo = ? WHERE id = ?");
        $stmt->bind_param("isiii", $nivel, $rango, $puntaje, $tiempo, $usuarioId);
    }

    return $stmt->execute();
}

function obtenerDatosUsuario($conn, $usuarioId) {
    $stmt = $conn->prepare("SELECT nivel, rango, puntaje, tiempo, puntaje_nivel1, tiempo_nivel1, puntaje_nivel2, tiempo_nivel2 FROM usuarios WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $usuarioId);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        return $resultado->fetch_assoc();
    }

    return null;
}
