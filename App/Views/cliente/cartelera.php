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

            <div style="border:1px solid #ccc; margin:20px auto; padding:20px; max-width:600px; border-radius:10px;">

                <h2><?php echo $pelicula['titulo']; ?></h2>

                <p><strong>Duración:</strong> <?php echo $pelicula['duracion']; ?> min</p>

                <p><strong>Descripción:</strong> <?php echo $pelicula['descripcion']; ?></p>

                <p><strong>Estreno:</strong> <?php echo $pelicula['fecha_estreno']; ?></p>

                <div style="margin-top:10px;">

                    <!-- 🔥 BOTÓN CORREGIDO -->
                    <a href="/public/index.php?route=asientos&id=<?php echo urlencode($pelicula['id_pelicula']); ?>"
                       style="background:#6c5ce7; color:white; padding:10px 15px; text-decoration:none; border-radius:5px;">
                        🎟 Seleccionar Asiento
                    </a>

                </div>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p style="text-align:center;">No hay películas en cartelera</p>

    <?php endif; ?>

</main>

</body>
</html>