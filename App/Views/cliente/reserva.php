<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: /app/views/auth/login.php");
    exit;
}
$id_pelicula = isset($_GET['pelicula']) ? $_GET['pelicula'] : 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva - Cine U XD 2060</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <link rel="stylesheet" href="/public/css/reserva.css">
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
            text-decoration: none;
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

        .page-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 42px;
            text-align: center;
            margin-bottom: 50px;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Pasos de reserva */
        .pasos-indicador {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }

        .pasos-indicador::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            transform: translateY(-50%);
            z-index: 1;
            opacity: 0.3;
        }

        .paso-indicador {
            background: var(--dark-bg);
            border: 2px solid rgba(0,243,255,0.3);
            border-radius: 30px;
            padding: 10px 25px;
            position: relative;
            z-index: 2;
            font-weight: bold;
            font-family: 'Orbitron', sans-serif;
            transition: all 0.3s;
        }

        .paso-indicador.active {
            border-color: var(--neon-blue);
            background: rgba(0,243,255,0.1);
            color: var(--neon-blue);
            box-shadow: 0 0 20px rgba(0,243,255,0.3);
            transform: scale(1.05);
        }

        .paso {
            display: none;
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid rgba(0,243,255,0.2);
            backdrop-filter: blur(10px);
        }

        .paso.active {
            display: block;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .paso h2 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            margin-bottom: 30px;
            font-size: 24px;
        }

        /* Selector de películas */
        .peliculas-selector {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .pelicula-selector-item {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            text-align: center;
        }

        .pelicula-selector-item:hover {
            transform: translateY(-5px);
            border-color: var(--neon-blue);
            box-shadow: 0 10px 20px rgba(0,243,255,0.2);
        }

        .pelicula-selector-item.selected {
            border-color: var(--neon-blue);
            background: rgba(0,243,255,0.1);
            box-shadow: 0 0 30px rgba(0,243,255,0.3);
        }

        .pelicula-selector-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .pelicula-selector-item h3 {
            font-size: 16px;
            margin: 0;
        }

        /* Funciones */
        .funciones-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .funcion-card {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 20px;
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
        }

        .funcion-card:hover {
            transform: translateY(-3px);
            border-color: var(--neon-blue);
            box-shadow: 0 10px 20px rgba(0,243,255,0.2);
        }

        .funcion-card.selected {
            border-color: var(--neon-blue);
            background: rgba(0,243,255,0.1);
        }

        .funcion-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .funcion-header .cine {
            font-weight: bold;
            color: var(--neon-blue);
        }

        .funcion-header .sala {
            font-size: 14px;
            color: rgba(255,255,255,0.7);
        }

        .funcion-body {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .funcion-body .fecha {
            font-size: 14px;
        }

        .funcion-body .hora {
            font-size: 24px;
            font-weight: bold;
            color: var(--neon-blue);
        }

        .funcion-body .precio {
            background: rgba(0,243,255,0.2);
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Asientos */
        .sala-info {
            background: rgba(0,243,255,0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            border: 1px solid var(--neon-blue);
        }

        .sala-info p {
            margin: 0;
        }

        .sala-info span {
            color: var(--neon-blue);
            font-weight: bold;
        }

        .pantalla {
            background: linear-gradient(to bottom, var(--neon-blue), var(--neon-purple));
            text-align: center;
            padding: 15px;
            border-radius: 10px 10px 30px 30px;
            margin-bottom: 40px;
            font-weight: bold;
            letter-spacing: 5px;
            font-size: 18px;
            color: #fff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .asientos-container {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 8px;
            margin-bottom: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            background: rgba(255,255,255,0.02);
            padding: 20px;
            border-radius: 10px;
        }

        .asiento {
            aspect-ratio: 1;
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 12px;
            font-weight: bold;
        }

        .asiento:hover:not(.ocupado) {
            background: rgba(0,243,255,0.3);
            transform: scale(1.1);
            border-color: var(--neon-blue);
        }

        .asiento.seleccionado {
            background: var(--neon-blue);
            border-color: var(--neon-blue);
            box-shadow: 0 0 15px var(--neon-blue);
        }

        .asiento.ocupado {
            background: #ff4b4b;
            cursor: not-allowed;
            opacity: 0.5;
        }

        .asientos-leyenda {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }

        .leyenda-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .leyenda-item::before {
            content: '';
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .leyenda-item.disponible::before {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.3);
        }

        .leyenda-item.seleccionado::before {
            background: var(--neon-blue);
        }

        .leyenda-item.ocupado::before {
            background: #ff4b4b;
        }

        /* Resumen */
        .resumen-reserva {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .resumen-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .resumen-item.total {
            border-top: 2px solid var(--neon-blue);
            border-bottom: none;
            margin-top: 10px;
            padding-top: 15px;
            font-size: 20px;
            font-weight: bold;
        }

        .btn-confirmar {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-confirmar:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(0,243,255,0.5);
        }

        .pasos-navegacion {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .btn-secondary {
            padding: 12px 30px;
            background: rgba(255,255,255,0.1);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-secondary:hover:not(:disabled) {
            background: rgba(255,255,255,0.2);
        }

        .btn-secondary:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        /* Estilos para pagos */
        .pago-modal {
            background: rgba(10,10,15,0.95);
            border-radius: 20px;
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }

        .metodos-pago {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .metodo-pago {
            background: rgba(255,255,255,0.05);
            border: 2px solid transparent;
            border-radius: 10px;
            padding: 25px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .metodo-pago:hover {
            border-color: var(--neon-blue);
            transform: translateY(-5px);
        }

        .metodo-pago.selected {
            border-color: var(--neon-blue);
            background: rgba(0,243,255,0.1);
            box-shadow: 0 0 30px rgba(0,243,255,0.3);
        }

        .metodo-pago i {
            font-size: 40px;
            color: var(--neon-blue);
            margin-bottom: 10px;
        }

        .form-pago {
            margin-top: 30px;
        }

        .input-group-pago {
            margin-bottom: 20px;
        }

        .input-group-pago label {
            display: block;
            margin-bottom: 8px;
            color: var(--neon-blue);
            font-weight: bold;
        }

        .input-group-pago input {
            width: 100%;
            padding: 15px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(0,243,255,0.3);
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
        }

        .input-group-pago input:focus {
            outline: none;
            border-color: var(--neon-blue);
            box-shadow: 0 0 20px rgba(0,243,255,0.3);
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-pagar-final {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #28a745, #34ce57);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
        }

        .btn-pagar-final:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(40,167,69,0.5);
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
        <div class="container">
            <h1 class="page-title">🎫 REALIZAR RESERVA</h1>
            
            <div class="pasos-indicador">
                <span class="paso-indicador active" data-paso="1">1. Película</span>
                <span class="paso-indicador" data-paso="2">2. Horario</span>
                <span class="paso-indicador" data-paso="3">3. Asientos</span>
                <span class="paso-indicador" data-paso="4">4. Confirmar</span>
            </div>
            
            <div class="reserva-proceso">
                <!-- Paso 1: Película -->
                <div class="paso active" id="paso1">
                    <h2>Selecciona tu película</h2>
                    <div class="peliculas-selector">
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 1 ? 'selected' : ''; ?>" onclick="seleccionarPelicula(1, 'Spider-Man: No Way Home', '/public/PIC/spiderman.jpg')">
                            <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                            <h3>Spider-Man: No Way Home</h3>
                        </div>
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 2 ? 'selected' : ''; ?>" onclick="seleccionarPelicula(2, 'Dragon Ball Super', '/public/PIC/dbz.jpg')">
                            <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                            <h3>Dragon Ball Super</h3>
                        </div>
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 3 ? 'selected' : ''; ?>" onclick="seleccionarPelicula(3, 'Interstellar', '/public/PIC/inter.jpg')">
                            <img src="/public/PIC/inter.jpg" alt="Interstellar">
                            <h3>Interstellar</h3>
                        </div>
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 4 ? 'selected' : ''; ?>" onclick="seleccionarPelicula(4, 'CR7: El Mundo a sus Pies', '/public/PIC/CR7.jpg')">
                            <img src="/public/PIC/CR7.jpg" alt="CR7">
                            <h3>CR7: El Mundo a sus Pies</h3>
                        </div>
                    </div>
                </div>

                <!-- Paso 2: Horario -->
                <div class="paso" id="paso2">
                    <h2>Elige horario y cine</h2>
                    <div class="funciones-grid">
                        <div class="funcion-card" onclick="seleccionarFuncion(1, 'Cine U XD San José', 'Sala 1 - IMAX', '14:30', '15/03/2026', 4500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD San José</span>
                                <span class="sala">Sala 1 - IMAX</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">14:30</span>
                                <span class="precio">₡4,500</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(2, 'Cine U XD San José', 'Sala 1 - IMAX', '17:00', '15/03/2026', 4500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD San José</span>
                                <span class="sala">Sala 1 - IMAX</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">17:00</span>
                                <span class="precio">₡4,500</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(3, 'Cine U XD San José', 'Sala 1 - IMAX', '19:30', '15/03/2026', 4500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD San José</span>
                                <span class="sala">Sala 1 - IMAX</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">19:30</span>
                                <span class="precio">₡4,500</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(4, 'Cine U XD San José', 'Sala 1 - IMAX', '22:00', '15/03/2026', 4500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD San José</span>
                                <span class="sala">Sala 1 - IMAX</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">22:00</span>
                                <span class="precio">₡4,500</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(5, 'Cine U XD Escazú', 'Sala 2 - 3D', '15:00', '15/03/2026', 4000)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Escazú</span>
                                <span class="sala">Sala 2 - 3D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">15:00</span>
                                <span class="precio">₡4,000</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(6, 'Cine U XD Escazú', 'Sala 2 - 3D', '18:00', '15/03/2026', 4000)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Escazú</span>
                                <span class="sala">Sala 2 - 3D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">18:00</span>
                                <span class="precio">₡4,000</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(7, 'Cine U XD Heredia', 'Sala 3 - 2D', '16:30', '15/03/2026', 3500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Heredia</span>
                                <span class="sala">Sala 3 - 2D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">16:30</span>
                                <span class="precio">₡3,500</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(8, 'Cine U XD Heredia', 'Sala 3 - 2D', '19:30', '15/03/2026', 3500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Heredia</span>
                                <span class="sala">Sala 3 - 2D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">19:30</span>
                                <span class="precio">₡3,500</span>
                            </div>
                        </div>
                        <div class="funcion-card" onclick="seleccionarFuncion(9, 'Cine U XD Heredia', 'Sala 3 - 2D', '22:00', '15/03/2026', 3500)">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Heredia</span>
                                <span class="sala">Sala 3 - 2D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">22:00</span>
                                <span class="precio">₡3,500</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paso 3: Asientos -->
                <div class="paso" id="paso3">
                    <h2>Selecciona tus asientos</h2>
                    <div class="sala-info" id="sala-info">
                        <p><strong>Cine:</strong> <span id="cine-seleccionado">-</span></p>
                        <p><strong>Sala:</strong> <span id="sala-seleccionada">-</span></p>
                        <p><strong>Horario:</strong> <span id="horario-seleccionado">-</span></p>
                        <p><strong>Fecha:</strong> <span id="fecha-seleccionada">-</span></p>
                    </div>
                    
                    <div class="pantalla">PANTALLA</div>
                    
                    <div class="asientos-container" id="asientos-container">
                        <?php
                        $filas = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                        $numeros = range(1, 10);
                        
                        foreach($filas as $fila):
                            foreach($numeros as $num):
                                $asientoId = $fila . $num;
                                $ocupado = (($fila == 'C' && $num == 5) || ($fila == 'D' && $num == 3) || ($fila == 'F' && $num == 8)) ? 'ocupado' : '';
                        ?>
                        <div class="asiento <?php echo $ocupado; ?>" 
                             data-asiento="<?php echo $asientoId; ?>"
                             onclick="seleccionarAsiento(this)">
                            <?php echo $asientoId; ?>
                        </div>
                        <?php 
                            endforeach;
                        endforeach; 
                        ?>
                    </div>
                    
                    <div class="asientos-leyenda">
                        <span class="leyenda-item disponible">Disponible</span>
                        <span class="leyenda-item seleccionado">Seleccionado</span>
                        <span class="leyenda-item ocupado">Ocupado</span>
                    </div>
                </div>

                <!-- Paso 4: Confirmar y Pagar -->
                <div class="paso" id="paso4">
                    <h2>Confirma tu reserva y paga</h2>
                    <div class="resumen-reserva" id="resumen-reserva"></div>
                    
                    <div id="pago-seccion" style="margin-top: 30px;">
                        <h3 style="color: var(--neon-blue); margin-bottom: 20px;">SELECCIONA MÉTODO DE PAGO</h3>
                        
                        <div class="metodos-pago">
                            <div class="metodo-pago" onclick="seleccionarMetodo('tarjeta')">
                                <i class="fas fa-credit-card"></i>
                                <span>Tarjeta</span>
                            </div>
                            <div class="metodo-pago" onclick="seleccionarMetodo('sinpe')">
                                <i class="fas fa-mobile-alt"></i>
                                <span>SINPE Móvil</span>
                            </div>
                            <div class="metodo-pago" onclick="seleccionarMetodo('efectivo')">
                                <i class="fas fa-money-bill"></i>
                                <span>Efectivo</span>
                            </div>
                        </div>

                        <div id="form-tarjeta" class="form-pago" style="display: none;">
                            <div class="input-group-pago">
                                <label>Número de Tarjeta</label>
                                <input type="text" placeholder="1234 5678 9012 3456" maxlength="19" id="tarjeta-numero">
                            </div>
                            <div class="row">
                                <div class="input-group-pago">
                                    <label>Vencimiento</label>
                                    <input type="text" placeholder="MM/AA" id="tarjeta-vencimiento">
                                </div>
                                <div class="input-group-pago">
                                    <label>CVV</label>
                                    <input type="text" placeholder="123" maxlength="3" id="tarjeta-cvv">
                                </div>
                            </div>
                            <div class="input-group-pago">
                                <label>Nombre en la Tarjeta</label>
                                <input type="text" placeholder="Como aparece en la tarjeta" id="tarjeta-nombre">
                            </div>
                        </div>

                        <div id="form-sinpe" class="form-pago" style="display: none;">
                            <div class="input-group-pago">
                                <label>Teléfono SINPE</label>
                                <input type="text" placeholder="8888-8888" id="sinpe-telefono">
                            </div>
                            <div class="input-group-pago">
                                <label>Banco</label>
                                <select style="width:100%; padding:15px; background:rgba(255,255,255,0.05); border:1px solid rgba(0,243,255,0.3); border-radius:10px; color:#fff;">
                                    <option value="bn">Banco Nacional</option>
                                    <option value="bcr">BCR</option>
                                    <option value="bpd">Banco Popular</option>
                                    <option value="bac">BAC</option>
                                </select>
                            </div>
                        </div>

                        <div id="form-efectivo" class="form-pago" style="display: none;">
                            <p style="color: #fff; text-align: center; padding: 20px;">
                                💰 Pagarás en efectivo en taquilla el día de la función
                            </p>
                        </div>

                        <button class="btn-pagar-final" onclick="procesarPago()">
                            PAGAR AHORA
                        </button>
                    </div>
                </div>
            </div>

            <div class="pasos-navegacion">
                <button class="btn-secondary" id="btn-anterior" onclick="cambiarPaso(-1)" disabled>ANTERIOR</button>
                <button class="btn-primary" id="btn-siguiente" onclick="cambiarPaso(1)">SIGUIENTE</button>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>© 2060 CINE U XD - TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </footer>

    <script>
    let pasoActual = 1;
    let metodoPagoSeleccionado = '';
    let datosReserva = {
        peliculaId: <?php echo $id_pelicula; ?>,
        peliculaNombre: '',
        peliculaImagen: '',
        funcionId: null,
        cine: '',
        sala: '',
        horario: '',
        fecha: '',
        precio: 0,
        asientos: []
    };

    // Inicializar nombre de película
    document.addEventListener('DOMContentLoaded', function() {
        actualizarNombrePelicula();
        actualizarIndicadorPasos();
    });

    function actualizarNombrePelicula() {
        const selected = document.querySelector('.pelicula-selector-item.selected');
        if (selected) {
            datosReserva.peliculaNombre = selected.querySelector('h3').textContent;
            datosReserva.peliculaImagen = selected.querySelector('img').src;
        }
    }

    function actualizarIndicadorPasos() {
        document.querySelectorAll('.paso-indicador').forEach((el, index) => {
            if (index + 1 === pasoActual) {
                el.classList.add('active');
            } else {
                el.classList.remove('active');
            }
        });
    }

    function cambiarPaso(direccion) {
        let nuevoPaso = pasoActual + direccion;
        if (nuevoPaso < 1 || nuevoPaso > 4) return;
        
        if (direccion > 0 && !validarPasoActual()) return;
        
        document.querySelectorAll('.paso').forEach(p => p.classList.remove('active'));
        document.getElementById(`paso${nuevoPaso}`).classList.add('active');
        
        pasoActual = nuevoPaso;
        document.getElementById('btn-anterior').disabled = pasoActual === 1;
        actualizarIndicadorPasos();
        
        if (pasoActual === 4) {
            document.getElementById('btn-siguiente').style.display = 'none';
            actualizarResumen();
        } else {
            document.getElementById('btn-siguiente').style.display = 'block';
            document.getElementById('btn-siguiente').textContent = pasoActual === 3 ? 'VER RESUMEN' : 'SIGUIENTE';
        }
    }

    function validarPasoActual() {
        switch(pasoActual) {
            case 1:
                if (!datosReserva.peliculaId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona una película',
                        background: '#0a0a0f',
                        color: '#fff',
                        confirmButtonColor: '#00f3ff'
                    });
                    return false;
                }
                break;
            case 2:
                if (!datosReserva.funcionId) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona un horario',
                        background: '#0a0a0f',
                        color: '#fff',
                        confirmButtonColor: '#00f3ff'
                    });
                    return false;
                }
                break;
            case 3:
                if (datosReserva.asientos.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona al menos un asiento',
                        background: '#0a0a0f',
                        color: '#fff',
                        confirmButtonColor: '#00f3ff'
                    });
                    return false;
                }
                break;
        }
        return true;
    }

    function seleccionarPelicula(id, nombre, imagen) {
        datosReserva.peliculaId = id;
        datosReserva.peliculaNombre = nombre;
        datosReserva.peliculaImagen = imagen;
        
        document.querySelectorAll('.pelicula-selector-item').forEach(item => {
            item.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
    }

    function seleccionarFuncion(id, cine, sala, horario, fecha, precio) {
        datosReserva.funcionId = id;
        datosReserva.cine = cine;
        datosReserva.sala = sala;
        datosReserva.horario = horario;
        datosReserva.fecha = fecha;
        datosReserva.precio = precio;
        
        document.querySelectorAll('.funcion-card').forEach(item => {
            item.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        document.getElementById('cine-seleccionado').textContent = cine;
        document.getElementById('sala-seleccionada').textContent = sala;
        document.getElementById('horario-seleccionado').textContent = horario;
        document.getElementById('fecha-seleccionada').textContent = fecha;
    }

    function seleccionarAsiento(elemento) {
        if (elemento.classList.contains('ocupado')) return;
        
        if (elemento.classList.contains('seleccionado')) {
            elemento.classList.remove('seleccionado');
            datosReserva.asientos = datosReserva.asientos.filter(a => a !== elemento.dataset.asiento);
        } else {
            elemento.classList.add('seleccionado');
            datosReserva.asientos.push(elemento.dataset.asiento);
        }
    }

    function actualizarResumen() {
        const total = datosReserva.asientos.length * datosReserva.precio;
        
        document.getElementById('resumen-reserva').innerHTML = `
            <div class="resumen-item">
                <span>Película:</span>
                <span>${datosReserva.peliculaNombre}</span>
            </div>
            <div class="resumen-item">
                <span>Cine:</span>
                <span>${datosReserva.cine}</span>
            </div>
            <div class="resumen-item">
                <span>Sala:</span>
                <span>${datosReserva.sala}</span>
            </div>
            <div class="resumen-item">
                <span>Fecha:</span>
                <span>${datosReserva.fecha}</span>
            </div>
            <div class="resumen-item">
                <span>Horario:</span>
                <span>${datosReserva.horario}</span>
            </div>
            <div class="resumen-item">
                <span>Asientos:</span>
                <span>${datosReserva.asientos.sort().join(', ')}</span>
            </div>
            <div class="resumen-item total">
                <span>TOTAL A PAGAR:</span>
                <span>₡${total.toLocaleString()}</span>
            </div>
        `;
    }

    function seleccionarMetodo(metodo) {
        document.querySelectorAll('.metodo-pago').forEach(m => m.classList.remove('selected'));
        event.currentTarget.classList.add('selected');
        metodoPagoSeleccionado = metodo;
        
        document.querySelectorAll('.form-pago').forEach(f => f.style.display = 'none');
        document.getElementById(`form-${metodo}`).style.display = 'block';
    }

    function procesarPago() {
        if (!metodoPagoSeleccionado) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Selecciona un método de pago',
                background: '#0a0a0f',
                color: '#fff',
                confirmButtonColor: '#00f3ff'
            });
            return;
        }

        const total = datosReserva.asientos.length * datosReserva.precio;
        const codigoReserva = 'CINE-' + Math.floor(Math.random() * 10000) + '-' + Date.now().toString().slice(-4);
        
        // Crear objeto de reserva
        const nuevaReserva = {
            codigo: codigoReserva,
            pelicula: datosReserva.peliculaNombre,
            imagen: datosReserva.peliculaImagen,
            cine: datosReserva.cine,
            sala: datosReserva.sala,
            horario: datosReserva.horario,
            fecha: datosReserva.fecha,
            asientos: datosReserva.asientos.sort().join(', '),
            cantidad: datosReserva.asientos.length,
            precio: datosReserva.precio,
            total: total,
            metodoPago: metodoPagoSeleccionado,
            fechaReserva: new Date().toLocaleDateString('es-ES'),
            estado: 'activa'
        };
        
        // Guardar en sessionStorage
        if (!sessionStorage.getItem('reservas')) {
            sessionStorage.setItem('reservas', JSON.stringify([]));
        }
        
        let reservas = JSON.parse(sessionStorage.getItem('reservas'));
        reservas.push(nuevaReserva);
        sessionStorage.setItem('reservas', JSON.stringify(reservas));
        
        // Mostrar mensaje de éxito
        Swal.fire({
            icon: 'success',
            title: '🎉 ¡PAGO EXITOSO!',
            html: `
                <div style="text-align: left; padding: 15px;">
                    <p style="color: #00f3ff; font-size: 18px; margin-bottom: 15px;">✅ Reserva confirmada</p>
                    <p><strong>Código:</strong> ${codigoReserva}</p>
                    <p><strong>Película:</strong> ${datosReserva.peliculaNombre}</p>
                    <p><strong>Cine:</strong> ${datosReserva.cine}</p>
                    <p><strong>Sala:</strong> ${datosReserva.sala}</p>
                    <p><strong>Fecha:</strong> ${datosReserva.fecha}</p>
                    <p><strong>Horario:</strong> ${datosReserva.horario}</p>
                    <p><strong>Asientos:</strong> ${datosReserva.asientos.sort().join(', ')}</p>
                    <p><strong>Total pagado:</strong> ₡${total.toLocaleString()}</p>
                    <p><strong>Método de pago:</strong> ${metodoPagoSeleccionado.toUpperCase()}</p>
                </div>
            `,
            background: '#0a0a0f',
            color: '#fff',
            confirmButtonColor: '#00f3ff',
            confirmButtonText: 'VER MIS RESERVAS'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/app/views/cliente/mis-reservas.php';
            }
        });
    }
    </script>
</body>
</html>