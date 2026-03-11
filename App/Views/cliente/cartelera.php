<?php
session_start();
if (!isset($_SESSION['usuario'])) {
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
    <link rel="stylesheet" href="/public/css/cartelera.css">
</head>

<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">
                CINE U XD <span class="logo-year">2060</span>
            </a>

            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php">INICIO</a></li>
                    <li><a href="/app/views/cliente/cartelera.php" class="active">CARTELERA</a></li>
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

    <main class="cartelera-main">
        <div class="container">
            <h1 class="page-title">CARTELERA</h1>
            <p class="page-subtitle">Descubre las películas disponibles y reserva tu función favorita.</p>

            <section class="filtros-container">
                <div class="filtro">
                    <label for="genero">GÉNERO</label>
                    <select class="filtro-select" id="genero">
                        <option value="todos">Todos</option>
                        <option value="accion">Acción</option>
                        <option value="comedia">Comedia</option>
                        <option value="drama">Drama</option>
                        <option value="ciencia-ficcion">Ciencia Ficción</option>
                        <option value="animacion">Animación</option>
                        <option value="documental">Documental</option>
                    </select>
                </div>

                <div class="filtro">
                    <label for="formato">FORMATO</label>
                    <select class="filtro-select" id="formato">
                        <option value="todos">Todos</option>
                        <option value="2d">2D</option>
                        <option value="3d">3D</option>
                        <option value="imax">IMAX</option>
                        <option value="4dx">4DX</option>
                    </select>
                </div>
            </section>

            <section class="cartelera-completa">

                <article class="pelicula-detalle" data-genero="accion" data-formato="2d">
                    <img src="/public/PIC/spiderman.jpg" alt="Spider-Man: No Way Home">
                    <div class="detalle-info">
                        <h2>Spider-Man: No Way Home</h2>

                        <div class="detalle-meta">
                            <span>14+</span>
                            <span>148 min</span>
                            <span>Acción / Aventura</span>
                            <span>2D</span>
                        </div>

                        <p class="sinopsis">
                            Por primera vez en la historia cinematográfica de Spider-Man, nuestro héroe es desenmascarado
                            y ya no puede separar su vida normal de los grandes riesgos que conlleva ser un superhéroe.
                        </p>

                        <div class="detalle-horarios">
                            <h3>Horarios disponibles</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=14:30" class="horario-btn">14:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=17:00" class="horario-btn">17:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=19:30" class="horario-btn">19:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=1&horario=22:00" class="horario-btn">22:00</a>
                            </div>
                        </div>

                        <div class="detalle-acciones">
                            <a href="/app/views/cliente/reserva.php?pelicula=1" class="btn-reservar">RESERVAR AHORA</a>
                        </div>
                    </div>
                </article>

                <article class="pelicula-detalle" data-genero="animacion" data-formato="2d">
                    <img src="/public/PIC/dbz.jpg" alt="Dragon Ball Super: Super Hero">
                    <div class="detalle-info">
                        <h2>Dragon Ball Super: Super Hero</h2>

                        <div class="detalle-meta">
                            <span>7+</span>
                            <span>100 min</span>
                            <span>Animación</span>
                            <span>2D</span>
                        </div>

                        <p class="sinopsis">
                            La Patrulla Roja ha sido revivida por dos personas que heredaron el genio de su abuelo.
                            Han creado nuevos androides y han atacado a Piccolo y Gohan.
                        </p>

                        <div class="detalle-horarios">
                            <h3>Horarios disponibles</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=2&horario=15:00" class="horario-btn">15:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=2&horario=17:30" class="horario-btn">17:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=2&horario=20:00" class="horario-btn">20:00</a>
                            </div>
                        </div>

                        <div class="detalle-acciones">
                            <a href="/app/views/cliente/reserva.php?pelicula=2" class="btn-reservar">RESERVAR AHORA</a>
                        </div>
                    </div>
                </article>

                <article class="pelicula-detalle" data-genero="ciencia-ficcion" data-formato="imax">
                    <img src="/public/PIC/inter.jpg" alt="Interstellar">
                    <div class="detalle-info">
                        <h2>Interstellar</h2>

                        <div class="detalle-meta">
                            <span>12+</span>
                            <span>169 min</span>
                            <span>Ciencia Ficción</span>
                            <span>IMAX</span>
                        </div>

                        <p class="sinopsis">
                            Un grupo de exploradores viaja a través de un agujero de gusano en el espacio
                            en un intento por asegurar la supervivencia de la humanidad.
                        </p>

                        <div class="detalle-horarios">
                            <h3>Horarios disponibles</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=3&horario=16:00" class="horario-btn">16:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=3&horario=19:00" class="horario-btn">19:00</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=3&horario=22:30" class="horario-btn">22:30</a>
                            </div>
                        </div>

                        <div class="detalle-acciones">
                            <a href="/app/views/cliente/reserva.php?pelicula=3" class="btn-reservar">RESERVAR AHORA</a>
                        </div>
                    </div>
                </article>

                <article class="pelicula-detalle" data-genero="documental" data-formato="2d">
                    <img src="/public/PIC/CR7.jpg" alt="CR7: El Mundo a sus Pies">
                    <div class="detalle-info">
                        <h2>CR7: El Mundo a sus Pies</h2>

                        <div class="detalle-meta">
                            <span>7+</span>
                            <span>92 min</span>
                            <span>Documental</span>
                            <span>2D</span>
                        </div>

                        <p class="sinopsis">
                            Documental que sigue la vida y carrera de Cristiano Ronaldo, desde sus humildes comienzos
                            hasta convertirse en una de las mayores estrellas del fútbol mundial.
                        </p>

                        <div class="detalle-horarios">
                            <h3>Horarios disponibles</h3>
                            <div class="horarios-buttons">
                                <a href="/app/views/cliente/reserva.php?pelicula=4&horario=18:30" class="horario-btn">18:30</a>
                                <a href="/app/views/cliente/reserva.php?pelicula=4&horario=21:00" class="horario-btn">21:00</a>
                            </div>
                        </div>

                        <div class="detalle-acciones">
                            <a href="/app/views/cliente/reserva.php?pelicula=4" class="btn-reservar">RESERVAR AHORA</a>
                        </div>
                    </div>
                </article>

            </section>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>© 2060 CINE U XD - TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </footer>


</body>

</html>