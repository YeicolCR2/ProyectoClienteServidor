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
                </ul>
            </nav>

            <div class="user-menu">
                <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/public/index.php?route=logout" class="btn-logout">CERRAR SESIÓN</a>
            </div>

        </div>
    </header>

    <main style="padding:40px;">

        <h1 style="text-align:center;">🎬 CARTELERA</h1>

        <?php if (isset($peliculas) && count($peliculas) > 0): ?>
            <?php foreach ($peliculas as $pelicula): ?>
                <div class="pelicula-card">
                    <img src="/public/pic/<?php echo htmlspecialchars($pelicula['imagen'] ?? 'default.jpg'); ?>"
                        alt="<?php echo htmlspecialchars($pelicula['titulo']); ?>"
                        style="width:200px; height:auto;">
                    <h3><?php echo htmlspecialchars($pelicula['titulo']); ?></h3>
                    <p>Duración: <?php echo $pelicula['duracion']; ?> min</p>
                    <p><?php echo htmlspecialchars($pelicula['descripcion']); ?></p>
                    <p>Estreno: <?php echo $pelicula['fecha_estreno']; ?></p>
                    <a href="/public/index.php?route=asientos&id=<?php echo $pelicula['id_pelicula']; ?>">Seleccionar Asiento</a>
                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <p style="text-align:center;">No hay películas en cartelera</p>

        <?php endif; ?>

    </main>

</body>

</html>