<?php

require_once __DIR__ . "/../../Config/database.php";

class Movie {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function obtenerPeliculas() {

        $sql = "SELECT * FROM Pelicula WHERE estado = 'cartelera'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}