<?php
session_start();

if(isset($_SESSION['usuario'])) {
    // Redirigir según el rol
    if($_SESSION['usuario']['rol'] === 'admin') {
        header("Location: /app/views/admin/dashboard.php");
    } else {
        header("Location: /app/views/cliente/home.php");
    }
    exit;
} else {
    // Si no hay sesión, mostrar login
    require_once '../app/views/auth/login.php';
}
?>