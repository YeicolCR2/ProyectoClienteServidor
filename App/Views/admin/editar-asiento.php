<?php if (!isset($_SESSION)) session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Asiento</title>
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
    <h1 class="admin-title">Editar Asiento</h1>

    <div class="admin-card">
        <form class="admin-form" action="/public/index.php?route=actualizar-asiento" method="POST">

            <input type="hidden" name="id_asiento" value="<?php echo $asiento['id_asiento']; ?>">

            <input
                type="text"
                name="fila"
                placeholder="Fila"
                value="<?php echo $asiento['fila']; ?>"
                required>

            <input
                type="number"
                name="numero"
                placeholder="Número de asiento"
                value="<?php echo $asiento['numero']; ?>"
                required>

            <select name="id_sala" required>
                <option value="">Seleccione una sala</option>
                <?php foreach ($salas as $sala): ?>
                    <option value="<?php echo $sala['id_sala']; ?>"
                        <?php echo ($sala['id_sala'] == $asiento['id_sala']) ? 'selected' : ''; ?>>
                        Sala <?php echo $sala['numero']; ?> - <?php echo $sala['tipo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit">Actualizar Asiento</button>

        </form>
    </div>
</div>

</body>
</html>