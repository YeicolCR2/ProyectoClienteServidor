<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Reservas</title>

    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
</head>

<body>

    <header class="main-header">
        <div class="header-container">

            <a href="/public/index.php?route=home" class="logo">
                CINE U XD
            </a>

            <nav class="main-nav">
                <ul>
                    <li><a href="/public/index.php?route=home">INICIO</a></li>
                    <li><a href="/public/index.php?route=cartelera">CARTELERA</a></li>
                    <li><a href="/public/index.php?route=cines">CINES</a></li>
                    <li><a href="/public/index.php?route=contacto">CONTACTO</a></li>
                    <li><a href="/public/index.php?route=reservas" class="active">MIS RESERVAS</a></li>
                    <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] == 1): ?>
                        <li><a href="/public/index.php?route=admin">ADMIN</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-menu">
                <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/public/index.php?route=logout" class="btn-logout">CERRAR SESIÓN</a>
            </div>

        </div>
    </header>

    <main style="padding:40px;">

        <h1 style="text-align:center;">🎟️ MIS RESERVAS</h1>

        <?php if (!empty($reservas)): ?>

            <?php foreach ($reservas as $r): ?>

                <div style="border:1px solid #ccc; margin:20px auto; padding:20px; max-width:600px; border-radius:10px;">

                    <h2><?php echo $r['titulo']; ?></h2>

                    <p><?php echo $r['descripcion']; ?></p>

                    <p><strong>Fecha:</strong> <?php echo $r['fecha_reserva']; ?></p>

                    <p><strong>Estado:</strong> <?php echo $r['estado']; ?></p>

                    <!-- 🔥 BOTÓN CANCELAR -->
                    <div style="margin-top:15px;">
                        <a href="/public/index.php?route=cancelar_reserva&id=<?php echo $r['id_reserva']; ?>"
                            style="background:red; color:white; padding:8px 12px; text-decoration:none; border-radius:5px;"
                            onclick="return confirm('¿Seguro que deseas cancelar esta reserva?');">
                            Cancelar Reserva
                        </a>
                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <p style="text-align:center;">No tienes reservas aún.</p>

        <?php endif; ?>

    </main>

</body>

</html>