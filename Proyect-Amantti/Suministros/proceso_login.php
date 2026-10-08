<?php
// Verificar si no se ha iniciado una sesión antes de iniciar una
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("conexion.php");

if (isset($_POST['logueo'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Preparar la consulta SQL para prevenir inyección
    $query = "SELECT * FROM usuarios WHERE correo = ? AND estado = 1";
    $stmt = mysqli_prepare($conexion, $query);

    if ($stmt) {
        // Vincular el parámetro a la consulta
        mysqli_stmt_bind_param($stmt, "s", $correo);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_assoc($resultado);

            // Verificar la contraseña ingresada
            if (password_verify($contraseña, $usuario['contraseña'])) {
                // Los datos son correctos: se regenera el id de sesión (evita fijación de sesión)
                session_regenerate_id(true);
                $_SESSION['id_usuario'] = $usuario['id'];
                $_SESSION['rol_id'] = (int) $usuario['rol_id'];
                $_SESSION['correo'] = $usuario['correo'];
                $_SESSION['nombre'] = $usuario['nombres'];

                // Redirigir según el rol del usuario
                if ($usuario['rol_id'] == 1) {
                    header("location:../Views/Administrador/index_admin.php");
                    exit;
                } elseif ($usuario['rol_id'] == 2) {
                    header("location:../Views/Cliente/index.php");
                    exit;
                }
            } else {
                // Contraseña incorrecta
                $login_error = "Los datos ingresados no son correctos.";
            }
        } else {
            // Usuario no encontrado o está inactivo
            $login_error = "El correo ingresado no está registrado o el usuario está inactivo. Por favor, verifica tus datos.";
        }
    } else {
        // Error en la preparación de la consulta
        $login_error = "Error al procesar la solicitud. Inténtelo de nuevo más tarde.";
    }
}

// Mostrar mensaje de error si existe
if (isset($login_error)) {
    echo '<script>
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "' . $login_error . '"
        });
    </script>';
}
