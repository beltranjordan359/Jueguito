<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

include "php/conexion.php";

$id = (int) $_SESSION["id"];
$nivel = (int) ($_POST["nivel"] ?? 0);
$puntajeNivel2 = (int) ($_POST["puntaje"] ?? 0);
$tiempoNivel2 = (int) ($_POST["tiempo"] ?? 0);
$rango = trim($_POST["rango"] ?? "Agente");

$stmtPrevio = $conn->prepare("SELECT puntaje_nivel1, tiempo_nivel1 FROM usuarios WHERE id = ?");
$stmtPrevio->bind_param("i", $id);
$stmtPrevio->execute();
$previo = $stmtPrevio->get_result()->fetch_assoc();

$puntajeNivel1 = (int) ($previo["puntaje_nivel1"] ?? 0);
$tiempoNivel1 = (int) ($previo["tiempo_nivel1"] ?? 0);

$puntajeTotal = $puntajeNivel1 + $puntajeNivel2;
$tiempoTotal = $tiempoNivel1 + $tiempoNivel2;

$stmt = $conn->prepare("UPDATE usuarios SET nivel = ?, puntaje = ?, tiempo = ?, rango = ?, puntaje_nivel2 = ?, tiempo_nivel2 = ? WHERE id = ?");
$stmt->bind_param("iiisiii", $nivel, $puntajeTotal, $tiempoTotal, $rango, $puntajeNivel2, $tiempoNivel2, $id);
$stmt->execute();

$_SESSION["nivel"] = $nivel;
$_SESSION["puntaje"] = $puntajeTotal;
$_SESSION["tiempo"] = $tiempoTotal;
$_SESSION["rango"] = $rango;

header("Location: menu.php");
exit();
