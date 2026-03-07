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
                        <button type="submit" name="login" class="btn-futuristic">
                            <span>INGRESAR</span>
                        </button>
                    </form>
                </div>

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
                </div>
            </div>
        </main>
    </div>

    <script>
    function showRegister() {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[1].classList.add('active');
        document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
        document.getElementById('registerForm').classList.add('active');
    }

    function showLogin() {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-btn')[0].classList.add('active');
        document.querySelectorAll('.auth-form').forEach(form => form.classList.remove('active'));
        document.getElementById('loginForm').classList.add('active');
    }
    </script>
</body>
</html>