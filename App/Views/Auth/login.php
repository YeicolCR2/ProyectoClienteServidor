<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cine U XD 2060</title>
    <link rel="stylesheet" href="/public/css/auth.css">
    <link rel="stylesheet" href="/public/css/base.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&display=swap');
        
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9d00ff;
            --neon-pink: #ff00c8;
            --dark-bg: #0a0a0f;
        }

        /* Estilos del Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(8px);
            z-index: 1000;
        }

        .modal-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(10, 10, 15, 0.98);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 30px;
            width: 90%;
            max-width: 450px;
            z-index: 1001;
            border: 1px solid rgba(0, 243, 255, 0.3);
            box-shadow: 0 0 50px rgba(0, 243, 255, 0.2);
            animation: modalFadeIn 0.4s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -45%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        .modal-container h2 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            margin-bottom: 20px;
            font-size: 28px;
            text-align: center;
            text-shadow: 0 0 15px rgba(0, 243, 255, 0.5);
        }

        .modal-container p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 25px;
            text-align: center;
            font-size: 14px;
            line-height: 1.6;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-size: 32px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .modal-close:hover {
            color: var(--neon-pink);
            transform: rotate(90deg);
        }

        .btn-reset {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--neon-blue), var(--neon-purple));
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Orbitron', sans-serif;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 30px rgba(0, 243, 255, 0.5);
        }

        .back-to-login {
            margin-top: 20px;
            text-align: center;
        }

        .back-to-login a {
            color: var(--neon-blue);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }

        .back-to-login a:hover {
            color: var(--neon-pink);
            text-shadow: 0 0 10px var(--neon-pink);
        }

        /* Estilo bonito para "¿Olvidaste tu contraseña?" - SOLO EN LOGIN */
        .forgot-password-wrapper {
            text-align: right;
            margin: -5px 0 25px 0;
        }

        .forgot-password-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 13px;
            text-decoration: none;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            padding: 5px 0;
            border-bottom: 1px dashed transparent;
        }

        .forgot-password-link:hover {
            color: var(--neon-blue);
            border-bottom-color: var(--neon-blue);
            text-shadow: 0 0 8px rgba(0, 243, 255, 0.4);
        }

        .forgot-password-link i {
            font-size: 12px;
            transition: transform 0.3s;
        }

        .forgot-password-link:hover i {
            transform: translateX(3px);
        }

        /* Mensaje de bienvenida */
        .welcome-message {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0, 243, 255, 0.2);
        }

        .welcome-message p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 12px;
            margin: 5px 0;
            font-family: 'Orbitron', sans-serif;
        }

        .welcome-message p:first-child {
            color: var(--neon-blue);
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .modal-container {
                padding: 30px 20px;
                width: 95%;
            }
            .modal-container h2 {
                font-size: 22px;
            }
            .forgot-password-link {
                font-size: 11px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="background-container">
            <div class="bg bg-left"></div>
            <div class="bg bg-right"></div>
            <div class="overlay"></div>
        </div>

        <header class="main-header">
            <a href="/public/index.php" class="logo">🎬 CINE U XD <span class="logo-year">2060</span></a>
        </header>

        <main class="login-main">
            <div class="login-container glass-effect">
                <?php if (isset($_SESSION['registro_exitoso'])): ?>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: '🚀 ¡REGISTRO EXITOSO!',
                            html: `
                                <div style="text-align: left; padding: 15px;">
                                    <p><strong>👤 Nombre:</strong> <?php echo $_SESSION['registro_exitoso']['nombre']; ?></p>
                                    <p><strong>📧 Correo:</strong> <?php echo $_SESSION['registro_exitoso']['correo']; ?></p>
                                </div>
                            `,
                            background: '#0a0a0f',
                            color: '#fff',
                            confirmButtonColor: '#00f3ff'
                        });
                    </script>
                <?php 
                    unset($_SESSION['registro_exitoso']);
                endif; 
                ?>

                <div class="auth-tabs">
                    <button class="tab-btn active" onclick="showLogin()">INICIAR SESIÓN</button>
                    <button class="tab-btn" onclick="showRegister()">CREAR CUENTA</button>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: '❌ Error',
                            text: '<?php echo $_SESSION['error']; ?>',
                            background: '#0a0a0f',
                            color: '#fff',
                            confirmButtonColor: '#00f3ff'
                        });
                    </script>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <!-- FORMULARIO DE INICIO DE SESIÓN (CON "¿Olvidaste tu contraseña?") -->
                <div id="loginForm" class="auth-form active">
                    <h2 class="form-title">BIENVENIDO</h2>
                    <form action="/app/Controllers/AuthController.php" method="POST">
                        <div class="input-group futuristic-input">
                            <input type="email" name="correo" placeholder=" " required>
                            <label>Correo Electrónico</label>
                            <span class="input-border"></span>
                        </div>
                        <div class="input-group futuristic-input">
                            <input type="password" name="password" placeholder=" " required>
                            <label>Contraseña</label>
                            <span class="input-border"></span>
                        </div>
                        <div class="forgot-password-wrapper">
                            <a href="#" class="forgot-password-link" onclick="showForgotPassword()">
                                <span>🔐</span>
                                <span>¿Olvidaste tu contraseña?</span>
                                <span>→</span>
                            </a>
                        </div>
                        <button type="submit" name="login" class="btn-futuristic">
                            <span>INGRESAR</span>
                        </button>
                    </form>
                    <div class="welcome-message">
                        <p>✨ BIENVENIDO, SEÑOR/A ✨</p>
                        <p>¿Estás listo para empezar tu experiencia cinematográfica?</p>
                        <p>Si eres nuevo, regístrate y descubre el futuro del cine.</p>
                    </div>
                </div>

                <!-- FORMULARIO DE REGISTRO (SIN "¿Olvidaste tu contraseña?" y CON NOMBRE COMPLETO) -->
                <div id="registerForm" class="auth-form">
                    <h2 class="form-title">CREAR CUENTA</h2>
                    <form action="/app/Controllers/AuthController.php" method="POST">
                        <div class="input-group futuristic-input">
                            <input type="text" name="nombre" placeholder=" " required>
                            <label>Nombre Completo</label>
                            <span class="input-border"></span>
                        </div>
                        <div class="input-group futuristic-input">
                            <input type="email" name="correo" placeholder=" " required>
                            <label>Correo Electrónico</label>
                            <span class="input-border"></span>
                        </div>
                        <div class="input-group futuristic-input">
                            <input type="password" name="password" placeholder=" " required>
                            <label>Contraseña</label>
                            <span class="input-border"></span>
                        </div>
                        <button type="submit" name="register" class="btn-futuristic">
                            <span>REGISTRARSE</span>
                        </button>
                    </form>
                    <div class="welcome-message">
                        <p>✨ ÚNETE A LA REVOLUCIÓN ✨</p>
                        <p>Crea tu cuenta y vive la experiencia Cine U XD 2060.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal de Olvidé mi contraseña -->
        <div id="forgotPasswordModal" style="display: none;">
            <div class="modal-overlay" onclick="closeForgotPassword()"></div>
            <div class="modal-container">
                <button class="modal-close" onclick="closeForgotPassword()">&times;</button>
                <h2>🔐 RECUPERAR ACCESO</h2>
                <p>Ingresa tu correo electrónico y te enviaremos instrucciones para restablecer tu contraseña.</p>
                
                <form id="forgotPasswordForm">
                    <div class="input-group futuristic-input">
                        <input type="email" id="resetEmail" name="resetEmail" placeholder=" " required>
                        <label>Correo Electrónico</label>
                        <span class="input-border"></span>
                    </div>
                    <button type="submit" class="btn-reset">ENVIAR INSTRUCCIONES</button>
                </form>
                
                <p class="back-to-login">
                    <a href="#" onclick="closeForgotPassword()">← Volver al inicio de sesión</a>
                </p>
            </div>
        </div>

        <footer class="main-footer">
            <div class="footer-content">
                <div class="footer-copy">
                    <span>© 2060 CINE U XD</span>
                </div>
                <div class="footer-links">
                    <span>NEON REALITY</span>
                    <span>HOLOGRAM EXPERIENCE</span>
                    <span>AI ASSISTANT</span>
                </div>
            </div>
        </footer>
    </div>

    <script>
    function showRegister() {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[1].classList.add('active');
        document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
        document.getElementById('registerForm').classList.add('active');
        document.getElementById('forgotPasswordModal').style.display = 'none';
    }

    function showLogin() {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[0].classList.add('active');
        document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
        document.getElementById('loginForm').classList.add('active');
        document.getElementById('forgotPasswordModal').style.display = 'none';
    }

    function showForgotPassword() {
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('registerForm').style.display = 'none';
        document.getElementById('forgotPasswordModal').style.display = 'block';
    }

    function closeForgotPassword() {
        document.getElementById('forgotPasswordModal').style.display = 'none';
        document.getElementById('loginForm').style.display = 'block';
        document.getElementById('registerForm').style.display = 'none';
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[0].classList.add('active');
        document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
        document.getElementById('loginForm').classList.add('active');
    }

    document.getElementById('forgotPasswordForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('resetEmail').value;
        
        if (!email) {
            Swal.fire({
                icon: 'error',
                title: '⚠️ ERROR',
                text: 'Por favor ingresa tu correo electrónico',
                background: '#0a0a0f',
                color: '#fff',
                confirmButtonColor: '#00f3ff'
            });
            return;
        }
        
        Swal.fire({
            icon: 'success',
            title: '📧 ¡INSTRUCCIONES ENVIADAS!',
            html: `
                <div style="text-align: center;">
                    <p>Hemos enviado un enlace de recuperación a:</p>
                    <p><strong style="color: #00f3ff;">${email}</strong></p>
                    <hr style="margin: 15px 0; border-color: rgba(0,243,255,0.3);">
                    <p style="font-size: 12px; color: rgba(255,255,255,0.6);">Revisa tu bandeja de entrada y sigue las instrucciones.</p>
                </div>
            `,
            background: '#0a0a0f',
            color: '#fff',
            confirmButtonColor: '#00f3ff',
            confirmButtonText: 'ACEPTAR'
        }).then(() => {
            closeForgotPassword();
            document.getElementById('resetEmail').value = '';
        });
        
        console.log('Recuperación solicitada para:', email);
    });
    </script>
</body>
</html>