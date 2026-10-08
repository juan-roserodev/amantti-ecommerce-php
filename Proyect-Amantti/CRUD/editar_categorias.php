<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

$id = (int) ($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$estado = (int) ($_POST['estado'] ?? 0);

// Consulta preparada: los datos del formulario nunca se concatenan en el SQL
$stmt = $conexion->prepare("UPDATE categorias SET nombre = ?, estado = ? WHERE id = ?");
$stmt->bind_param("sii", $nombre, $estado, $id);

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_categorias.php?edited=true");
} else {
    echo "Datos no editados";
}

$stmt->close();
$conexion->close();
