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
    <title>Cartelera - Cine U XD 2060</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap');
        
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9d00ff;
            --neon-pink: #ff00c8;
            --dark-bg: #0a0a0f;
        }

        body {
            background: var(--dark-bg);
            font-family: 'Rajdhani', sans-serif;
            margin: 0;
            color: #fff;
        }

        .main-header {
            background: rgba(10,10,15,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid var(--neon-blue);
            box-shadow: 0 0 20px rgba(0,243,255,0.3);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 32px;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
            padding: 10px 0;
        }

        .main-nav a:hover,
        .main-nav a.active {
            color: var(--neon-blue);
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
        }

        .btn-logout {
            background: transparent;
            border: 1px solid var(--neon-pink);
            color: var(--neon-pink);
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
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

        .page-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 48px;
            text-align: center;
            margin: 40px 0 10px;
            color: #fff;
            text-shadow: 0 0 20px rgba(0,243,255,0.5);
        }

        .page-subtitle {
            text-align: center;
            color: rgba(255,255,255,0.7);
            font-size: 18px;
            margin-bottom: 40px;
        }

        /* FILTROS */
        .filtros-container {
            background: rgba(255,255,255,0.05);
            border: 2px solid var(--neon-blue);
            border-radius: 15px;
            padding: 25px 30px;
            margin-bottom: 40px;
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            box-shadow: 0 0 30px rgba(0,243,255,0.2);
        }

        .filtro {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1 1 280px;
        }

        .filtro label {
            color: var(--neon-blue);
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            min-width: 100px;
        }

        .filtro-select {
            width: 100%;
            padding: 12px 20px;
            background: rgba(0,0,0,0.5);
            border: 2px solid var(--neon-blue);
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        /* PELÍCULA DETALLE */
        .pelicula-detalle {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 40px;
            background: rgba(255,255,255,0.03);
            border: 2px solid rgba(0,243,255,0.3);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            transition: all 0.3s;
        }

        .pelicula-detalle:hover {
            border-color: var(--neon-blue);
            box-shadow: 0 0 40px rgba(0,243,255,0.2);
        }

        .pelicula-detalle img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 15px;
            border: 2px solid var(--neon-blue);
        }

        .detalle-info h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 32px;
            margin-bottom: 15px;
            color: #fff;
        }

        .detalle-meta {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 20px 0;
        }

        .detalle-meta span {
            background: rgba(0,243,255,0.1);
            border: 1px solid var(--neon-blue);
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 14px;
            color: #fff;
        }

        .sinopsis {
            line-height: 1.8;
            margin: 20px 0;
            color: rgba(255,255,255,0.8);
        }

        /* BOTONES DE HORARIOS - ESTILO 2060 */
        .detalle-horarios h3 {
            color: var(--neon-blue);
            font-size: 20px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .horarios-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 15px 0;
        }

        .horario-btn {
            background: transparent;
            border: 2px solid var(--neon-blue);
            color: #fff;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            transition: all 0.3s;
            text-transform: uppercase;
            box-shadow: 0 0 10px rgba(0,243,255,0.3);
        }

        .horario-btn:hover {
            background: var(--neon-blue);
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(0,243,255,0.6);
        }

        .btn-reserva-rapida {
            display: inline-block;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            color: #000;
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
            transition: all 0.3s;
            border: none;
            text-transform: uppercase;
        }

        .btn-reserva-rapida:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(0,243,255,0.6);
        }

        /* FOOTER */
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

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .pelicula-detalle {
                grid-template-columns: 1fr;
            }
            
            .header-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .main-nav ul {
                gap: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .filtros-container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">CINE U XD <span class="logo-year">2060</span></a>
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

    <main>
        <div class="container">
            <h1 class="page-title">CARTELERA</h1>
            <p class="page-subtitle">Descubre las películas disponibles y reserva tu función favorita.</p>
            
            <div class="filtros-container">
                <div class="filtro">
                    <label>GÉNERO</label>
                    <select class="filtro-select">
                        <option>Todos</option>
                        <option>Acción</option>
                        <option>Ciencia Ficción</option>
                        <option>Animación</option>
                    </select>
                </div>
                <div class="filtro">
                    <label>FORMATO</label>
                    <select class="filtro-select">
                        <option>Todos</option>
                        <option>2D</option>
                        <option>3D</option>
                        <option>IMAX</option>
                    </select>
                </div>
            </div>

            <!-- Spider-Man -->
            <div class="pelicula-detalle">
                <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                <div class="detalle-info">
                    <h2>Spider-Man: No Way Home</h2>
                    <div class="detalle-meta">
                        <span>14+</span>
                        <span>148 min</span>
                        <span>Acción/Aventura</span>
                    </div>
                    <p class="sinopsis">Por primera vez en la historia cinematográfica de Spider-Man, nuestro héroe es desenmascarado y ya no puede separar su vida normal de los grandes riesgos que conlleva ser un superhéroe.</p>
                    <div class="detalle-horarios">
                        <h3>Horarios disponibles</h3>
                        <div class="horarios-buttons">
                            <a href="#" class="horario-btn">14:30</a>
                            <a href="#" class="horario-btn">17:00</a>
                            <a href="#" class="horario-btn">19:30</a>
                            <a href="#" class="horario-btn">22:00</a>
                        </div>
                        <a href="#" class="btn-reserva-rapida">RESERVA AHORA</a>
                    </div>
                </div>
            </div>

            <!-- Dragon Ball -->
            <div class="pelicula-detalle">
                <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                <div class="detalle-info">
                    <h2>Dragon Ball Super: Super Hero</h2>
                    <div class="detalle-meta">
                        <span>7+</span>
                        <span>100 min</span>
                        <span>Animación</span>
                    </div>
                    <p class="sinopsis">La Patrulla Roja ha sido revivida por dos personas que heredaron el genio de su abuelo. Han creado nuevos androides y han atacado a Piccolo y Gohan.</p>
                    <div class="detalle-horarios">
                        <h3>Horarios disponibles</h3>
                        <div class="horarios-buttons">
                            <a href="#" class="horario-btn">15:00</a>
                            <a href="#" class="horario-btn">17:30</a>
                            <a href="#" class="horario-btn">20:00</a>
                        </div>
                        <a href="#" class="btn-reserva-rapida">RESERVA AHORA</a>
                    </div>
                </div>
            </div>

            <!-- Interstellar -->
            <div class="pelicula-detalle">
                <img src="/public/PIC/inter.jpg" alt="Interstellar">
                <div class="detalle-info">
                    <h2>Interstellar</h2>
                    <div class="detalle-meta">
                        <span>12+</span>
                        <span>169 min</span>
                        <span>Ciencia Ficción</span>
                    </div>
                    <p class="sinopsis">Un grupo de exploradores viaja a través de un agujero de gusano en el espacio en un intento por asegurar la supervivencia de la humanidad.</p>
                    <div class="detalle-horarios">
                        <h3>Horarios disponibles</h3>
                        <div class="horarios-buttons">
                            <a href="#" class="horario-btn">16:00</a>
                            <a href="#" class="horario-btn">19:00</a>
                            <a href="#" class="horario-btn">22:30</a>
                        </div>
                        <a href="#" class="btn-reserva-rapida">RESERVA AHORA</a>
                    </div>
                </div>
            </div>

            <!-- CR7 -->
            <div class="pelicula-detalle">
                <img src="/public/PIC/CR7.jpg" alt="CR7">
                <div class="detalle-info">
                    <h2>CR7: El Mundo a sus Pies</h2>
                    <div class="detalle-meta">
                        <span>7+</span>
                        <span>92 min</span>
                        <span>Documental</span>
                    </div>
                    <p class="sinopsis">Documental que sigue la vida y carrera de Cristiano Ronaldo, desde sus humildes comienzos hasta convertirse en una de las mayores estrellas del fútbol mundial.</p>
                    <div class="detalle-horarios">
                        <h3>Horarios disponibles</h3>
                        <div class="horarios-buttons">
                            <a href="#" class="horario-btn">18:30</a>
                            <a href="#" class="horario-btn">21:00</a>
                        </div>
                        <a href="#" class="btn-reserva-rapida">RESERVA AHORA</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>© 2060 CINE U XD - TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </footer>
</body>
</html>