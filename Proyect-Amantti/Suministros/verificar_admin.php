<?php
// Control de acceso para las operaciones del panel administrativo.
// Solo permite continuar a usuarios autenticados con rol de administrador (rol_id = 1).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario']) || (int) ($_SESSION['rol_id'] ?? 0) !== 1) {
    header("location:../Views/login.php");
    exit;
}
