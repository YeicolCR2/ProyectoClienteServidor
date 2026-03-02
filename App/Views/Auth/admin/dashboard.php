<?php
session_start();
if(!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: /app/views/auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>
<body>
    <div class="admin-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>🎬 Cine U XD</h2>
                <p>Admin: <?php echo $_SESSION['usuario']['nombre']; ?></p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="/app/views/admin/dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="/app/views/admin/peliculas.php">Películas</a></li>
                    <li><a href="/app/views/admin/usuarios.php">Usuarios</a></li>
                    <li><a href="/app/views/admin/reservas.php">Reservas</a></li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <a href="/app/Controllers/LogoutController.php" class="btn-logout">Cerrar Sesión</a>
            </div>
        </aside>

        <main class="admin-main">
            <div class="admin-header">
                <h1>Dashboard</h1>
                <div class="header-date"><?php echo date("d/m/Y"); ?></div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Películas</h3>
                    <p class="stat-number">4</p>
                </div>
                <div class="stat-card">
                    <h3>Usuarios</h3>
                    <p class="stat-number">2</p>
                </div>
                <div class="stat-card">
                    <h3>Reservas</h3>
                    <p class="stat-number">0</p>
                </div>
            </div>

            <div class="recent-section">
                <h2>Bienvenido al panel de administración</h2>
                <p>Selecciona una opción del menú para comenzar.</p>
            </div>
        </main>
    </div>
</body>
</html>