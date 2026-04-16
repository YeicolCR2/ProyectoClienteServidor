<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class Reserva {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function crearReserva($id_usuario, $id_pelicula) {

        $sql = "INSERT INTO Reserva (fecha_reserva, estado, id_usuario, id_funcion)
                VALUES (NOW(), 'activa', :id_usuario, :id_funcion)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_funcion', $id_pelicula);

        return $stmt->execute();
    }
}