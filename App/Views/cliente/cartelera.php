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
    <title>Cartelera - Cine U XD</title>
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
                    <li><a href="/app/views/cliente/cartelera.php" class="active">Cartelera</a></li>
                    <li><a href="/app/views/cliente/cines.php">Cines</a></li>
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
            <h1 class="page-title">🎬 CARTELERA</h1>
            
            <div class="filtros-container">
                <div class="filtro">
                    <label>Género:</label>
                    <select class="filtro-select" id="filtro-genero">
                        <option value="">Todos</option>
                        <option value="accion">Acción</option>
                        <option value="comedia">Comedia</option>
                        <option value="drama">Drama</option>
                        <option value="ciencia-ficcion">Ciencia Ficción</option>
                        <option value="animacion">Animación</option>
                    </select>
                </div>
                <div class="filtro">
                    <label>Formato:</label>
                    <select class="filtro-select">
                        <option>Todos</option>
                        <option>2D</option>
                        <option>3D</option>
                        <option>IMAX</option>
                        <option>4DX</option>
                    </select>
                </div>
            </div>

            <div class="cartelera-completa">
                <!-- Spider-Man -->
                <div class="pelicula-detalle">
                    <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                    <div class="detalle-info">
                        <h2>Spider-Man: No Way Home</h2>
                        <div class="detalle-meta">
                            <span class="clasificacion">14+</span>
                            <span class="duracion">148 min</span>
                            <span class="genero">Acción/Aventura</span>
                        </div>
                        <p class="sinopsis">Por primera vez en la historia cinematográfica de Spider-Man, nuestro héroe es desenmascarado y ya no puede separar su vida normal de los grandes riesgos que conlleva ser un superhéroe.</p>
                        <div class="detalle-horarios">
                            <h3>Horarios disponibles:</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=14:30" class="horario-btn">14:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=17:00" class="horario-btn">17:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=19:30" class="horario-btn">19:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=22:00" class="horario-btn">22:00</a>
                            </div>
                        </div>
                        <a href="/app/views/cliente/reserva.php?pelicula=1" class="btn-reservar-grande">RESERVAR AHORA</a>
                    </div>
                </div>

                <!-- Dragon Ball -->
                <div class="pelicula-detalle">
                    <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                    <div class="detalle-info">
                        <h2>Dragon Ball Super: Super Hero</h2>
                        <div class="detalle-meta">
                            <span class="clasificacion">7+</span>
                            <span class="duracion">100 min</span>
                            <span class="genero">Animación</span>
                        </div>
                        <p class="sinopsis">La Patrulla Roja ha sido revivida por dos personas que heredaron el genio de su abuelo. Han creado nuevos androides y han atacado a Piccolo y Gohan.</p>
                        <div class="detalle-horarios">
                            <h3>Horarios disponibles:</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=2&horario=15:00" class="horario-btn">15:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=2&horario=17:30" class="horario-btn">17:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=2&horario=20:00" class="horario-btn">20:00</a>
                            </div>
                        </div>
                        <a href="/app/views/cliente/reserva.php?pelicula=2" class="btn-reservar-grande">RESERVAR AHORA</a>
                    </div>
                </div>

                <!-- Interstellar -->
                <div class="pelicula-detalle">
                    <img src="/public/PIC/inter.jpg" alt="Interstellar">
                    <div class="detalle-info">
                        <h2>Interstellar</h2>
                        <div class="detalle-meta">
                            <span class="clasificacion">12+</span>
                            <span class="duracion">169 min</span>
                            <span class="genero">Ciencia Ficción</span>
                        </div>
                        <p class="sinopsis">Un grupo de exploradores viaja a través de un agujero de gusano en el espacio en un intento por asegurar la supervivencia de la humanidad.</p>
                        <div class="detalle-horarios">
                            <h3>Horarios disponibles:</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=3&horario=16:00" class="horario-btn">16:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=3&horario=19:00" class="horario-btn">19:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=3&horario=22:30" class="horario-btn">22:30</a>
                            </div>
                        </div>
                        <a href="/app/views/cliente/reserva.php?pelicula=3" class="btn-reservar-grande">RESERVAR AHORA</a>
                    </div>
                </div>

                <!-- CR7 -->
                <div class="pelicula-detalle">
                    <img src="/public/PIC/CR7.jpg" alt="CR7">
                    <div class="detalle-info">
                        <h2>CR7: El Mundo a sus Pies</h2>
                        <div class="detalle-meta">
                            <span class="clasificacion">7+</span>
                            <span class="duracion">92 min</span>
                            <span class="genero">Documental</span>
                        </div>
                        <p class="sinopsis">Documental que sigue la vida y carrera de Cristiano Ronaldo, desde sus humildes comienzos hasta convertirse en una de las mayores estrellas del fútbol mundial.</p>
                        <div class="detalle-horarios">
                            <h3>Horarios disponibles:</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=4&horario=18:30" class="horario-btn">18:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=4&horario=21:00" class="horario-btn">21:00</a>
                            </div>
                        </div>
                        <a href="/app/views/cliente/reserva.php?pelicula=4" class="btn-reservar-grande">RESERVAR AHORA</a>
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

    <style>
    .btn-reservar-grande {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 30px;
        background: linear-gradient(135deg, #187bcd, #6bc9da);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        font-size: 16px;
        transition: all 0.3s;
        text-align: center;
    }
    
    .btn-reservar-grande:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(24,123,205,0.4);
    }
    
    .horario-btn {
        display: inline-block;
        padding: 10px 20px;
        background: rgba(255,255,255,0.1);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s;
        margin: 5px;
    }
    
    .horario-btn:hover {
        background: #187bcd;
        transform: translateY(-2px);
    }
    </style>
</body>
</html>