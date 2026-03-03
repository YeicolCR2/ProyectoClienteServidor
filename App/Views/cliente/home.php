<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: /app/views/auth/login.php");
    exit;
}
$titulo = 'Inicio - Cine U XD';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="/public/css/base.css">
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
      <!-- HERO SLIDER CORREGIDO -->
<section class="hero-slider">
    <div class="slider-container">
        <div class="slide active" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('/public/PIC/spiderman.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="slide-content">
                <h1>Spider-Man: No Way Home</h1>
                <p>No hay spoilers, solo acción</p>
                <a href="/app/views/cliente/reserva.php?pelicula=1" class="btn-primary">Reservar Ahora</a>
            </div>
        </div>
        <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('/public/PIC/dbz.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="slide-content">
                <h1>Dragon Ball Super</h1>
                <p>La batalla más épica te espera</p>
                <a href="/app/views/cliente/reserva.php?pelicula=2" class="btn-primary">Reservar Ahora</a>
            </div>
        </div>
        <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('/public/PIC/inter.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="slide-content">
                <h1>Interstellar</h1>
                <p>El viaje espacial que lo cambió todo</p>
                <a href="/app/views/cliente/reserva.php?pelicula=3" class="btn-primary">Reservar Ahora</a>
            </div>
        </div>
    </div>
    <button class="slider-btn prev" onclick="cambiarSlide(-1)">❮</button>
    <button class="slider-btn next" onclick="cambiarSlide(1)">❯</button>
    <div class="slider-dots">
        <span class="dot active" onclick="irASlide(0)"></span>
        <span class="dot" onclick="irASlide(1)"></span>
        <span class="dot" onclick="irASlide(2)"></span>
    </div>
</section>

        <!-- PELÍCULAS EN CARTELERA -->
        <section class="peliculas-section">
            <div class="container">
                <h2 class="section-title">🎥 EN CARTELERA</h2>
                <div class="peliculas-grid">
                    <!-- Spider-Man -->
                    <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=1'">
                        <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                        <div class="pelicula-info">
                            <h3>Spider-Man: No Way Home</h3>
                            <p class="genero">Acción/Aventura</p>
                            <p class="duracion">148 min | 14+</p>
                            <div class="horarios">
                                <span>14:30</span>
                                <span>17:00</span>
                                <span>19:30</span>
                                <span>22:00</span>
                            </div>
                            <button class="btn-reservar">Reservar</button>
                        </div>
                    </div>

                    <!-- Dragon Ball -->
                    <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=2'">
                        <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                        <div class="pelicula-info">
                            <h3>Dragon Ball Super: Super Hero</h3>
                            <p class="genero">Animación</p>
                            <p class="duracion">100 min | 7+</p>
                            <div class="horarios">
                                <span>15:00</span>
                                <span>17:30</span>
                                <span>20:00</span>
                            </div>
                            <button class="btn-reservar">Reservar</button>
                        </div>
                    </div>

                    <!-- Interstellar -->
                    <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=3'">
                        <img src="/public/PIC/inter.jpg" alt="Interstellar">
                        <div class="pelicula-info">
                            <h3>Interstellar</h3>
                            <p class="genero">Ciencia Ficción</p>
                            <p class="duracion">169 min | 12+</p>
                            <div class="horarios">
                                <span>16:00</span>
                                <span>19:00</span>
                                <span>22:30</span>
                            </div>
                            <button class="btn-reservar">Reservar</button>
                        </div>
                    </div>

                    <!-- CR7 -->
                    <div class="pelicula-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=4'">
                        <img src="/public/PIC/CR7.jpg" alt="CR7">
                        <div class="pelicula-info">
                            <h3>CR7: El Mundo a sus Pies</h3>
                            <p class="genero">Documental</p>
                            <p class="duracion">92 min | 7+</p>
                            <div class="horarios">
                                <span>18:30</span>
                                <span>21:00</span>
                            </div>
                            <button class="btn-reservar">Reservar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PRÓXIMOS ESTRENOS -->
        <section class="proximos-section">
            <div class="container">
                <h2 class="section-title">🔜 PRÓXIMOS ESTRENOS</h2>
                <div class="proximos-grid">
                    <div class="proximo-card">
                        <img src="/public/PIC/avatar.jpg" alt="Avatar">
                        <h3>Avatar 3</h3>
                        <p>Estreno: 15 Dic 2026</p>
                    </div>
                    <div class="proximo-card">
                        <img src="/public/PIC/avengers.jpg" alt="Avengers">
                        <h3>Avengers: Secret Wars</h3>
                        <p>Estreno: 30 Ene 2027</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
let slideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function mostrarSlide(n) {
    if (n >= slides.length) slideIndex = 0;
    if (n < 0) slideIndex = slides.length - 1;
    
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));
    
    slides[slideIndex].classList.add('active');
    dots[slideIndex].classList.add('active');
}

function cambiarSlide(direccion) {
    slideIndex += direccion;
    mostrarSlide(slideIndex);
}

function irASlide(n) {
    slideIndex = n;
    mostrarSlide(slideIndex);
}

// Auto slider
setInterval(() => {
    slideIndex++;
    mostrarSlide(slideIndex);
}, 5000);
</script>

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