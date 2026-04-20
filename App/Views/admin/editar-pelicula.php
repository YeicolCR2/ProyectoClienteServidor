<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Película - Admin</title>
    <link rel="stylesheet" href="/public/css/admin.css">
</head>

<body>
    <header class="admin-header">
        <nav class="admin-nav">
            <div class="admin-logo">CINE <span>U XD</span></div>
            <div class="admin-actions">
                <div class="admin-user"><?php echo $_SESSION['usuario']['nombre']; ?></div>
                <a href="/public/index.php?route=admin" class="admin-btn">Volver al Panel</a>
                <a href="/public/index.php?route=logout" class="logout-btn">Cerrar sesión</a>
            </div>
        </nav>
    </header>

    <main class="admin-container">
        <h1>Editar Película</h1>
        <form action="/public/index.php?route=editar-pelicula" method="POST" enctype="multipart/form-data" class="admin-form" style="max-width:600px;">
            <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula']; ?>">

            <label>Título:</label>
            <input type="text" name="titulo" value="<?php echo htmlspecialchars($pelicula['titulo']); ?>" required>

            <label>Duración (minutos):</label>
            <input type="number" name="duracion" value="<?php echo $pelicula['duracion']; ?>">

            <label>Descripción:</label>
            <textarea name="descripcion"><?php echo htmlspecialchars($pelicula['descripcion']); ?></textarea>

            <label>Fecha de estreno:</label>
            <input type="date" name="fecha_estreno" value="<?php echo $pelicula['fecha_estreno']; ?>">

            <label>Estado:</label>
            <input type="text" name="estado" value="<?php echo htmlspecialchars($pelicula['estado']); ?>">

            <label>Imagen actual:</label>
            <?php if (!empty($pelicula['imagen'])): ?>
                <img src="/Public/PIC/<?php echo htmlspecialchars($pelicula['imagen']); ?>" width="100"><br>
            <?php else: ?>
                <p>No hay imagen</p>
            <?php endif; ?>

            <label>Cambiar imagen (opcional):</label>
            <input type="file" name="imagen" accept="image/*">

            <button type="submit">Actualizar Película</button>
            <a href="/public/index.php?route=admin" class="btn-cancel">Cancelar</a>
        </form>
    </main>
</body>

</html>