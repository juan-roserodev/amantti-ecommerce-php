<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

$id = (int) ($_POST['id'] ?? 0);
$nombres = trim($_POST['nombres'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$rol = (int) ($_POST['rol'] ?? 0);
$estado = (int) ($_POST['estado'] ?? 0);

// Consulta preparada: los datos del formulario nunca se concatenan en el SQL
$stmt = $conexion->prepare(
    "UPDATE usuarios SET nombres = ?, apellidos = ?, correo = ?, rol_id = ?, estado = ? WHERE id = ?"
);
$stmt->bind_param("sssiii", $nombres, $apellidos, $correo, $rol, $estado, $id);

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_usuarios.php?edited=true");
} else {
    echo "Datos no editados";
}

$stmt->close();
$conexion->close();
