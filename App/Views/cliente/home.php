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
    <title>Inicio - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/cliente.css?v=2">
</head>

<body>

    <header class="main-header">
        <div class="header-container">

            <a href="/public/index.php?route=home" class="logo">
                CINE U XD
            </a>

            <nav class="main-nav">
                <ul>
                    <li><a href="/public/index.php?route=home" class="active">INICIO</a></li>
                    <li><a href="/public/index.php?route=cartelera">CARTELERA</a></li>
                    <li><a href="/public/index.php?route=cines">CINES</a></li>
                    <li><a href="/public/index.php?route=contacto">CONTACTO</a></li>
                    <li><a href="/public/index.php?route=reservas">MIS RESERVAS</a></li>

                    <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] == 1): ?>
                        <li><a href="/public/index.php?route=admin">ADMIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-menu">
                <span class="user-pill"><?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/public/index.php?route=logout" class="btn-logout">
                    CERRAR SESIÓN
                </a>
            </div>

        </div>
    </header>

    <main class="page-container">
        <section class="page-intro">
            <h1>🎬 BIENVENIDO A CINE U XD</h1>
            <p>Disfruta de la cartelera, consulta cines y administra tus reservas.</p>
        </section>

        <section class="cards-grid">
            <div class="mini-card">
                <h2>Cartelera</h2>
                <p>Consulta las películas disponibles actualmente en el sistema.</p>
                <a href="/public/index.php?route=cartelera">Ver cartelera</a>
            </div>

            <div class="mini-card">
                <h2>Cines</h2>
                <p>Revisa los cines registrados y sus ubicaciones disponibles.</p>
                <a href="/public/index.php?route=cines">Ver cines</a>
            </div>

            <div class="mini-card">
                <h2>Mis Reservas</h2>
                <p>Consulta el historial y estado de tus reservas realizadas.</p>
                <a href="/public/index.php?route=reservas">Ver reservas</a>
            </div>
        </section>
<<<<<<< HEAD
<<<<<<< HEAD

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
                                        <div class="premiere-front" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('/public/PIC/Dune.jpeg');">
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
                                        <div class="premiere-front" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('/public/PIC/Avatar3.jpeg');">
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
                                        <div class="premiere-front" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('/public/PIC/avengers%20secret%20wars.jpeg');">
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
=======
>>>>>>> Alejandro
=======
>>>>>>> main
    </main>

</body>
</html>