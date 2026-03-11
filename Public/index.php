<?php
session_start();

// Verificar si el usuario ya inició sesión
if(isset($_SESSION['usuario'])) {
    // Si es admin, redirigir a dashboard
    if($_SESSION['usuario']['rol'] === 'admin') {
        header("Location: /app/views/admin/dashboard.php");
    } else {
        // Si es cliente, redirigir a home
        header("Location: /app/views/cliente/home.php");
    }
    exit;
} else {
    // Si no hay sesión, redirigir al login
    header("Location: /app/views/auth/login.php");
    exit;
}
?>