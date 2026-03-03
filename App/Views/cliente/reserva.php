<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header("Location: /app/views/auth/login.php");
    exit;
}
$id_pelicula = isset($_GET['pelicula']) ? $_GET['pelicula'] : 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva - Cine U XD</title>
    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <link rel="stylesheet" href="/public/css/reserva.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <a href="/app/views/cliente/home.php" class="logo">🎬 Cine U XD</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="/app/views/cliente/home.php">Inicio</a></li>
                    <li><a href="/app/views/cliente/cartelera.php">Cartelera</a></li>
                    <li><a href="/app/views/cliente/cines.php">Cines</a></li>
                    <li><a href="/app/views/cliente/contacto.php">Contacto</a></li>
                    <li><a href="/app/views/cliente/mis-reservas.php">Mis Reservas</a></li>
                </ul>
            </nav>
            <div class="user-menu">
                <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
                <a href="/app/Controllers/LogoutController.php" class="btn-logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <h1 class="page-title">🎫 REALIZAR RESERVA</h1>
            
            <div class="reserva-proceso">
                <!-- Paso 1: Selección de película -->
                <div class="paso active" id="paso1">
                    <h2>Paso 1: Selecciona tu película</h2>
                    <div class="peliculas-selector">
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 1 ? 'selected' : ''; ?>" data-pelicula="1" onclick="seleccionarPelicula(1)">
                            <img src="/public/PIC/spiderman.jpg" alt="Spider-Man">
                            <h3>Spider-Man: No Way Home</h3>
                        </div>
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 2 ? 'selected' : ''; ?>" data-pelicula="2" onclick="seleccionarPelicula(2)">
                            <img src="/public/PIC/dbz.jpg" alt="Dragon Ball">
                            <h3>Dragon Ball Super</h3>
                        </div>
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 3 ? 'selected' : ''; ?>" data-pelicula="3" onclick="seleccionarPelicula(3)">
                            <img src="/public/PIC/inter.jpg" alt="Interstellar">
                            <h3>Interstellar</h3>
                        </div>
                        <div class="pelicula-selector-item <?php echo $id_pelicula == 4 ? 'selected' : ''; ?>" data-pelicula="4" onclick="seleccionarPelicula(4)">
                            <img src="/public/PIC/CR7.jpg" alt="CR7">
                            <h3>CR7: El Mundo a sus Pies</h3>
                        </div>
                    </div>
                </div>

                <!-- Paso 2: Selección de función -->
                <div class="paso" id="paso2">
                    <h2>Paso 2: Elige horario y cine</h2>
                    <div class="funciones-grid" id="funciones-container">
                        <!-- Función 1 -->
                        <div class="funcion-card" onclick="seleccionarFuncion(1, 'Cine U XD San José', 'Sala 1 - IMAX', '19:30')">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD San José</span>
                                <span class="sala">Sala 1 - IMAX</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">19:30</span>
                                <span class="precio">₡4,500</span>
                            </div>
                        </div>
                        <!-- Función 2 -->
                        <div class="funcion-card" onclick="seleccionarFuncion(2, 'Cine U XD San José', 'Sala 2 - 3D', '22:00')">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD San José</span>
                                <span class="sala">Sala 2 - 3D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">22:00</span>
                                <span class="precio">₡4,000</span>
                            </div>
                        </div>
                        <!-- Función 3 -->
                        <div class="funcion-card" onclick="seleccionarFuncion(3, 'Cine U XD Escazú', 'Sala 3 - 2D', '20:30')">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Escazú</span>
                                <span class="sala">Sala 3 - 2D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">20:30</span>
                                <span class="precio">₡3,500</span>
                            </div>
                        </div>
                        <!-- Función 4 -->
                        <div class="funcion-card" onclick="seleccionarFuncion(4, 'Cine U XD Heredia', 'Sala 1 - 2D', '18:00')">
                            <div class="funcion-header">
                                <span class="cine">Cine U XD Heredia</span>
                                <span class="sala">Sala 1 - 2D</span>
                            </div>
                            <div class="funcion-body">
                                <span class="fecha">15/03/2026</span>
                                <span class="hora">18:00</span>
                                <span class="precio">₡3,500</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paso 3: Selección de asientos -->
                <div class="paso" id="paso3">
                    <h2>Paso 3: Selecciona tus asientos</h2>
                    <div class="sala-info" id="sala-info">
                        <p><strong>Cine:</strong> <span id="cine-seleccionado">-</span></p>
                        <p><strong>Sala:</strong> <span id="sala-seleccionada">-</span></p>
                        <p><strong>Horario:</strong> <span id="horario-seleccionado">-</span></p>
                    </div>
                    
                    <div class="pantalla">PANTALLA</div>
                    
                    <div class="asientos-container">
                        <?php
                        $filas = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
                        $numeros = range(1, 10);
                        
                        foreach($filas as $fila):
                            foreach($numeros as $num):
                                $asientoId = $fila . $num;
                                // Simular algunos asientos ocupados
                                $ocupado = (($fila == 'C' && $num == 5) || ($fila == 'D' && $num == 3) || ($fila == 'F' && $num == 8)) ? 'ocupado' : '';
                        ?>
                        <div class="asiento <?php echo $ocupado; ?>" 
                             data-asiento="<?php echo $asientoId; ?>"
                             data-fila="<?php echo $fila; ?>"
                             data-numero="<?php echo $num; ?>"
                             onclick="seleccionarAsiento(this)">
                            <?php echo $asientoId; ?>
                        </div>
                        <?php 
                            endforeach;
                        endforeach; 
                        ?>
                    </div>
                    
                    <div class="asientos-leyenda">
                        <span class="leyenda-item disponible">Disponible</span>
                        <span class="leyenda-item seleccionado">Seleccionado</span>
                        <span class="leyenda-item ocupado">Ocupado</span>
                    </div>
                </div>

                <!-- Paso 4: Confirmación -->
                <div class="paso" id="paso4">
                    <h2>Paso 4: Confirma tu reserva</h2>
                    <div class="resumen-reserva" id="resumen-reserva">
                        <!-- Se llena con JS -->
                    </div>
                    
                    <button class="btn-confirmar" onclick="confirmarReserva()">Confirmar Reserva</button>
                </div>
            </div>

            <!-- Navegación de pasos -->
            <div class="pasos-navegacion">
                <button class="btn-secondary" id="btn-anterior" onclick="cambiarPaso(-1)" disabled>Anterior</button>
                <button class="btn-primary" id="btn-siguiente" onclick="cambiarPaso(1)">Siguiente</button>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h4>Cine U XD</h4>
                <p>Tu mejor experiencia cinematográfica</p>
            </div>
            <div class="footer-section">
                <h4>Contacto</h4>
                <p>📍 Mall Central, San José</p>
                <p>📞 2222-3333</p>
                <p>✉ info@cineuxd.com</p>
            </div>
            <div class="footer-section">
                <h4>Horarios</h4>
                <p>Lunes a Domingo</p>
                <p>12:00 PM - 12:00 AM</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© <?= date("Y"); ?> Cine U XD - Todos los derechos reservados</p>
        </div>
    </footer>

    <script>
    let pasoActual = 1;
    let datosReserva = {
        pelicula: <?php echo $id_pelicula; ?>,
        peliculaNombre: '',
        funcion: null,
        cine: '',
        sala: '',
        horario: '',
        asientos: []
    };

    // Inicializar nombre de película
    document.addEventListener('DOMContentLoaded', function() {
        actualizarNombrePelicula();
    });

    function actualizarNombrePelicula() {
        const items = document.querySelectorAll('.pelicula-selector-item');
        items.forEach(item => {
            if (item.classList.contains('selected')) {
                datosReserva.peliculaNombre = item.querySelector('h3').textContent;
            }
        });
    }

    function cambiarPaso(direccion) {
        let nuevoPaso = pasoActual + direccion;
        if (nuevoPaso < 1 || nuevoPaso > 4) return;
        
        if (direccion > 0 && !validarPasoActual()) return;
        
        document.querySelectorAll('.paso').forEach(p => p.classList.remove('active'));
        document.getElementById(`paso${nuevoPaso}`).classList.add('active');
        
        pasoActual = nuevoPaso;
        document.getElementById('btn-anterior').disabled = pasoActual === 1;
        
        if (pasoActual === 4) {
            document.getElementById('btn-siguiente').style.display = 'none';
            actualizarResumen();
        } else {
            document.getElementById('btn-siguiente').style.display = 'block';
            if (pasoActual === 3) {
                document.getElementById('btn-siguiente').textContent = 'Ver resumen';
            } else {
                document.getElementById('btn-siguiente').textContent = 'Siguiente';
            }
        }
    }

    function validarPasoActual() {
        switch(pasoActual) {
            case 1:
                if (!datosReserva.pelicula) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona una película',
                        confirmButtonColor: '#6bc9da'
                    });
                    return false;
                }
                break;
            case 2:
                if (!datosReserva.funcion) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona un horario',
                        confirmButtonColor: '#6bc9da'
                    });
                    return false;
                }
                break;
            case 3:
                if (datosReserva.asientos.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Selecciona al menos un asiento',
                        confirmButtonColor: '#6bc9da'
                    });
                    return false;
                }
                break;
        }
        return true;
    }

    function seleccionarPelicula(id) {
        datosReserva.pelicula = id;
        document.querySelectorAll('.pelicula-selector-item').forEach(item => {
            item.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        datosReserva.peliculaNombre = event.currentTarget.querySelector('h3').textContent;
    }

    function seleccionarFuncion(id, cine, sala, horario) {
        datosReserva.funcion = id;
        datosReserva.cine = cine;
        datosReserva.sala = sala;
        datosReserva.horario = horario;
        
        document.querySelectorAll('.funcion-card').forEach(item => {
            item.classList.remove('selected');
        });
        event.currentTarget.classList.add('selected');
        
        document.getElementById('cine-seleccionado').textContent = datosReserva.cine;
        document.getElementById('sala-seleccionada').textContent = datosReserva.sala;
        document.getElementById('horario-seleccionado').textContent = datosReserva.horario;
    }

    function seleccionarAsiento(elemento) {
        if (elemento.classList.contains('ocupado')) return;
        
        if (elemento.classList.contains('seleccionado')) {
            elemento.classList.remove('seleccionado');
            datosReserva.asientos = datosReserva.asientos.filter(a => a !== elemento.dataset.asiento);
        } else {
            elemento.classList.add('seleccionado');
            datosReserva.asientos.push(elemento.dataset.asiento);
        }
    }

    function actualizarResumen() {
        const precioPorAsiento = 4500;
        const total = datosReserva.asientos.length * precioPorAsiento;
        
        // Ordenar asientos
        datosReserva.asientos.sort();
        
        document.getElementById('resumen-reserva').innerHTML = `
            <div class="resumen-item">
                <span class="resumen-label">Película:</span>
                <span class="resumen-valor">${datosReserva.peliculaNombre}</span>
            </div>
            <div class="resumen-item">
                <span class="resumen-label">Cine:</span>
                <span class="resumen-valor">${datosReserva.cine || 'No seleccionado'}</span>
            </div>
            <div class="resumen-item">
                <span class="resumen-label">Sala:</span>
                <span class="resumen-valor">${datosReserva.sala || 'No seleccionado'}</span>
            </div>
            <div class="resumen-item">
                <span class="resumen-label">Horario:</span>
                <span class="resumen-valor">${datosReserva.horario || 'No seleccionado'}</span>
            </div>
            <div class="resumen-item">
                <span class="resumen-label">Asientos:</span>
                <span class="resumen-valor">${datosReserva.asientos.join(', ') || 'Ninguno'}</span>
            </div>
            <div class="resumen-item total">
                <span class="resumen-label">Total a pagar:</span>
                <span class="resumen-valor">₡${total.toLocaleString()}</span>
            </div>
        `;
    }

    function confirmarReserva() {
        // Mensaje de éxito sin conexión a BD
        Swal.fire({
            icon: 'success',
            title: '🎉 ¡Reserva confirmada!',
            html: `
                <div style="text-align: left; padding: 10px;">
                    <p><strong>Película:</strong> ${datosReserva.peliculaNombre}</p>
                    <p><strong>Cine:</strong> ${datosReserva.cine}</p>
                    <p><strong>Sala:</strong> ${datosReserva.sala}</p>
                    <p><strong>Horario:</strong> ${datosReserva.horario}</p>
                    <p><strong>Asientos:</strong> ${datosReserva.asientos.join(', ')}</p>
                    <p><strong>Total:</strong> ₡${(datosReserva.asientos.length * 4500).toLocaleString()}</p>
                    <hr style="border-color: #6bc9da; margin: 10px 0;">
                    <p style="color: #6bc9da; font-weight: bold;">✅ Reserva #CINE-${Math.floor(Math.random() * 1000)}</p>
                </div>
            `,
            confirmButtonColor: '#6bc9da',
            confirmButtonText: 'Ver mis reservas',
            showCancelButton: true,
            cancelButtonText: 'Seguir comprando',
            cancelButtonColor: '#187bcd'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/app/views/cliente/mis-reservas.php';
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Resetear formulario
                datosReserva = {
                    pelicula: 1,
                    peliculaNombre: 'Spider-Man: No Way Home',
                    funcion: null,
                    cine: '',
                    sala: '',
                    horario: '',
                    asientos: []
                };
                window.location.href = '/app/views/cliente/reserva.php?pelicula=1';
            }
        });
        
        // Mostrar los datos en consola (solo para referencia)
        console.log('Reserva simulada:', datosReserva);
    }
    </script>
</body>
</html>