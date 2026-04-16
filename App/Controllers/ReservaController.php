<?php

require_once __DIR__ . '/../Models/Reserva.php';

class ReservaController {

    // 🔥 GUARDAR RESERVA SIMPLE (compatibilidad)
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

    // 🔥 MOSTRAR ASIENTOS
    public function seleccionarAsiento() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        if (!isset($_GET['id'])) {
            exit("Función no especificada");
        }

        $id_funcion = $_GET['id'];

        $reserva = new Reserva();

        // Obtener asientos ocupados
        $ocupados = $reserva->obtenerAsientosOcupados($id_funcion);

        require __DIR__ . '/../Views/cliente/asientos.php';
    }

    // 🔥 GUARDAR RESERVA CON ASIENTO
    public function guardarConAsiento() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        if (!isset($_GET['id']) || !isset($_GET['asiento'])) {
            exit("Datos incompletos");
        }

        $id_usuario = $_SESSION['usuario']['id'];
        $id_funcion = $_GET['id'];
        $id_asiento = $_GET['asiento'];

        $reserva = new Reserva();

        if ($reserva->crearReservaConAsiento($id_usuario, $id_funcion, $id_asiento)) {
            header("Location: /public/index.php?route=reservas");
            exit;
        } else {
            exit("Error al guardar reserva con asiento");
        }
    }

    // 🔥 LISTAR RESERVAS
    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id'];

        $reserva = new Reserva();
        $reservas = $reserva->obtenerReservasPorUsuario($id_usuario);

        require __DIR__ . '/../Views/cliente/mis-reservas.php';
    }

    // 🔥 CANCELAR RESERVA (LO QUE TE FALTABA)
    public function cancelar() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        if (!isset($_GET['id'])) {
            exit("Reserva no especificada");
        }

        $id_reserva = $_GET['id'];

        $reserva = new Reserva();

        if ($reserva->eliminarReserva($id_reserva)) {
            header("Location: /public/index.php?route=reservas");
            exit;
        } else {
            exit("Error al cancelar reserva");
        }
    }
}