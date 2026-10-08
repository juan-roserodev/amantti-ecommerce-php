<?php
include("../Suministros/conexion.php");

$nombres = trim($_POST['nombres'] ?? '');
$apellidos = trim($_POST['apellidos'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$contraseña = $_POST['contraseña'] ?? ''; // Contraseña sin encriptar
$rol_id = 2;  // Establece el valor del rol_id como 2 (cliente)
$estado = 1;  // Establece el valor del estado como 1 (activo)

// Datos que se devuelven al formulario si hay un error (sin la contraseña)
$datosFormulario = http_build_query([
    'nombres' => $nombres,
    'apellidos' => $apellidos,
    'correo' => $correo,
    'rol_id' => $rol_id,
    'estado' => $estado,
]);

// Validación de la contraseña
if (strlen($contraseña) < 8 || !preg_match('/[A-Z]/', $contraseña) || !preg_match('/[a-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña) || preg_match('/[^a-zA-Z0-9]/', $contraseña)) {
    // La contraseña no cumple con los requisitos, mostrar la sweet_alert
    header("location:../Views/register.php?error=contraseña_invalida&" . $datosFormulario);
    exit;
}

// Verificar si el correo ya existe en la base de datos (consulta preparada)
$consulta = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
$consulta->bind_param("s", $correo);
$consulta->execute();
$consulta->store_result();
$correoExiste = $consulta->num_rows > 0;
$consulta->close();

if ($correoExiste) {
    // El correo ya existe, mostrar la sweet_alert
    header("location:../Views/register.php?error=existente&" . $datosFormulario);
} else {
    // El correo no existe, encriptar la contraseña y realizar la inserción
    $contraseñaEncriptada = password_hash($contraseña, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare(
        "INSERT INTO usuarios (nombres, apellidos, correo, contraseña, rol_id, estado) VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssssii", $nombres, $apellidos, $correo, $contraseñaEncriptada, $rol_id, $estado);

    if ($stmt->execute()) {
        header("location:../Views/login.php?added=true");
    } else {
        echo "Datos no insertados";
    }

    $stmt->close();
}

$conexion->close();
