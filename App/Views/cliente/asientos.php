<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/index.php?route=login");
    exit;
}

// Convertimos a array simple si viene de BD
$ocupados = $ocupados ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Asientos</title>

    <link rel="stylesheet" href="/public/css/base.css">
    <link rel="stylesheet" href="/public/css/cliente.css">

    <style>
        .sala {
            display: grid;
            grid-template-columns: repeat(8, 50px);
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }

        .asiento {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            text-align: center;
            line-height: 50px;
            cursor: pointer;
            font-weight: bold;
        }

        .disponible {
            background-color: #2ecc71;
        }

        .ocupado {
            background-color: #e74c3c;
            cursor: not-allowed;
        }

        .seleccionado {
            background-color: #3498db;
        }

        .pantalla {
            text-align: center;
            margin: 20px;
            font-weight: bold;
        }

        .btn-confirmar {
            display: block;
            margin: 30px auto;
            padding: 10px 20px;
            background: #6c5ce7;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

<h1 style="text-align:center;">🎟️ Selecciona tu asiento</h1>

<div class="pantalla">🎬 PANTALLA</div>

<div class="sala">
    <?php
    // Generamos 32 asientos (4 filas x 8)
    for ($i = 1; $i <= 32; $i++):
        $esOcupado = in_array($i, $ocupados);
    ?>
        <div 
            class="asiento <?php echo $esOcupado ? 'ocupado' : 'disponible'; ?>"
            data-id="<?php echo $i; ?>"
            onclick="seleccionarAsiento(this)"
        >
            <?php echo $i; ?>
        </div>
    <?php endfor; ?>
</div>

<button class="btn-confirmar" onclick="confirmarReserva()">
    Confirmar Reserva
</button>

<script>
let asientoSeleccionado = null;
let funcionId = <?php echo $id_funcion; ?>;

function seleccionarAsiento(elemento) {

    if (elemento.classList.contains('ocupado')) return;

    // limpiar selección previa
    document.querySelectorAll('.asiento').forEach(a => {
        a.classList.remove('seleccionado');
    });

    elemento.classList.add('seleccionado');

    asientoSeleccionado = elemento.dataset.id;
}

function confirmarReserva() {

    if (!asientoSeleccionado) {
        alert("Selecciona un asiento");
        return;
    }

    window.location.href =
        "/public/index.php?route=guardar_reserva&id=" +
        funcionId +
        "&asiento=" + asientoSeleccionado;
}
</script>

</body>
</html>