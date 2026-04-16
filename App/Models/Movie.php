<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class Movie {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function obtenerPeliculas() {

        try {
            $sql = "SELECT * FROM Pelicula WHERE estado = 'cartelera'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch (PDOException $e) {
            die("❌ Error en consulta: " . $e->getMessage());
        }
    }
}