<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/index.php?route=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cartelera</title>
</head>

<body>

<h1>CARTELERA</h1>

<?php if (!empty($peliculas)): ?>

    <?php foreach ($peliculas as $pelicula): ?>

        <div style="border:1px solid #ccc; margin:10px; padding:10px;">

            <h2><?php echo $pelicula['titulo']; ?></h2>

            <p><strong>Duración:</strong> <?php echo $pelicula['duracion']; ?> min</p>

            <p><strong>Descripción:</strong> <?php echo $pelicula['descripcion']; ?></p>

            <p><strong>Estreno:</strong> <?php echo $pelicula['fecha_estreno']; ?></p>

            <a href="#">Reservar</a>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <p>No hay películas en cartelera</p>

<?php endif; ?>

</body>
</html>