<?php
require_once("../Suministros/verificar_admin.php");
include('../Suministros/conexion.php');

// Obtener y normalizar los datos del formulario
$id = (int) ($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');
$precio = (int) ($_POST['precio'] ?? 0);
$cantidad = (int) ($_POST['cantidad'] ?? 0);
$estado = (int) ($_POST['estado'] ?? 0);
$categoria = (int) ($_POST['categoria'] ?? 0);
$proveedor = (int) ($_POST['proveedor'] ?? 0);
$imagen = isset($_FILES['imagen']['name']) ? basename($_FILES['imagen']['name']) : '';

if ($imagen !== '') {
    // Solo se aceptan archivos de imagen
    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $extension = strtolower(pathinfo($imagen, PATHINFO_EXTENSION));
    if (!in_array($extension, $extensionesPermitidas, true)) {
        echo "Formato de imagen no permitido";
        exit;
    }

    move_uploaded_file($_FILES['imagen']['tmp_name'], '../Img/' . $imagen);

    // Consulta preparada que también actualiza la imagen
    $stmt = $conexion->prepare(
        "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, estado = ?,
         categoria = ?, proveedor = ?, imagen = ? WHERE id = ?"
    );
    $stmt->bind_param("ssiiiiisi", $nombre, $descripcion, $precio, $cantidad, $estado, $categoria, $proveedor, $imagen, $id);
} else {
    // Consulta preparada sin cambiar la imagen actual
    $stmt = $conexion->prepare(
        "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, estado = ?,
         categoria = ?, proveedor = ? WHERE id = ?"
    );
    $stmt->bind_param("ssiiiiii", $nombre, $descripcion, $precio, $cantidad, $estado, $categoria, $proveedor, $id);
}

if ($stmt->execute()) {
    header("location:../Views/Administrador/crud_productos.php?edited=true");
} else {
    echo "Error al editar el producto.";
}

$stmt->close();
$conexion->close();
