<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: /app/views/auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cartelera - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/cliente.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">🎬 Cine U XD</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php">Inicio</a></li>
                    <li><a href="/app/views/cliente/cartelera.php" class="active">Cartelera</a></li>
                    <li><a href="/app/views/cliente/mis-reservas.php">Mis Reservas</a></li>
                    <li><a href="/app/views/cliente/promociones.php">Promociones</a></li>
                </ul>
            </nav>
            <div class="user-menu">
                <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/app/Controllers/LogoutController.php" class="btn-logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <h1 class="page-title">🎬 CARTELERA</h1>
            
            <div class="peliculas-grid">
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=1'">
                    <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                    <div class="pelicula-info">
                        <h3>Spider-Man: No Way Home</h3>
                        <p>Acción | 148 min | 14+</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=2'">
                    <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                    <div class="pelicula-info">
                        <h3>Dragon Ball Super</h3>
                        <p>Animación | 100 min | 7+</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=3'">
                    <img src="/public/PIC/inter.jpg" alt="Interstellar">
                    <div class="pelicula-info">
                        <h3>Interstellar</h3>
                        <p>Ciencia Ficción | 169 min | 12+</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=4'">
                    <img src="/public/PIC/CR7.jpg" alt="CR7">
                    <div class="pelicula-info">
                        <h3>CR7: El Mundo a sus Pies</h3>
                        <p>Documental | 92 min | 7+</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <p>© <?= date("Y"); ?> Cine U XD - Todos los derechos reservados</p>
    </footer>
</body>
</html>