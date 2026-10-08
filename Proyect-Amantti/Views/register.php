<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../Css/Styles_register.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>

<body>
    <!-- Sección principal que ocupa toda la altura de la ventana -->
    <section class="vh-100 gradient-custom">
        <div class="container-fluid py-3 h-100 w-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-7">
                    <!-- Tarjeta de registro -->
                    <div class="card bg-light text-black" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h2 class="fw-bold mb-3">¡REGÍSTRATE AHORA!</h2>
                            <img src="../Img/logo.jpeg" alt="logo" class="image-logo mb-4">
                            <form action="../Suministros/registro_usuarios.php" method="POST">
                                <div class="row">
                                    <!-- Campo para Nombres -->
                                    <div class="col-md-6 mb-4 text-start">
                                        <label for="Nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" name="nombres" id="Nombres" placeholder="Nombres" value="<?php echo htmlspecialchars($_GET['nombres'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <!-- Campo para Apellidos -->
                                    <div class="col-md-6 mb-4 text-start">
                                        <label for="Apellidos" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos" id="Apellidos" placeholder="Apellidos" value="<?php echo htmlspecialchars($_GET['apellidos'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Campo para Correo -->
                                    <div class="col-md-6 mb-4 text-start">
                                        <label for="Correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" name="correo" id="Correo" placeholder="Correo" value="<?php echo htmlspecialchars($_GET['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <!-- Campo para Contraseña -->
                                    <div class="col-md-6 mb-4 position-relative text-start">
                                        <label for="Contraseña" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="contraseña" id="Contraseña" placeholder="Contraseña" required>
                                        <i class="fa fa-eye-slash password-toggle" id="togglePassword"></i>
                                    </div>
                                </div>
                                <div class="mt-1 d-flex justify-content-center gap-3">
                                    <!-- Botón de Registrarse -->
                                    <button type="submit" class="btn btn-outline-dark col-3">Registrarse</button>
                                    <!-- Botón de Cancelar -->
                                    <a href="./login.php" class="btn btn-outline-danger col-3">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <!-- Script personalizado para manejar el ojo en la contraseña -->
    <script src="../Js/eye.js"></script>

    <script>
        // Verificación de errores a través de parámetros en la URL
        <?php if (isset($_GET['error']) && $_GET['error'] === "existente") { ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Este correo ya pertenece a una cuenta.',
            });
        <?php } ?>

        <?php if (isset($_GET['error']) && $_GET['error'] === "contraseña_invalida") { ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La contraseña debe tener al menos 8 caracteres y contener al menos una letra mayúscula, una letra minúscula y un valor númerico.',
            });
        <?php } ?>
    </script>
</body>

</html>