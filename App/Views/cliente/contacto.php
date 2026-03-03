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
    <title>Contacto - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <li><a href="/app/views/cliente/contacto.php" class="active">Contacto</a></li>
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
            <h1 class="page-title">📞 CONTACTO</h1>
            
            <div class="contacto-grid">
                <div class="contacto-info">
                    <div class="info-card">
                        <h3>📍 Ubicación</h3>
                        <p>Mall Central, San José<br>Frente a la plaza de la cultura</p>
                    </div>
                    
                    <div class="info-card">
                        <h3>📱 Teléfonos</h3>
                        <p>Administración: 2222-3333<br>
                           Reservas: 2222-3344<br>
                           Soporte: 2222-3355</p>
                    </div>
                    
                    <div class="info-card">
                        <h3>✉ Email</h3>
                        <p>info@cineuxd.com<br>
                           reservaciones@cineuxd.com<br>
                           soporte@cineuxd.com</p>
                    </div>
                    
                    <div class="info-card">
                        <h3>⏰ Horarios</h3>
                        <p>Taquilla: 11:00 AM - 11:00 PM<br>
                           Funciones: 12:00 PM - 12:00 AM<br>
                           Todos los días</p>
                    </div>

                    <div class="info-card social-card">
                        <h3>📱 Redes Sociales</h3>
                        <p>Síguenos en Instagram para estar al tanto de estrenos y promociones:</p>
                        <a href="https://www.instagram.com/" target="_blank" class="instagram-link">
                            <i class="fab fa-instagram"></i> @cineuxd_cr
                        </a>
                    </div>
                </div>
                
                <div class="contacto-form">
                    <h2>Envíanos un mensaje</h2>
                    <form id="contactoForm">
                        <div class="form-group">
                            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="correo" name="correo" placeholder="Tu correo" required>
                        </div>
                        <div class="form-group">
                            <select id="asunto" name="asunto" required>
                                <option value="">Selecciona un asunto</option>
                                <option value="consulta">Consulta general</option>
                                <option value="reserva">Problema con reserva</option>
                                <option value="sugerencia">Sugerencia</option>
                                <option value="reclamo">Reclamo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea id="mensaje" name="mensaje" rows="5" placeholder="Tu mensaje" required></textarea>
                        </div>
                        <button type="submit" class="btn-primary">Enviar mensaje</button>
                    </form>
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
            <div class="footer-section">
                <h4>Síguenos</h4>
                <a href="https://www.instagram.com/cineuxd.oficial/" target="_blank" class="social-link">
                    <i class="fab fa-instagram"></i> Instagram
                </a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?= date("Y"); ?> Cine U XD - Todos los derechos reservados</p>
        </div>
    </footer>

    <script>
    document.getElementById('contactoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nombre = document.getElementById('nombre').value;
        const correo = document.getElementById('correo').value;
        const asunto = document.getElementById('asunto').value;
        const mensaje = document.getElementById('mensaje').value;
        
        // Sweet Alert de éxito
        Swal.fire({
            icon: 'success',
            title: '¡Mensaje enviado!',
            text: 'Gracias por contactarnos, te responderemos pronto.',
            confirmButtonColor: '#6bc9da',
            confirmButtonText: 'Ver detalles'
        }).then((result) => {
            if (result.isConfirmed) {
                // Mostrar ventana emergente con los datos
                Swal.fire({
                    title: 'Datos del mensaje',
                    html: `
                        <div style="text-align: left;">
                            <p><strong>Nombre:</strong> ${nombre}</p>
                            <p><strong>Correo:</strong> ${correo}</p>
                            <p><strong>Asunto:</strong> ${asunto}</p>
                            <p><strong>Mensaje:</strong> ${mensaje}</p>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonColor: '#6bc9da',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
        
        // Limpiar formulario
        this.reset();
    });
    </script>

    <style>
    .instagram-link {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #833ab4, #fd1d1d, #f77737);
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: transform 0.3s;
    }
    
    .instagram-link:hover {
        transform: translateY(-2px);
        color: white;
    }
    
    .social-link {
        color: #6bc9da;
        text-decoration: none;
        font-size: 18px;
        transition: color 0.3s;
    }
    
    .social-link:hover {
        color: #187bcd;
    }
    
    .social-card {
        background: linear-gradient(135deg, rgba(131,58,180,0.1), rgba(253,29,29,0.1), rgba(247,119,55,0.1));
        border-left: 4px solid #833ab4;
    }
    </style>
</body>
</html>