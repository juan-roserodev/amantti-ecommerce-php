<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

$id = (int) ($_POST['id'] ?? 0);
$valor = trim($_POST['valor'] ?? '');

// Consulta preparada: los datos del formulario nunca se concatenan en el SQL
$stmt = $conexion->prepare("UPDATE parametros SET valor = ? WHERE id = ?");
$stmt->bind_param("si", $valor, $id);

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_estados.php?edited=true");
} else {
    echo "Datos no editados";
}

$stmt->close();
$conexion->close();
