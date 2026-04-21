<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Género</title>
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
    <h1 class="admin-title">Editar Género</h1>

    <div class="admin-card">
        <form class="admin-form" action="/public/index.php?route=actualizar-genero" method="POST">

            <input type="hidden" name="id_genero" value="<?php echo $genero['id_genero']; ?>">

            <input
                type="text"
                name="nombre"
                placeholder="Nombre del género"
                value="<?php echo $genero['nombre']; ?>"
                required>

            <select name="id_pelicula" required>
                <option value="">Seleccione una película</option>
                <?php foreach ($peliculas as $pelicula): ?>
                    <option value="<?php echo $pelicula['id_pelicula']; ?>"
                        <?php echo ($pelicula['id_pelicula'] == $genero['id_pelicula']) ? 'selected' : ''; ?>>
                        <?php echo $pelicula['titulo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar Género</button>

        </form>
    </div>
</div>

</body>
</html>