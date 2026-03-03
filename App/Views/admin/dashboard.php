<?php
session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /app/views/auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Bienvenido Admin <?php echo $_SESSION['usuario']['nombre']; ?></h1>
    <p>Panel de administración</p>
    <a href="/app/Controllers/LogoutController.php">Cerrar Sesión</a>
</body>
</html>