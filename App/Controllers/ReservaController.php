<?php
session_start();

require_once __DIR__ . '/../Models/Reserva.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: /public/index.php?route=login");
    exit;
}

if (isset($_GET['id'])) {

    $id_pelicula = $_GET['id'];
    $id_usuario = $_SESSION['usuario']['id'];

    $reserva = new Reserva();

    if ($reserva->crearReserva($id_usuario, $id_pelicula)) {
        header("Location: /public/index.php?route=reservas");
    } else {
        echo "Error al crear reserva";
    }

} else {
    echo "Película no especificada";
}