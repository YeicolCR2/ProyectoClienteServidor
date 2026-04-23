<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/index.php?route=login");
    exit;
}

// ID de película (opcional)
$id_pelicula = $_GET['id'] ?? 1;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reserva - Cine U XD</title>

    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">
    <link rel="stylesheet" href="/public/css/reserva.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

<header class="main-header">
    <div class="header-container">

        <a href="/public/index.php?route=home" class="logo">
            CINE U XD
        </a>

        <nav class="main-nav">
            <ul>
                <li><a href="/public/index.php?route=home">INICIO</a></li>
                <li><a href="/public/index.php?route=cartelera">CARTELERA</a></li>
                <li><a href="/public/index.php?route=cines">CINES</a></li>
                <li><a href="/public/index.php?route=contacto">CONTACTO</a></li>
                <li><a href="/public/index.php?route=reservas">MIS RESERVAS</a></li>
            </ul>
        </nav>

        <div class="user-menu">
            <span>👤 <?php echo $_SESSION['usuario']['nombre']; ?></span>
            <a href="/public/index.php?route=logout" class="btn-logout">
                CERRAR SESIÓN
            </a>
        </div>

    </div>
</header>

<main style="padding:40px;">

    <h1 style="text-align:center;">🎫 REALIZAR RESERVA</h1>

    <!-- PASO 1 -->
    <h2>Selecciona película</h2>

    <div onclick="seleccionarPelicula(1)">Avengers</div>
    <div onclick="seleccionarPelicula(2)">Batman</div>
    <div onclick="seleccionarPelicula(3)">Interstellar</div>

    <hr>

    <!-- PASO 2 -->
    <h2>Selecciona función</h2>

    <button onclick="seleccionarFuncion(1)">Función 1</button>
    <button onclick="seleccionarFuncion(2)">Función 2</button>

    <hr>

    <!-- PASO 3 -->
    <h2>Selecciona asiento</h2>

    <button onclick="seleccionarAsiento('A1')">A1</button>
    <button onclick="seleccionarAsiento('A2')">A2</button>
    <button onclick="seleccionarAsiento('A3')">A3</button>

    <hr>

    <!-- PASO FINAL -->
    <button onclick="procesarPago()" style="padding:10px 20px;">
        CONFIRMAR RESERVA
    </button>

</main>

<script>
let datosReserva = {
    peliculaId: <?php echo $id_pelicula; ?>,
    funcionId: null,
    asiento: null
};

function seleccionarPelicula(id) {
    datosReserva.peliculaId = id;
    alert("Película seleccionada: " + id);
}

function seleccionarFuncion(id) {
    datosReserva.funcionId = id;
    alert("Función seleccionada: " + id);
}

function seleccionarAsiento(asiento) {
    datosReserva.asiento = asiento;
    alert("Asiento: " + asiento);
}

function procesarPago() {

    if (!datosReserva.funcionId || !datosReserva.asiento) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Debes seleccionar función y asiento'
        });
        return;
    }

    window.location.href =
        "/public/index.php?route=reserva&id=" +
        datosReserva.peliculaId +
        "&funcion=" + datosReserva.funcionId +
        "&asiento=" + datosReserva.asiento;
}
</script>

</body>
</html>