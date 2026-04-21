<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cine</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>

<body>

    <header class="admin-header">
        <nav class="admin-nav">
            <div class="admin-logo">CINE <span>U XD</span></div>

            <div class="admin-actions">
                <div class="admin-user">
                    <?php echo $_SESSION['usuario']['nombre']; ?>
                </div>
                <a href="/public/index.php?route=admin" class="admin-btn">Volver</a>
            </div>
        </nav>
    </header>

    <div class="admin-container">
        <h1 class="admin-title">Editar Cine</h1>

        <div class="admin-card">
            <form class="admin-form" action="/public/index.php?route=actualizar-cine" method="POST">

                <input type="hidden" name="id_cine" value="<?php echo $cine['id_cine']; ?>">

                <input type="text" name="nombre" value="<?php echo $cine['nombre']; ?>" required>
                <input type="text" name="direccion" value="<?php echo $cine['direccion']; ?>" required>
                <input type="text" name="ciudad" value="<?php echo $cine['ciudad']; ?>" required>

                <button type="submit">Actualizar Cine</button>

            </form>
        </div>
    </div>

</body>

</html>