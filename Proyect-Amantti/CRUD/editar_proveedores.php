<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

$id = (int) ($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$producto = trim($_POST['producto'] ?? '');
$estado = (int) ($_POST['estado'] ?? 0);

// Consulta preparada: los datos del formulario nunca se concatenan en el SQL
$stmt = $conexion->prepare(
    "UPDATE proveedores SET nombre = ?, direccion = ?, telefono = ?, producto = ?, estado = ? WHERE id = ?"
);
$stmt->bind_param("ssssii", $nombre, $direccion, $telefono, $producto, $estado, $id);

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_proveedores.php?edited=true");
} else {
    echo "Datos no editados";
}

$stmt->close();
$conexion->close();
