<?php

require_once __DIR__ . '/../Models/Movie.php';

class PeliculaController {

    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $movieModel = new Movie();

        // 🔥 SIEMPRE inicializamos
        $peliculas = [];

        $resultado = $movieModel->obtenerPeliculas();

        if ($resultado) {
            $peliculas = $resultado;
        }

        require __DIR__ . '/../Views/cliente/cartelera.php';
    }
}