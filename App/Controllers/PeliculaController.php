<?php

require_once __DIR__ . "/../Models/Movie.php";

class PeliculaController {

    public function index() {

        $movieModel = new Movie();
        $peliculas = $movieModel->obtenerPeliculas();

        require __DIR__ . "/../Views/cliente/cartelera.php";
    }
}