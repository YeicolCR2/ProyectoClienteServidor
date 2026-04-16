<?php

require_once __DIR__ . '/../Models/Reserva.php';

class ReservaController {

    public function guardar() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        if (!isset($_GET['id'])) {
            exit("Película no especificada");
        }

        $id_pelicula = $_GET['id'];
        $id_usuario = $_SESSION['usuario']['id'];

        $reserva = new Reserva();

        if ($reserva->crearReserva($id_usuario, $id_pelicula)) {

            header("Location: /public/index.php?route=reservas");
            exit;

        } else {
            exit("Error al guardar reserva");
        }
    }

    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id'];

        // 🔥 AQUÍ USAMOS EL MODEL (NO DATABASE DIRECTO)
        $reserva = new Reserva();
        $reservas = $reserva->obtenerReservasPorUsuario($id_usuario);

        require __DIR__ . '/../Views/cliente/mis-reservas.php';
    }
}