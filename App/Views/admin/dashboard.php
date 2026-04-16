<?php if (!isset($_SESSION)) session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
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
                <a href="/public/index.php?route=home" class="admin-btn">Ir al inicio</a>
                <a href="/public/index.php?route=logout" class="logout-btn">Cerrar sesión</a>
            </div>
        </nav>
    </header>

    <main class="admin-container">
        <h1 class="admin-title">Panel de Administración</h1>
        <p class="admin-subtitle">Gestiona la información principal del sistema de cine</p>

        <?php if (isset($_GET['success'])): ?>
            <div class="admin-alert">Registro guardado correctamente.</div>
        <?php endif; ?>

        <section class="admin-grid">

            <div class="admin-card">
                <h2>Registrar Cine</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-cine" method="POST">
                    <input type="text" name="nombre" placeholder="Nombre del cine" required>
                    <input type="text" name="direccion" placeholder="Dirección">
                    <input type="text" name="ciudad" placeholder="Ciudad">
                    <button type="submit">Guardar Cine</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>Registrar Sala</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-sala" method="POST">
                    <input type="number" name="numero" placeholder="Número de sala" required>
                    <input type="text" name="tipo" placeholder="Tipo de sala">
                    <select name="id_cine" required>
                        <option value="">Seleccione un cine</option>
                        <?php foreach ($cines as $cine): ?>
                            <option value="<?php echo $cine['id_cine']; ?>">
                                <?php echo $cine['nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Guardar Sala</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>Registrar Película</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-pelicula" method="POST">
                    <input type="text" name="titulo" placeholder="Título" required>
                    <input type="number" name="duracion" placeholder="Duración en minutos">
                    <textarea name="descripcion" placeholder="Descripción"></textarea>
                    <input type="date" name="fecha_estreno">
                    <input type="text" name="estado" placeholder="Estado">
                    <button type="submit">Guardar Película</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>Registrar Género</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-genero" method="POST">
                    <input type="text" name="nombre" placeholder="Nombre del género" required>
                    <select name="id_pelicula" required>
                        <option value="">Seleccione una película</option>
                        <?php foreach ($peliculas as $pelicula): ?>
                            <option value="<?php echo $pelicula['id_pelicula']; ?>">
                                <?php echo $pelicula['titulo']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Guardar Género</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>Registrar Función</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-funcion" method="POST">
                    <input type="date" name="fecha" required>
                    <input type="time" name="hora" required>
                    <input type="number" step="0.01" name="precio" placeholder="Precio" required>

                    <select name="id_pelicula" required>
                        <option value="">Seleccione una película</option>
                        <?php foreach ($peliculas as $pelicula): ?>
                            <option value="<?php echo $pelicula['id_pelicula']; ?>">
                                <?php echo $pelicula['titulo']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="id_sala" required>
                        <option value="">Seleccione una sala</option>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?php echo $sala['id_sala']; ?>">
                                Sala <?php echo $sala['numero']; ?> - <?php echo $sala['cine_nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Guardar Función</button>
                </form>
            </div>

            <div class="admin-card">
                <h2>Registrar Asiento</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-asiento" method="POST">
                    <input type="text" name="fila" placeholder="Fila" required>
                    <input type="number" name="numero" placeholder="Número de asiento" required>

                    <select name="id_sala" required>
                        <option value="">Seleccione una sala</option>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?php echo $sala['id_sala']; ?>">
                                Sala <?php echo $sala['numero']; ?> - <?php echo $sala['cine_nombre']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Guardar Asiento</button>
                </form>
            </div>

        </section>

        <section class="admin-table-section">
            <div class="admin-table-card">
                <h2>Películas Registradas</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Duración</th>
                            <th>Fecha Estreno</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peliculas as $pelicula): ?>
                            <tr>
                                <td><?php echo $pelicula['id_pelicula']; ?></td>
                                <td><?php echo $pelicula['titulo']; ?></td>
                                <td><?php echo $pelicula['duracion']; ?></td>
                                <td><?php echo $pelicula['fecha_estreno']; ?></td>
                                <td><?php echo $pelicula['estado']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </section>
    </main>

</body>
</html>