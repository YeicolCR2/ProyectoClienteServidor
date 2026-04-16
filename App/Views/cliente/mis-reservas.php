<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/../Models/Reserva.php';
require_once dirname(__DIR__) . '/../Config/database.php';

$db = new Database();
$conn = $db->conectar();

$id_usuario = $_SESSION['usuario']['id'];

$sql = "SELECT * FROM Reserva WHERE id_usuario = :id_usuario";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->execute();

$reservas = $stmt->fetchAll();
?>

<h1>Mis Reservas</h1>

<?php foreach($reservas as $r): ?>
    <div>
        <p>Reserva #<?php echo $r['id_reserva']; ?></p>
        <p>Película ID: <?php echo $r['id_funcion']; ?></p>
        <p>Fecha: <?php echo $r['fecha_reserva']; ?></p>
        <hr>
    </div>
<?php endforeach; ?>