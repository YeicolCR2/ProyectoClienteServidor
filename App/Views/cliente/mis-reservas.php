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
    <title>Mis Reservas - Cine U XD 2060</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        
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
            background: rgba(0,243,255,0.1);
            border: 1px solid var(--neon-blue);
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

        .reservas-grid {
            display: grid;
            gap: 30px;
            margin: 40px 0;
        }

        .reserva-card {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 30px;
            background: rgba(255,255,255,0.05);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(0,243,255,0.2);
            transition: all 0.3s;
        }

        .reserva-card:hover {
            border-color: var(--neon-blue);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,243,255,0.2);
        }

        .reserva-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .reserva-info h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: var(--neon-blue);
        }

        .reserva-info p {
            margin: 8px 0;
            color: rgba(255,255,255,0.8);
            font-size: 16px;
        }

        .reserva-info strong {
            color: var(--neon-blue);
        }

        .badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 10px;
        }

        .badge.activa {
            background: #28a745;
            color: #fff;
        }

        .badge.completada {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        .btn-cancelar {
            background: #ff4b4b;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 15px;
            transition: all 0.3s;
        }

        .btn-cancelar:hover {
            background: #ff3333;
            transform: scale(1.05);
        }

        .sin-reservas {
            text-align: center;
            padding: 80px 40px;
            background: rgba(255,255,255,0.05);
            border-radius: 20px;
            border: 1px solid rgba(0,243,255,0.2);
        }

        .sin-reservas h2 {
            font-size: 28px;
            margin-bottom: 15px;
            color: var(--neon-blue);
        }

        .sin-reservas p {
            color: rgba(255,255,255,0.7);
            margin-bottom: 25px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(0,243,255,0.5);
        }

        .codigo-reserva {
            color: var(--neon-blue);
            font-family: 'Orbitron', sans-serif;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">CINE U XD 2060</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php">INICIO</a></li>
                    <li><a href="/app/views/cliente/cartelera.php">CARTELERA</a></li>
                    <li><a href="/app/views/cliente/cines.php">CINES</a></li>
                    <li><a href="/app/views/cliente/contacto.php">CONTACTO</a></li>
                    <li><a href="/app/views/cliente/mis-reservas.php" class="active">MIS RESERVAS</a></li>
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
            <h1 class="page-title">🎟️ MIS RESERVAS</h1>
            
            <?php
            // Obtener reservas de sessionStorage (se pasa mediante JavaScript)
            ?>
            
            <div id="reservas-container">
                <div class="sin-reservas" id="sin-reservas" style="display: none;">
                    <h2>No tienes reservas activas</h2>
                    <p>¡Explora nuestra cartelera y reserva tu próxima experiencia cinematográfica!</p>
                    <a href="/app/views/cliente/cartelera.php" class="btn-primary">VER CARTELERA</a>
                </div>
                
                <div id="reservas-lista" style="display: none;"></div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>© 2060 CINE U XD - TODOS LOS DERECHOS RESERVADOS</p>
        </div>
    </footer>

    <script>
    function cargarReservas() {
        const reservasContainer = document.getElementById('reservas-lista');
        const sinReservas = document.getElementById('sin-reservas');
        
        // Obtener reservas de sessionStorage
        const reservas = JSON.parse(sessionStorage.getItem('reservas') || '[]');
        
        if (reservas.length === 0) {
            sinReservas.style.display = 'block';
            reservasContainer.style.display = 'none';
            return;
        }
        
        sinReservas.style.display = 'none';
        reservasContainer.style.display = 'block';
        
        // Separar reservas activas y completadas (simulado)
        const activas = reservas.filter(r => r.estado === 'activa');
        const completadas = reservas.filter(r => r.estado === 'completada');
        
        let html = '';
        
        if (activas.length > 0) {
            html += '<h2 style="margin-top: 0;">Reservas Activas</h2>';
            html += '<div class="reservas-grid">';
            
            activas.forEach(reserva => {
                html += `
                    <div class="reserva-card" data-codigo="${reserva.codigo}">
                        <img src="${reserva.imagen}" alt="${reserva.pelicula}">
                        <div class="reserva-info">
                            <h3>${reserva.pelicula}</h3>
                            <p><strong>Fecha:</strong> ${reserva.fecha}</p>
                            <p><strong>Horario:</strong> ${reserva.horario}</p>
                            <p><strong>Cine:</strong> ${reserva.cine}</p>
                            <p><strong>Sala:</strong> ${reserva.sala}</p>
                            <p><strong>Asientos:</strong> ${reserva.asientos}</p>
                            <p><strong>Total pagado:</strong> ₡${reserva.total.toLocaleString()}</p>
                            <div class="codigo-reserva">Código: ${reserva.codigo}</div>
                            <span class="badge activa">Activa</span>
                            <button class="btn-cancelar" onclick="cancelarReserva('${reserva.codigo}')">Cancelar</button>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
        }
        
        if (completadas.length > 0) {
            html += '<h2 style="margin-top: 40px;">Historial</h2>';
            html += '<div class="reservas-grid">';
            
            completadas.forEach(reserva => {
                html += `
                    <div class="reserva-card">
                        <img src="${reserva.imagen}" alt="${reserva.pelicula}">
                        <div class="reserva-info">
                            <h3>${reserva.pelicula}</h3>
                            <p><strong>Fecha:</strong> ${reserva.fecha}</p>
                            <p><strong>Horario:</strong> ${reserva.horario}</p>
                            <p><strong>Cine:</strong> ${reserva.cine}</p>
                            <p><strong>Asientos:</strong> ${reserva.asientos}</p>
                            <p><strong>Total:</strong> ₡${reserva.total.toLocaleString()}</p>
                            <div class="codigo-reserva">Código: ${reserva.codigo}</div>
                            <span class="badge completada">Completada</span>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
        }
        
        reservasContainer.innerHTML = html;
    }

    function cancelarReserva(codigo) {
        Swal.fire({
            title: '¿Cancelar reserva?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            background: '#0a0a0f',
            color: '#fff',
            showCancelButton: true,
            confirmButtonColor: '#ff4b4b',
            cancelButtonColor: '#00f3ff',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, mantener'
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener reservas
                let reservas = JSON.parse(sessionStorage.getItem('reservas') || '[]');
                
                // Marcar como completada en lugar de eliminar (para historial)
                reservas = reservas.map(r => {
                    if (r.codigo === codigo) {
                        return { ...r, estado: 'completada' };
                    }
                    return r;
                });
                
                sessionStorage.setItem('reservas', JSON.stringify(reservas));
                
                Swal.fire({
                    icon: 'success',
                    title: 'Reserva cancelada',
                    text: 'Tu reserva ha sido cancelada exitosamente',
                    background: '#0a0a0f',
                    color: '#fff',
                    confirmButtonColor: '#00f3ff'
                }).then(() => {
                    cargarReservas();
                });
            }
        });
    }

    // Cargar reservas al iniciar la página
    document.addEventListener('DOMContentLoaded', cargarReservas);
    </script>
</body>
</html>