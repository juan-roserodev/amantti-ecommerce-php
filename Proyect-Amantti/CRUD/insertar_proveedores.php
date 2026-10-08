<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

$nombre = trim($_POST['nombre'] ?? '');
$direccion = trim($_POST['direccion'] ?? '');
$telefono = trim($_POST['telefono'] ?? '');
$producto = trim($_POST['producto'] ?? '');
$estado = (int) ($_POST['estado'] ?? 0);

// Consulta preparada: los datos del formulario nunca se concatenan en el SQL
$stmt = $conexion->prepare(
    "INSERT INTO proveedores (nombre, direccion, telefono, producto, estado) VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("ssssi", $nombre, $direccion, $telefono, $producto, $estado);

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_proveedores.php?added=true");
} else {
    echo "Datos no insertados";
}

$stmt->close();
$conexion->close();
