<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Sala</title>
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
    <h1 class="admin-title">Editar Sala</h1>

    <div class="admin-card">
        <form class="admin-form" action="/public/index.php?route=actualizar-sala" method="POST">

            <input type="hidden" name="id_sala" value="<?php echo $sala['id_sala']; ?>">

            <input
                type="number"
                name="numero"
                placeholder="Número de sala"
                value="<?php echo $sala['numero']; ?>"
                required>

            <input
                type="text"
                name="tipo"
                placeholder="Tipo de sala"
                value="<?php echo $sala['tipo']; ?>"
                required>

            <select name="id_cine" required>
                <option value="">Seleccione un cine</option>
                <?php foreach ($cines as $cine): ?>
                    <option value="<?php echo $cine['id_cine']; ?>"
                        <?php echo ($cine['id_cine'] == $sala['id_cine']) ? 'selected' : ''; ?>>
                        <?php echo $cine['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar Sala</button>

        </form>
    </div>
</div>

</body>
</html>