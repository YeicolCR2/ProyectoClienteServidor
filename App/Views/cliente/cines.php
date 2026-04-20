<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cines | Cine U XD</title>
    <link rel="stylesheet" href="/public/css/cines.css?v=2">
</head>
<body>

    <header class="main-header">
        <div class="header-container">

            <a href="/public/index.php?route=home" class="logo">
                CINE U XD
            </a>

            <nav class="main-nav">
                <ul>
                    <li><a href="/public/index.php?route=home">INICIO</a></li>
                    <li><a href="/public/index.php?route=cartelera">CARTELERA</a></li>
                    <li><a href="/public/index.php?route=cines" class="active">CINES</a></li>
                    <li><a href="/public/index.php?route=contacto">CONTACTO</a></li>
                    <li><a href="/public/index.php?route=reservas">MIS RESERVAS</a></li>

                    <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] == 1): ?>
                        <li><a href="/public/index.php?route=admin">ADMIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-menu">
                <span class="user-pill"><?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/public/index.php?route=logout" class="btn-logout">CERRAR SESIÓN</a>
            </div>

        </div>
    </header>

    <main class="cines-container">
        <h1 class="page-title">🎬 CINES DISPONIBLES</h1>
        <p class="page-subtitle">Consulta las ubicaciones registradas en el sistema</p>

        <div class="cines-grid">
            <?php if (!empty($cines)): ?>
                <?php foreach ($cines as $cine): ?>
                    <div class="cine-card">
                        <h2><?php echo htmlspecialchars($cine['nombre']); ?></h2>
                        <p><strong>Dirección:</strong> <?php echo htmlspecialchars($cine['direccion']); ?></p>
                        <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($cine['ciudad']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay cines registrados.</p>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>