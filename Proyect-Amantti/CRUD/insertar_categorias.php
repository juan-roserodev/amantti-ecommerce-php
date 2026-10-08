<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

$nombre = trim($_POST['nombre'] ?? '');
$estado = (int) ($_POST['estado'] ?? 0);

// Consulta preparada: los datos del formulario nunca se concatenan en el SQL
$stmt = $conexion->prepare("INSERT INTO categorias (nombre, estado) VALUES (?, ?)");
$stmt->bind_param("si", $nombre, $estado);

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_categorias.php?added=true");
} else {
    echo "Datos no insertados";
}

$stmt->close();
$conexion->close();
