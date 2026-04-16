<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['usuario'])) {
    header("Location: /public/index.php?route=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Cine U XD</title>

    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
</head>

<body>

<header class="main-header">
    <div class="header-container">

        <a href="/public/index.php?route=home" class="logo">
            CINE U XD
        </a>

        <nav class="main-nav">
            <ul>
                <li><a href="/public/index.php?route=home" class="active">INICIO</a></li>
                <li><a href="/public/index.php?route=cartelera">CARTELERA</a></li>
                <li><a href="/public/index.php?route=cines">CINES</a></li>
                <li><a href="/public/index.php?route=contacto">CONTACTO</a></li>
                <li><a href="/public/index.php?route=reservas">MIS RESERVAS</a></li>
            </ul>
        </nav>

        <div class="user-menu">
            <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
            <a href="/public/index.php?route=logout" class="btn-logout">
                CERRAR SESIÓN
            </a>
        </div>

    </div>
</header>

<main style="padding:40px; text-align:center;">
    <h1>Bienvenido al sistema de cine 🎬</h1>
    <p>Usa el menú para navegar</p>
</main>

</body>
</html>