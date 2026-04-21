<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Función</title>
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
    <h1 class="admin-title">Editar Función</h1>

    <div class="admin-card">
        <form class="admin-form" action="/public/index.php?route=actualizar-funcion" method="POST">

            <input type="hidden" name="id_funcion" value="<?php echo $funcion['id_funcion']; ?>">

            <input
                type="date"
                name="fecha"
                value="<?php echo $funcion['fecha']; ?>"
                required>

            <input
                type="time"
                name="hora"
                value="<?php echo $funcion['hora']; ?>"
                required>

            <input
                type="number"
                step="0.01"
                name="precio"
                placeholder="Precio"
                value="<?php echo $funcion['precio']; ?>"
                required>

            <select name="id_pelicula" required>
                <option value="">Seleccione una película</option>
                <?php foreach ($peliculas as $pelicula): ?>
                    <option value="<?php echo $pelicula['id_pelicula']; ?>"
                        <?php echo ($pelicula['id_pelicula'] == $funcion['id_pelicula']) ? 'selected' : ''; ?>>
                        <?php echo $pelicula['titulo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="id_sala" required>
                <option value="">Seleccione una sala</option>
                <?php foreach ($salas as $sala): ?>
                    <option value="<?php echo $sala['id_sala']; ?>"
                        <?php echo ($sala['id_sala'] == $funcion['id_sala']) ? 'selected' : ''; ?>>
                        Sala <?php echo $sala['numero']; ?> - <?php echo $sala['tipo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar Función</button>

        </form>
    </div>
</div>

</body>
</html>