<?php
require_once("../Suministros/verificar_admin.php");
include("../Suministros/conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $precio = (int) ($_POST['precio'] ?? 0);
    $cantidad = (int) ($_POST['cantidad'] ?? 0);
    $categoria = (int) ($_POST['categoria'] ?? 0);
    $proveedor = (int) ($_POST['proveedor'] ?? 0);
    $estado = (int) ($_POST['estado'] ?? 0);
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Directorio donde se guardarán las imágenes
    $directorio_imagenes = '../Img/';
    $ruta_imagen = '';

    // Verificar si se subió una imagen válida
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        if (!in_array($extension, $extensionesPermitidas, true)) {
            echo "Formato de imagen no permitido";
            exit;
        }

        $ruta_imagen = $directorio_imagenes . $nombreArchivo;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen);
    }

    // Consulta preparada: los datos del formulario nunca se concatenan en el SQL
    $stmt = $conexion->prepare(
        "INSERT INTO productos (nombre, precio, cantidad, imagen, categoria, proveedor, estado, descripcion)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("siisiiis", $nombre, $precio, $cantidad, $ruta_imagen, $categoria, $proveedor, $estado, $descripcion);

    if ($stmt->execute()) {
        header("location:../Views/Administrador/crud_productos.php?added=true");
    } else {
        echo "Datos no insertados";
    }

    $stmt->close();
    $conexion->close();
}
