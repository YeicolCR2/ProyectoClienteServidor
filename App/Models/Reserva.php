<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class Reserva {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // 🔥 CREAR RESERVA
    public function crearReserva($id_usuario, $id_pelicula) {

        $sql = "INSERT INTO Reserva (fecha_reserva, estado, id_usuario, id_funcion)
                VALUES (NOW(), 'activa', :id_usuario, :id_funcion)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_funcion', $id_pelicula);

        return $stmt->execute();
    }

    // 🔥 OBTENER RESERVAS (ESTO ES LO QUE FALTABA)
    public function obtenerReservasPorUsuario($id_usuario) {

        $sql = "SELECT 
                    r.id_reserva,
                    r.fecha_reserva,
                    r.estado,
                    p.titulo,
                    p.descripcion
                FROM Reserva r
                INNER JOIN Pelicula p ON r.id_funcion = p.id_pelicula
                WHERE r.id_usuario = :id_usuario
                ORDER BY r.fecha_reserva DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}