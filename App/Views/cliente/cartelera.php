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
    <title>Cartelera - Cine U XD</title>

    <!-- SOLO ESTE CSS PARA EVITAR CONFLICTOS -->
    <link rel="stylesheet" href="/public/css/carteleraEstilos.css">
</head>

<body class="cartelera-page">

    <header class="main-header">
        <div class="header-container">

            <a href="/public/index.php?route=home" class="logo">
                CINE U XD
            </a>

            <nav class="main-nav">
                <ul>
                    <li><a href="/public/index.php?route=home">INICIO</a></li>
                    <li><a href="/public/index.php?route=cartelera" class="active">CARTELERA</a></li>
                    <li><a href="/public/index.php?route=cines">CINES</a></li>
                    <li><a href="/public/index.php?route=contacto">CONTACTO</a></li>
                    <li><a href="/public/index.php?route=reservas">MIS RESERVAS</a></li>
                    <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] == 1): ?>
                        <li><a href="/public/index.php?route=admin">ADMIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-menu">
                <span class="user-pill">
                    👤 <?php echo $_SESSION['usuario']['nombre']; ?>
                </span>

                <a href="/public/index.php?route=logout" class="btn-logout">
                    CERRAR SESIÓN
                </a>
            </div>

        </div>
    </header>

    <main class="cartelera-container">

        <h1 class="page-title">🎬 CARTELERA</h1>
        <p class="page-subtitle">
            Descubre las películas disponibles y reserva tu asiento.
        </p>

        <?php if (isset($peliculas) && count($peliculas) > 0): ?>

            <div class="cartelera-grid">

                <?php foreach ($peliculas as $pelicula): ?>

                    <div class="pelicula-card">

                        <h2><?php echo $pelicula['titulo']; ?></h2>

                        <p>
                            <strong>Duración:</strong>
                            <?php echo $pelicula['duracion']; ?> min
                        </p>

                        <p>
                            <strong>Descripción:</strong>
                            <?php echo $pelicula['descripcion']; ?>
                        </p>

                        <p>
                            <strong>Estreno:</strong>
                            <?php echo $pelicula['fecha_estreno']; ?>
                        </p>

                        <div class="pelicula-actions">
                            <a href="/public/index.php?route=asientos&id=<?php echo urlencode($pelicula['id_pelicula']); ?>"
                                class="btn-reservar">
                                🎟 Seleccionar Asiento
                            </a>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php else: ?>

            <p class="no-peliculas">
                No hay películas en cartelera
            </p>

        <?php endif; ?>

    </main>

</body>

</html>