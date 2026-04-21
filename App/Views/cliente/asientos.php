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
        <?php foreach ($asientos as $asiento):
            $esOcupado = in_array($asiento['id_asiento'], $ocupados);
        ?>
            <div
                class="asiento <?php echo $esOcupado ? 'ocupado' : 'disponible'; ?>"
                data-id="<?php echo $asiento['id_asiento']; ?>"
                onclick="seleccionarAsiento(this)">
                <?php echo $asiento['numero']; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="btn-confirmar" onclick="confirmarReserva()">
        Confirmar Reserva
    </button>

    <script>
        let asientoSeleccionado = null;
        let funcionId = <?php echo isset($id_funcion) ? json_encode($id_funcion) : 'null'; ?>;

        function seleccionarAsiento(elemento) {
            if (elemento.classList.contains('ocupado')) return;

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

            if (funcionId === null) {
                alert("Error: función inválida");
                return;
            }

            const url = "/public/index.php?route=guardar_reserva&id=" +
                encodeURIComponent(funcionId) +
                "&asiento=" +
                encodeURIComponent(asientoSeleccionado);
            alert("Función: " + funcionId + " | Asiento: " + asientoSeleccionado);
            window.location.href = url;
        }
    </script>

</body>

</html>