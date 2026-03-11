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
    <title>Inicio 2060 - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap');
        
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9d00ff;
            --neon-pink: #ff00c8;
            --dark-bg: #0a0a0f;
            --glass-bg: rgba(255,255,255,0.05);
        }

        body {
            background: var(--dark-bg);
            font-family: 'Rajdhani', sans-serif;
            margin: 0;
            color: #fff;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-header {
            background: rgba(10,10,15,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--neon-blue);
            box-shadow: 0 0 20px rgba(0,243,255,0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 32px;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(0,243,255,0.5);
            text-decoration: none;
        }

        .logo-year {
            font-size: 16px;
            background: linear-gradient(135deg, var(--neon-purple), var(--neon-pink));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .main-nav ul {
            display: flex;
            list-style: none;
            gap: 30px;
            margin: 0;
            padding: 0;
        }

        .main-nav a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 14px;
            position: relative;
            padding: 10px 0;
        }

        .main-nav a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            transition: width 0.3s;
        }

        .main-nav a:hover::after,
        .main-nav a.active::after {
            width: 100%;
        }

        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-menu span {
            background: linear-gradient(135deg, rgba(0,243,255,0.1), rgba(157,0,255,0.1));
            border: 1px solid var(--neon-blue);
            box-shadow: 0 0 15px rgba(0,243,255,0.3);
            padding: 8px 15px;
            border-radius: 20px;
            color: #fff;
            font-weight: 500;
        }

        .btn-logout {
            background: transparent;
            border: 1px solid var(--neon-pink);
            color: var(--neon-pink);
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
        }

        .btn-logout:hover {
            background: var(--neon-pink);
            color: var(--dark-bg);
            box-shadow: 0 0 20px var(--neon-pink);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .section {
            padding: 60px 0;
        }

        .section-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 42px;
            text-align: center;
            margin-bottom: 50px;
            color: #fff;
            position: relative;
        }

        .section-title span {
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hero Slider */
        .hero-slider {
            height: 80vh;
            position: relative;
            overflow: hidden;
        }

        .slider-container {
            position: relative;
            height: 100%;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover !important;
            background-position: center !important;
        }

        .slide.active {
            opacity: 1;
        }

        .slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0,0,0,0.8), transparent);
        }

        .slide-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 40px;
            color: #fff;
        }

        .slide-content h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 48px;
            margin-bottom: 20px;
            text-shadow: 0 0 20px rgba(0,243,255,0.5);
        }

        .slide-content p {
            font-size: 20px;
            margin-bottom: 30px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            color: #fff;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0,243,255,0.5);
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0,0,0,0.5);
            color: #fff;
            border: none;
            padding: 15px 20px;
            cursor: pointer;
            font-size: 24px;
            z-index: 10;
            border-radius: 5px;
        }

        .slider-btn.prev {
            left: 20px;
        }

        .slider-btn.next {
            right: 20px;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.5);
            cursor: pointer;
        }

        .dot.active {
            background: var(--neon-blue);
            box-shadow: 0 0 10px var(--neon-blue);
        }

        /* Grid de Películas */
        .movies-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .movie-card {
            background: var(--glass-bg);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid rgba(0,243,255,0.2);
            transition: all 0.3s;
            cursor: pointer;
        }

        .movie-card:hover {
            transform: translateY(-10px);
            border-color: var(--neon-blue);
            box-shadow: 0 20px 30px rgba(0,243,255,0.2);
        }

        .movie-card img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .movie-info {
            padding: 20px;
        }

        .movie-info h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .movie-meta {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .movie-meta span {
            background: rgba(0,243,255,0.1);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .movie-horarios {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .movie-horarios span {
            background: rgba(255,255,255,0.1);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        /* Carrusel de Próximos Estrenos */
        .premieres-section {
            background: linear-gradient(180deg, transparent, rgba(0,243,255,0.05));
        }

        .premieres-carousel {
            position: relative;
            margin: 40px 0;
            padding: 0 60px;
        }

        .carousel-container {
            overflow: hidden;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-slide {
            min-width: 100%;
            padding: 0 10px;
        }

        .premiere-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 500px;
            cursor: pointer;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .premiere-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .premiere-card:hover .premiere-card-inner {
            transform: rotateY(180deg);
        }

        .premiere-front,
        .premiere-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 20px;
        }

        .premiere-front {
            background-size: cover !important;
            background-position: center !important;
            display: flex;
            align-items: flex-end;
            padding: 30px;
        }

        .premiere-front::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        }

        .premiere-front-content {
            position: relative;
            z-index: 2;
            color: #fff;
        }

        .premiere-front h3 {
            font-size: 32px;
            font-family: 'Orbitron', sans-serif;
            margin-bottom: 10px;
            text-shadow: 0 0 10px rgba(0,243,255,0.5);
        }

        .premiere-front p {
            font-size: 18px;
            color: var(--neon-blue);
        }

        .premiere-back {
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            transform: rotateY(180deg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .premiere-back-content {
            color: #fff;
        }

        .premiere-back h4 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .premiere-back p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn-neon {
            background: var(--dark-bg);
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-neon:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(255,255,255,0.3);
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            border: none;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            box-shadow: 0 0 20px rgba(0,243,255,0.3);
        }

        .carousel-btn:hover {
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 0 30px rgba(0,243,255,0.5);
        }

        .carousel-btn.prev {
            left: 0;
        }

        .carousel-btn.next {
            right: 0;
        }

        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            cursor: pointer;
            transition: all 0.3s;
        }

        .carousel-dot.active {
            background: var(--neon-blue);
            box-shadow: 0 0 10px var(--neon-blue);
            transform: scale(1.2);
        }

        /* Footer */
        .main-footer {
            background: linear-gradient(180deg, transparent, rgba(0,243,255,0.1));
            border-top: 1px solid var(--neon-blue);
            margin-top: 60px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
            color: rgba(255,255,255,0.7);
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">CINE U XD <span class="logo-year">2060</span></a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php" class="active">INICIO</a></li>
                    <li><a href="/app/views/cliente/cartelera.php">CARTELERA</a></li>
                    <li><a href="/app/views/cliente/cines.php">CINES 2060</a></li>
                    <li><a href="/app/views/cliente/contacto.php">CONTACTO</a></li>
                    <li><a href="/app/views/cliente/mis-reservas.php">MIS RESERVAS</a></li>
                </ul>
            </nav>
            <div class="user-menu">
                <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/app/Controllers/LogoutController.php" class="btn-logout">CERRAR SESIÓN</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Slider -->
        <section class="hero-slider">
            <div class="slider-container">
                <div class="slide active" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/public/PIC/spiderman.jpg');">
                    <div class="slide-content">
                        <h1>SPIDER-MAN: NO WAY HOME</h1>
                        <p>La experiencia cinematográfica definitiva</p>
                        <a href="/app/views/cliente/reserva.php?pelicula=1" class="btn-primary">RESERVAR AHORA</a>
                    </div>
                </div>
                <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/public/PIC/dbz.jpg');">
                    <div class="slide-content">
                        <h1>DRAGON BALL SUPER</h1>
                        <p>La batalla más épica te espera</p>
                        <a href="/app/views/cliente/reserva.php?pelicula=2" class="btn-primary">RESERVAR AHORA</a>
                    </div>
                </div>
                <div class="slide" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('/public/PIC/inter.jpg');">
                    <div class="slide-content">
                        <h1>INTERSTELLAR</h1>
                        <p>El viaje espacial que lo cambió todo</p>
                        <a href="/app/views/cliente/reserva.php?pelicula=3" class="btn-primary">RESERVAR AHORA</a>
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

        <!-- Películas en Cartelera -->
        <section class="section">
            <div class="container">
                <h2 class="section-title"><span>EN CARTELERA</span></h2>
                <div class="movies-grid">
                    <div class="movie-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=1'">
                        <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                        <div class="movie-info">
                            <h3>Spider-Man: No Way Home</h3>
                            <div class="movie-meta">
                                <span>14+</span>
                                <span>148 min</span>
                                <span>Acción</span>
                            </div>
                            <div class="movie-horarios">
                                <span>14:30</span>
                                <span>17:00</span>
                                <span>19:30</span>
                                <span>22:00</span>
                            </div>
                        </div>
                    </div>

                    <div class="movie-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=2'">
                        <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                        <div class="movie-info">
                            <h3>Dragon Ball Super</h3>
                            <div class="movie-meta">
                                <span>7+</span>
                                <span>100 min</span>
                                <span>Animación</span>
                            </div>
                            <div class="movie-horarios">
                                <span>15:00</span>
                                <span>17:30</span>
                                <span>20:00</span>
                            </div>
                        </div>
                    </div>

                    <div class="movie-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=3'">
                        <img src="/public/PIC/inter.jpg" alt="Interstellar">
                        <div class="movie-info">
                            <h3>Interstellar</h3>
                            <div class="movie-meta">
                                <span>12+</span>
                                <span>169 min</span>
                                <span>Ciencia Ficción</span>
                            </div>
                            <div class="movie-horarios">
                                <span>16:00</span>
                                <span>19:00</span>
                                <span>22:30</span>
                            </div>
                        </div>
                    </div>

                    <div class="movie-card" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=4'">
                        <img src="/public/PIC/CR7.jpg" alt="CR7">
                        <div class="movie-info">
                            <h3>CR7: El Mundo a sus Pies</h3>
                            <div class="movie-meta">
                                <span>7+</span>
                                <span>92 min</span>
                                <span>Documental</span>
                            </div>
                            <div class="movie-horarios">
                                <span>18:30</span>
                                <span>21:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<!-- Próximos Estrenos con Carrusel -->
<section class="section premieres-section">
    <div class="container">
        <h2 class="section-title"><span>PRÓXIMOS ESTRENOS</span></h2>
        
        <div class="premieres-carousel">
            <button class="carousel-btn prev" onclick="moverCarousel(-1)">❮</button>
            
            <div class="carousel-container">
                <div class="carousel-track">
                    <!-- Dune: Parte 2 -->
                    <div class="carousel-slide">
                        <div class="premiere-card">
                            <div class="premiere-card-inner">
                                <div class="premiere-front" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('/Public/PIC/Dune.jpeg');">
                                    <div class="premiere-front-content">
                                        <h3>DUNE: PARTE 2</h3>
                                        <p>15 MAR 2026</p>
                                    </div>
                                </div>
                                <div class="premiere-back">
                                    <div class="premiere-back-content">
                                        <h4>DUNE: PARTE 2</h4>
                                        <p>El despertar de Paul</p>
                                        <p>Duración: 166 min</p>
                                        <p>Género: Ciencia Ficción</p>
                                        <button class="btn-neon" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=5'">PRE-VENTA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Avatar 3 -->
                    <div class="carousel-slide">
                        <div class="premiere-card">
                            <div class="premiere-card-inner">
                                <div class="premiere-front" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('/Public/PIC/Avatar3.jpeg');">
                                    <div class="premiere-front-content">
                                        <h3>AVATAR 3</h3>
                                        <p>15 DIC 2026</p>
                                    </div>
                                </div>
                                <div class="premiere-back">
                                    <div class="premiere-back-content">
                                        <h4>AVATAR 3</h4>
                                        <p>El regreso a Pandora</p>
                                        <p>Duración: 162 min</p>
                                        <p>Género: Ciencia Ficción</p>
                                        <button class="btn-neon" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=6'">PRE-VENTA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Avengers: Secret Wars -->
                    <div class="carousel-slide">
                        <div class="premiere-card">
                            <div class="premiere-card-inner">
                                <div class="premiere-front" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('/Public/PIC/avengers%20secret%20wars.jpeg');">
                                    <div class="premiere-front-content">
                                        <h3>AVENGERS: SECRET WARS</h3>
                                        <p>30 ENE 2027</p>
                                    </div>
                                </div>
                                <div class="premiere-back">
                                    <div class="premiere-back-content">
                                        <h4>AVENGERS: SECRET WARS</h4>
                                        <p>La batalla final</p>
                                        <p>Duración: 180 min</p>
                                        <p>Género: Acción</p>
                                        <button class="btn-neon" onclick="window.location.href='/app/views/cliente/reserva.php?pelicula=7'">PRE-VENTA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-btn next" onclick="moverCarousel(1)">❯</button>
            
            <div class="carousel-dots">
                <span class="carousel-dot active" onclick="irASlideCarousel(0)"></span>
                <span class="carousel-dot" onclick="irASlideCarousel(1)"></span>
                <span class="carousel-dot" onclick="irASlideCarousel(2)"></span>
            </div>
        </div>
    </div>
</section>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>© 2060 CINE U XD - TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </footer>

    <script>
    // Hero Slider
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

    setInterval(() => {
        slideIndex++;
        mostrarSlide(slideIndex);
    }, 5000);

    // Carrusel de Próximos Estrenos
    let slideCarouselIndex = 0;
    const carouselTrack = document.querySelector('.carousel-track');
    const carouselSlides = document.querySelectorAll('.carousel-slide');
    const carouselDots = document.querySelectorAll('.carousel-dot');

    function moverCarousel(direccion) {
        slideCarouselIndex += direccion;
        
        if (slideCarouselIndex < 0) {
            slideCarouselIndex = carouselSlides.length - 1;
        } else if (slideCarouselIndex >= carouselSlides.length) {
            slideCarouselIndex = 0;
        }
        
        actualizarCarousel();
    }

    function irASlideCarousel(index) {
        slideCarouselIndex = index;
        actualizarCarousel();
    }

    function actualizarCarousel() {
        if (carouselTrack) {
            const desplazamiento = -slideCarouselIndex * 100;
            carouselTrack.style.transform = `translateX(${desplazamiento}%)`;
        }
        
        carouselDots.forEach((dot, index) => {
            if (index === slideCarouselIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    setInterval(() => {
        moverCarousel(1);
    }, 5000);
    </script>
</body>
</html>