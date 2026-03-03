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
    <title>Mis Reservas - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">🎬 Cine U XD</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php">Inicio</a></li>
                    <li><a href="/app/views/cliente/cartelera.php">Cartelera</a></li>
                    <li><a href="/app/views/cliente/cines.php">Cines</a></li>
                    <li><a href="/app/views/cliente/contacto.php">Contacto</a></li>
                    <li><a href="/app/views/cliente/mis-reservas.php" class="active">Mis Reservas</a></li>
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
            <h1 class="page-title">🎟️ MIS RESERVAS</h1>
            
            <h2>Reservas Activas</h2>
            <div class="reservas-grid">
                <div class="reserva-card">
                    <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                    <div class="reserva-info">
                        <h3>Spider-Man: No Way Home</h3>
                        <p><strong>Fecha:</strong> 15/03/2026</p>
                        <p><strong>Horario:</strong> 19:30</p>
                        <p><strong>Sala:</strong> Sala 3 - IMAX</p>
                        <p><strong>Cine:</strong> Cine U XD San José</p>
                        <p><strong>Asientos:</strong> A12, A13</p>
                        <p><strong>Total:</strong> ₡7,000</p>
                        <div class="reserva-acciones">
                            <span class="badge activa">Activa</span>
                            <button class="btn-cancelar">Cancelar</button>
                        </div>
                    </div>
                </div>

                <div class="reserva-card">
                    <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                    <div class="reserva-info">
                        <h3>Dragon Ball Super: Super Hero</h3>
                        <p><strong>Fecha:</strong> 16/03/2026</p>
                        <p><strong>Horario:</strong> 17:30</p>
                        <p><strong>Sala:</strong> Sala 1 - 2D</p>
                        <p><strong>Cine:</strong> Cine U XD Escazú</p>
                        <p><strong>Asientos:</strong> B5, B6</p>
                        <p><strong>Total:</strong> ₡5,000</p>
                        <div class="reserva-acciones">
                            <span class="badge activa">Activa</span>
                            <button class="btn-cancelar">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="mt-4">Historial</h2>
            <div class="reservas-grid">
                <div class="reserva-card historial">
                    <img src="/public/PIC/inter.jpg" alt="Interstellar">
                    <div class="reserva-info">
                        <h3>Interstellar</h3>
                        <p><strong>Fecha:</strong> 10/03/2026</p>
                        <p><strong>Horario:</strong> 22:30</p>
                        <p><strong>Asientos:</strong> C3, C4, C5</p>
                        <p><strong>Total:</strong> ₡10,500</p>
                        <span class="badge completada">Completada</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Cine U XD</h4>
                <p>Tu mejor experiencia cinematográfica</p>
            </div>
            <div class="footer-section">
                <h4>Contacto</h4>
                <p>📍 Mall Central, San José</p>
                <p>📞 2222-3333</p>
                <p>✉ info@cineuxd.com</p>
            </div>
            <div class="footer-section">
                <h4>Horarios</h4>
                <p>Lunes a Domingo</p>
                <p>12:00 PM - 12:00 AM</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?= date("Y"); ?> Cine U XD - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>