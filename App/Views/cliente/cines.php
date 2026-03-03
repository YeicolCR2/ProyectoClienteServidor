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
    <title>Cines - Cine U XD</title>
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
                    <li><a href="/app/views/cliente/cines.php" class="active">Cines</a></li>
                    <li><a href="/app/views/cliente/contacto.php">Contacto</a></li>
                    <li><a href="/app/views/cliente/mis-reservas.php">Mis Reservas</a></li>
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
            <h1 class="page-title">📍 NUESTROS CINES</h1>
            
            <div class="cines-grid">
                <!-- Cine San José -->
                <div class="cine-card">
                    <div class="cine-header">
                        <h2>Cine U XD San José</h2>
                        <span class="cine-ciudad">San José</span>
                    </div>
                    <div class="cine-body">
                        <p class="cine-direccion">
                            <strong>📍 Dirección:</strong> Mall Central, San José
                        </p>
                        
                        <h3>Salas disponibles:</h3>
                        <div class="salas-grid">
                            <div class="sala-card">
                                <span class="sala-numero">Sala 1</span>
                                <span class="sala-tipo">2D</span>
                                <span class="sala-asientos">50 asientos</span>
                            </div>
                            <div class="sala-card">
                                <span class="sala-numero">Sala 2</span>
                                <span class="sala-tipo">3D</span>
                                <span class="sala-asientos">50 asientos</span>
                            </div>
                            <div class="sala-card">
                                <span class="sala-numero">Sala 3</span>
                                <span class="sala-tipo">IMAX</span>
                                <span class="sala-asientos">40 asientos</span>
                            </div>
                        </div>
                        
                        <div class="cine-contacto">
                            <p><strong>📞 Teléfono:</strong> 2222-3333</p>
                        </div>
                    </div>
                </div>

                <!-- Cine Escazú -->
                <div class="cine-card">
                    <div class="cine-header">
                        <h2>Cine U XD Escazú</h2>
                        <span class="cine-ciudad">Escazú</span>
                    </div>
                    <div class="cine-body">
                        <p class="cine-direccion">
                            <strong>📍 Dirección:</strong> Multiplaza Escazú
                        </p>
                        
                        <h3>Salas disponibles:</h3>
                        <div class="salas-grid">
                            <div class="sala-card">
                                <span class="sala-numero">Sala 1</span>
                                <span class="sala-tipo">2D</span>
                                <span class="sala-asientos">60 asientos</span>
                            </div>
                            <div class="sala-card">
                                <span class="sala-numero">Sala 2</span>
                                <span class="sala-tipo">3D</span>
                                <span class="sala-asientos">60 asientos</span>
                            </div>
                            <div class="sala-card">
                                <span class="sala-numero">Sala 3</span>
                                <span class="sala-tipo">4DX</span>
                                <span class="sala-asientos">40 asientos</span>
                            </div>
                            <div class="sala-card">
                                <span class="sala-numero">Sala 4</span>
                                <span class="sala-tipo">IMAX</span>
                                <span class="sala-asientos">50 asientos</span>
                            </div>
                        </div>
                        
                        <div class="cine-contacto">
                            <p><strong>📞 Teléfono:</strong> 2222-3344</p>
                        </div>
                    </div>
                </div>

                <!-- Cine Heredia -->
                <div class="cine-card">
                    <div class="cine-header">
                        <h2>Cine U XD Heredia</h2>
                        <span class="cine-ciudad">Heredia</span>
                    </div>
                    <div class="cine-body">
                        <p class="cine-direccion">
                            <strong>📍 Dirección:</strong> Mall Heredia
                        </p>
                        
                        <h3>Salas disponibles:</h3>
                        <div class="salas-grid">
                            <div class="sala-card">
                                <span class="sala-numero">Sala 1</span>
                                <span class="sala-tipo">2D</span>
                                <span class="sala-asientos">45 asientos</span>
                            </div>
                            <div class="sala-card">
                                <span class="sala-numero">Sala 2</span>
                                <span class="sala-tipo">3D</span>
                                <span class="sala-asientos">45 asientos</span>
                            </div>
                        </div>
                        
                        <div class="cine-contacto">
                            <p><strong>📞 Teléfono:</strong> 2222-3355</p>
                        </div>
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