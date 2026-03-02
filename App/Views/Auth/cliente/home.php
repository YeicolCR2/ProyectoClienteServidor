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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/cliente.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">🎬 Cine U XD</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php" class="active">Inicio</a></li>
                    <li><a href="/app/views/cliente/cartelera.php">Cartelera</a></li>
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
            <h1 class="page-title">🎬 Bienvenido a Cine U XD</h1>
            <p>Hola <?php echo $_SESSION['usuario']['nombre']; ?>, disfruta de las mejores películas.</p>
            
            <div class="peliculas-grid">
                <!-- Spider-Man -->
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=1'">
                    <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                    <div class="pelicula-info">
                        <h3>Spider-Man: No Way Home</h3>
                        <p>Acción • 148 min</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
                
                <!-- Dragon Ball -->
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=2'">
                    <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                    <div class="pelicula-info">
                        <h3>Dragon Ball Super</h3>
                        <p>Animación • 100 min</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
                
                <!-- Interstellar -->
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=3'">
                    <img src="/public/PIC/inter.jpg" alt="Interstellar">
                    <div class="pelicula-info">
                        <h3>Interstellar</h3>
                        <p>Ciencia Ficción • 169 min</p>
                        <button class="btn-reservar">Reservar</button>
                    </div>
                </div>
                
                <!-- CR7 -->
                <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=4'">
                    <img src="/public/PIC/CR7.jpg" alt="CR7">
                    <div class="pelicula-info">
                        <h3>CR7: El Mundo a sus Pies</h3>
                        <p>Documental • 92 min</p>
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