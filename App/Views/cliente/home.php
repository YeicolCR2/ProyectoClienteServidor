<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/index.php?route=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/cliente.css?v=2">
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

                    <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] == 1): ?>
                        <li><a href="/public/index.php?route=admin">ADMIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-menu">
                <span class="user-pill"><?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/public/index.php?route=logout" class="btn-logout">
                    CERRAR SESIÓN
                </a>
            </div>

        </div>
    </header>

    <main class="page-container">
        <section class="page-intro">
            <h1>🎬 BIENVENIDO A CINE U XD</h1>
            <p>Disfruta de la cartelera, consulta cines y administra tus reservas.</p>
        </section>

        <section class="cards-grid">
            <div class="mini-card">
                <h2>Cartelera</h2>
                <p>Consulta las películas disponibles actualmente en el sistema.</p>
                <a href="/public/index.php?route=cartelera">Ver cartelera</a>
            </div>

            <div class="mini-card">
                <h2>Cines</h2>
                <p>Revisa los cines registrados y sus ubicaciones disponibles.</p>
                <a href="/public/index.php?route=cines">Ver cines</a>
            </div>

            <div class="mini-card">
                <h2>Mis Reservas</h2>
                <p>Consulta el historial y estado de tus reservas realizadas.</p>
                <a href="/public/index.php?route=reservas">Ver reservas</a>
            </div>
        </section>
    </main>

</body>
</html>