<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    // La sesión no está iniciada, redirige al inicio de sesión
    header("location:../Views/login.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Configuración de la página -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN - AMANTTI</title>

    <!-- Enlaces a archivos de estilo CSS y fuentes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="../Css/Styles_crud.css">
</head>

<body>
    <nav id="navegacion" class="navbar navbar-expand-md navbar">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="../Views/Administrador/index_admin.php">
                <img src="../Img/logo.jpeg" width="50" height="50" alt="Logo" class="me-2 rounded-circle"> <!-- Logo de la marca -->
                <span class="text-white title-amantti">AMANTTI</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link " href="../Views/Administrador/crud_usuarios.php"><button type="button" class="btn btn-danger ">Cancelar</button></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="card-header justify-content-center">
                    <div class="card-title text-center mb-4 col-12 d-grid justify-content-center">
                        <h2 class="border border-4 border-primary rounded-4 p-2"><strong>FORMULARIO - USUARIOS</strong></h2>
                    </div>
                    <div class="container-fluid mb-5">
                        <form action="../CRUD/insertar_usuarios.php" method="POST">
                            <div class="row">
                                <!-- Columna izquierda -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Nombres" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" name="nombres" id="Nombres" placeholder="Nombres" value="<?php echo htmlspecialchars($_GET['nombres'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Apellidos" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos" id="Apellidos" placeholder="Apellidos" value="<?php echo htmlspecialchars($_GET['apellidos'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Correo" class="form-label">Correo</label>
                                        <input type="email" class="form-control" name="correo" id="Correo" placeholder="Correo" value="<?php echo htmlspecialchars($_GET['correo'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                </div>
                                <!-- Columna derecha -->
                                <div class="col-12 col-md-6">
                                    <div class="mb-5 col-12 mx-auto position-relative">
                                        <label for="Contraseña" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="contraseña" id="Contraseña" placeholder="Contraseña" required>
                                        <i class="fa fa-eye-slash password-toggle" id="togglePassword"></i>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Rol" class="form-label">Rol</label>
                                        <select id="Rol" class="form-select" name="rol" required>
                                            <option selected disabled>Seleccionar Rol</option>
                                            <?php
                                            include("../Suministros/conexion.php");

                                            $sql = $conexion->query("SELECT * FROM roles WHERE id IN (1,2)");
                                            while ($resultado = $sql->fetch_assoc()) {
                                                $selected = (isset($_GET['rol']) && $_GET['rol'] == $resultado['id']) ? 'selected' : '';
                                                echo "<option value='" . $resultado['id'] . "' $selected>" . $resultado['rol'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-5 col-12 mx-auto">
                                        <label for="Estado" class="form-label">Estado</label>
                                        <select id="Estado" class="form-select" name="estado" required>
                                            <option selected disabled>Seleccionar Estado</option>
                                            <?php
                                            $sql = $conexion->query("SELECT * FROM parametros WHERE id IN (1)");
                                            while ($resultado = $sql->fetch_assoc()) {
                                                $selected = (isset($_GET['estado']) && $_GET['estado'] == $resultado['id']) ? 'selected' : '';
                                                echo "<option value='" . $resultado['id'] . "' $selected>" . $resultado['valor'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-5 text-center">
                                    <button type="submit" class="btn btn-primary col-6">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../Js/eye.js"></script>

    <script>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === "existente") {
        ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Este correo ya pertenece a una cuenta.',
            });
        <?php
        }
        ?>
    </script>

    <script>
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