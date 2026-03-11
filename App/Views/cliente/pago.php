<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: /app/views/auth/login.php");
    exit;
}
$total = isset($_GET['total']) ? $_GET['total'] : 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago - Cine U XD 2060</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9d00ff;
            --dark-bg: #0a0a0f;
        }

        .pago-container {
            max-width: 800px;
            margin: 40px auto;
            background: rgba(255,255,255,0.05);
            border-radius: 30px;
            padding: 40px;
            border: 1px solid var(--neon-blue);
            box-shadow: 0 0 50px rgba(0,243,255,0.2);
        }

        .pago-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .pago-header h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 32px;
            color: var(--neon-blue);
            margin-bottom: 10px;
        }

        .resumen-compra {
            background: rgba(0,0,0,0.3);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid rgba(0,243,255,0.2);
        }

        .resumen-item {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .total-pago {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid var(--neon-blue);
            font-size: 24px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
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
            border-radius: 15px;
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
            border-color: var(--neon-blue);
            box-shadow: 0 0 20px rgba(0,243,255,0.3);
            outline: none;
        }

        .row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn-pagar {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 30px;
            transition: all 0.3s;
        }

        .btn-pagar:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(0,243,255,0.5);
        }

        .datos-reserva {
            background: rgba(0,243,255,0.05);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
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
        <div class="pago-container">
            <div class="pago-header">
                <h2>🚀 PAGO SEGURO</h2>
                <p>Completa tus datos para finalizar la compra</p>
            </div>

            <div class="datos-reserva" id="datos-reserva">
                <h3 style="color: var(--neon-blue); margin-bottom: 15px;">RESUMEN DE COMPRA</h3>
                <!-- Se llena con JS -->
            </div>

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
                    <input type="text" placeholder="1234 5678 9012 3456" maxlength="19">
                </div>
                <div class="row">
                    <div class="input-group-pago">
                        <label>Vencimiento</label>
                        <input type="text" placeholder="MM/AA">
                    </div>
                    <div class="input-group-pago">
                        <label>CVV</label>
                        <input type="text" placeholder="123" maxlength="3">
                    </div>
                </div>
                <div class="input-group-pago">
                    <label>Nombre en la Tarjeta</label>
                    <input type="text" placeholder="Como aparece en la tarjeta">
                </div>
            </div>

            <div id="form-sinpe" class="form-pago" style="display: none;">
                <div class="input-group-pago">
                    <label>Teléfono SINPE</label>
                    <input type="text" placeholder="8888-8888">
                </div>
                <div class="input-group-pago">
                    <label>Código de Confirmación</label>
                    <input type="text" placeholder="Ingresa el código recibido">
                </div>
            </div>

            <div id="form-efectivo" class="form-pago" style="display: none;">
                <p style="color: #fff; text-align: center;">💰 Pagarás en taquilla el día de la función</p>
            </div>

            <button class="btn-pagar" onclick="procesarPago()">
                <span>CONFIRMAR PAGO - ₡<?php echo number_format($total, 0, ',', '.'); ?></span>
            </button>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>CINE U XD 2060</h4>
                <p>Pagos 100% seguros</p>
            </div>
        </div>
    </footer>

    <script>
    let metodoSeleccionado = '';

    // Cargar datos de la reserva
    const reservaData = JSON.parse(sessionStorage.getItem('reserva_temp') || '{}');
    
    document.getElementById('datos-reserva').innerHTML = `
        <div class="resumen-item"><span>Película:</span> <span>${reservaData.pelicula || 'N/A'}</span></div>
        <div class="resumen-item"><span>Cine:</span> <span>${reservaData.cine || 'N/A'}</span></div>
        <div class="resumen-item"><span>Sala:</span> <span>${reservaData.sala || 'N/A'}</span></div>
        <div class="resumen-item"><span>Horario:</span> <span>${reservaData.horario || 'N/A'}</span></div>
        <div class="resumen-item"><span>Asientos:</span> <span>${reservaData.asientos || 'N/A'}</span></div>
        <div class="total-pago"><span>TOTAL:</span> <span>₡${(reservaData.total || 0).toLocaleString()}</span></div>
    `;

    function seleccionarMetodo(metodo) {
        document.querySelectorAll('.metodo-pago').forEach(m => m.classList.remove('selected'));
        event.currentTarget.classList.add('selected');
        metodoSeleccionado = metodo;
        
        document.querySelectorAll('.form-pago').forEach(f => f.style.display = 'none');
        document.getElementById(`form-${metodo}`).style.display = 'block';
    }

    function procesarPago() {
        if (!metodoSeleccionado) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Selecciona un método de pago',
                background: '#1a1a2e',
                color: '#fff',
                confirmButtonColor: '#00f3ff'
            });
            return;
        }

        Swal.fire({
            icon: 'success',
            title: '🎉 ¡PAGO EXITOSO!',
            html: `
                <div style="text-align: left; padding: 15px;">
                    <p>✅ Reserva confirmada</p>
                    <p>📧 Te enviamos los detalles a tu correo</p>
                    <p>🎫 Código: CINE-${Math.floor(Math.random() * 10000)}</p>
                    <hr style="border-color: #00f3ff; margin: 10px 0;">
                    <p><strong>Película:</strong> ${reservaData.pelicula}</p>
                    <p><strong>Asientos:</strong> ${reservaData.asientos}</p>
                    <p><strong>Total pagado:</strong> ₡${reservaData.total?.toLocaleString()}</p>
                </div>
            `,
            background: '#1a1a2e',
            color: '#fff',
            confirmButtonColor: '#00f3ff',
            confirmButtonText: 'VER MIS RESERVAS'
        }).then((result) => {
            if (result.isConfirmed) {
                sessionStorage.removeItem('reserva_temp');
                window.location.href = '/app/views/cliente/mis-reservas.php';
            }
        });
    }
    </script>
</body>
</html>