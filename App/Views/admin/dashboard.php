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
        <?php if (isset($_GET['deleted'])): ?>
            <div class="admin-alert">Registro eliminado correctamente.</div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="admin-alert error">No se pudo eliminar el registro.</div>
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

            <!-- Película -->
            <div class="admin-card">
                <h2>Registrar Película</h2>
                <form class="admin-form" action="/public/index.php?route=guardar-pelicula" method="POST" enctype="multipart/form-data">
                    <input type="text" name="titulo" placeholder="Título" required>
                    <input type="number" name="duracion" placeholder="Duración en minutos">
                    <textarea name="descripcion" placeholder="Descripción"></textarea>
                    <input type="date" name="fecha_estreno">
                    <input type="text" name="estado" placeholder="Estado (cartelera / proximamente)">
                    <label>Póster:</label>
                    <input type="file" name="imagen" accept="image/*">
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
                            <th>Imagen</th>
                            <th>Título</th>
                            <th>Duración</th>
                            <th>Fecha Estreno</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peliculas as $pelicula): ?>
                            <tr>
                                <td><?php echo $pelicula['id_pelicula']; ?></td>
                                <td><img src="/Public/PIC/<?php echo htmlspecialchars($pelicula['imagen'] ?? 'default.jpg'); ?>" width="50"></td>
                                <td><?php echo $pelicula['titulo']; ?></td>
                                <td><?php echo $pelicula['duracion']; ?></td>
                                <td><?php echo $pelicula['fecha_estreno']; ?></td>
                                <td><?php echo $pelicula['estado']; ?></td>
                                <td>
                                    <a href="/public/index.php?route=editar-pelicula-form&id=<?php echo $pelicula['id_pelicula']; ?>" class="btn-edit">Editar</a>
                                    <form action="/public/index.php?route=eliminar-pelicula" method="POST" onsubmit="return confirm('¿Desea eliminar esta película?');" style="display:inline;">
                                        <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula']; ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="admin-table-section">
            <div class="admin-table-card">
                <h2>Cines Registrados</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Ciudad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cines as $cine): ?>
                            <tr>
                                <td><?php echo $cine['id_cine']; ?></td>
                                <td><?php echo $cine['nombre']; ?></td>
                                <td><?php echo $cine['direccion']; ?></td>
                                <td><?php echo $cine['ciudad']; ?></td>
                                <td class="acciones">
                                    <a href="/public/index.php?route=editar-cine-form&id=<?= $cine['id_cine']; ?>" class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="/public/index.php?route=eliminar-cine" method="POST" onsubmit="return confirm('¿Desea eliminar este cine?');" style="display:inline;">
                                        <input type="hidden" name="id_cine" value="<?php echo $cine['id_cine']; ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="admin-table-section">
            <div class="admin-table-card">
                <h2>Salas Registradas</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Cine</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($salas as $sala): ?>
                            <tr>
                                <td><?php echo $sala['id_sala']; ?></td>
                                <td><?php echo $sala['numero']; ?></td>
                                <td><?php echo $sala['tipo']; ?></td>
                                <td><?php echo $sala['cine_nombre']; ?></td>
                                <td class="acciones">
                                    <a href="/public/index.php?route=editar-sala-form&id=<?= $sala['id_sala']; ?>" class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="/public/index.php?route=eliminar-sala" method="POST" onsubmit="return confirm('¿Desea eliminar esta sala?');" style="display:inline;">
                                        <input type="hidden" name="id_sala" value="<?php echo $sala['id_sala']; ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="admin-table-section">
            <div class="admin-table-card">
                <h2>Géneros Registrados</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Película</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($generos as $genero): ?>
                            <tr>
                                <td><?php echo $genero['id_genero']; ?></td>
                                <td><?php echo $genero['nombre']; ?></td>
                                <td><?php echo $genero['pelicula_titulo']; ?></td>
                                <td class="acciones">
                                    <a href="/public/index.php?route=editar-genero-form&id=<?= $genero['id_genero']; ?>" class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="/public/index.php?route=eliminar-genero" method="POST" onsubmit="return confirm('¿Desea eliminar este género?');" style="display:inline;">
                                        <input type="hidden" name="id_genero" value="<?php echo $genero['id_genero']; ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="admin-table-section">
            <div class="admin-table-card">
                <h2>Funciones Registradas</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Precio</th>
                            <th>Película</th>
                            <th>Sala</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funciones as $funcion): ?>
                            <tr>
                                <td><?php echo $funcion['id_funcion']; ?></td>
                                <td><?php echo $funcion['fecha']; ?></td>
                                <td><?php echo $funcion['hora']; ?></td>
                                <td><?php echo $funcion['precio']; ?></td>
                                <td><?php echo $funcion['pelicula_titulo']; ?></td>
                                <td><?php echo $funcion['sala_numero']; ?></td>
                                <td class="acciones">
                                    <a href="/public/index.php?route=editar-funcion-form&id=<?= $funcion['id_funcion']; ?>" class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="/public/index.php?route=eliminar-funcion" method="POST" onsubmit="return confirm('¿Desea eliminar esta función?');" style="display:inline;">
                                        <input type="hidden" name="id_funcion" value="<?php echo $funcion['id_funcion']; ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-table-section">
            <div class="admin-table-card">
                <h2>Asientos Registrados</h2>

                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fila</th>
                            <th>Número</th>
                            <th>Sala</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asientos as $asiento): ?>
                            <tr>
                                <td><?php echo $asiento['id_asiento']; ?></td>
                                <td><?php echo $asiento['fila']; ?></td>
                                <td><?php echo $asiento['numero']; ?></td>
                                <td><?php echo $asiento['sala_numero']; ?></td>
                                <td class="acciones">
                                    <a href="/public/index.php?route=editar-asiento-form&id=<?= $asiento['id_asiento']; ?>" class="btn-edit">
                                        Editar
                                    </a>

                                    <form action="/public/index.php?route=eliminar-asiento" method="POST" onsubmit="return confirm('¿Desea eliminar este asiento?');" style="display:inline;">
                                        <input type="hidden" name="id_asiento" value="<?php echo $asiento['id_asiento']; ?>">
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</body>

</html>