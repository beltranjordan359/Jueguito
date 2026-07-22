<?php
session_start();
include "php/conexion.php";

if (!isset($_SESSION["id"])) {
    exit("No autorizado");
}

$puntaje = intval($_POST["puntaje"] ?? 0);
$nivel = intval($_POST["nivel"] ?? 0);
$tiempo = intval($_POST["tiempo"] ?? 0);
$rango = trim($_POST["rango"] ?? "");

$id = $_SESSION["id"];

$stmt = $conn->prepare("UPDATE usuarios SET nivel = ?, puntaje = ?, tiempo = ?, rango = ?, puntaje_nivel1 = ?, tiempo_nivel1 = ? WHERE id = ?");
$stmt->bind_param("iiisiii", $nivel, $puntaje, $tiempo, $rango, $puntaje, $tiempo, $id);
$stmt->execute();

$_SESSION["nivel"] = $nivel;
$_SESSION["puntaje"] = $puntaje;
$_SESSION["tiempo"] = $tiempo;
$_SESSION["rango"] = $rango;

echo "ok";
?>
