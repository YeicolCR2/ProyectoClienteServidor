<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - Cine U XD</title>

    <link rel="stylesheet" href="/public/css/auth.css">
    <link rel="stylesheet" href="/public/css/base.css">
</head>

<body>

    <!-- HEADER -->
    <header class="main-header">
        <a href="/public/index.php" class="logo">
            🎬 Cine U XD
        </a>
    </header>

    <!-- CONTENIDO -->
    <main class="login-main">

        <div class="background-container">
            <div class="bg bg-left"></div>
            <div class="bg bg-right"></div>
            <div class="overlay"></div>
        </div>

        <div class="login-container">

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error">
                    <?= $_SESSION['error']; ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="success">
                    <?= $_SESSION['success']; ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <div id="loginForm">
                <h2>Iniciar Sesión</h2>

                <form action="/app/Controllers/AuthController.php" method="POST">
                    <div class="input-group">
                        <input type="email" name="correo" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" name="login">Ingresar</button>
                </form>

                <p class="switch-text">
                    ¿No tienes cuenta?
                    <span onclick="showRegister()">Regístrate aquí</span>
                </p>
            </div>

            <div id="registerForm" style="display: none;">
                <h2>Crear Cuenta</h2>

                <form action="/app/Controllers/AuthController.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="nombre" placeholder="Nombre completo" required>
                    </div>
                    <div class="input-group">
                        <input type="email" name="correo" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" name="register">Registrarse</button>
                </form>

                <p class="switch-text">
                    ¿Ya tienes cuenta?
                    <span onclick="showLogin()">Inicia sesión</span>
                </p>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="main-footer">
        © <?= date("Y"); ?> Cine U XD - Todos los derechos reservados
    </footer>

    <!-- SCRIPTS -->
    <script src="/public/js/login.js?v=<?= time(); ?>"></script>

</body>
</html>