<?php

require_once __DIR__ . '/../Models/Movie.php';

class PeliculaController {

    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: /public/index.php?route=login");
            exit;
        }

        $movieModel = new Movie();

        try {

            $peliculas = $movieModel->obtenerPeliculas() ?? [];

        } catch (Exception $e) {

            $peliculas = [];

            // opcional debug
            // echo $e->getMessage();
        }

        require __DIR__ . '/../Views/cliente/cartelera.php';
    }
}