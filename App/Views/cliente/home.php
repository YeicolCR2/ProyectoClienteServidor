<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: /app/views/auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Cliente</title>
</head>
<body>
    <h1>Bienvenido <?php echo $_SESSION['usuario']['nombre']; ?></h1>
    <p>Has iniciado sesión como CLIENTE</p>
    <a href="/app/Controllers/LogoutController.php">Cerrar Sesión</a>
</body>
</html>