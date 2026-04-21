<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class Reserva
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();

        // 🔥 IMPORTANTE: activar errores PDO
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // 🔥 CREAR RESERVA SIMPLE
    public function crearReserva($id_usuario, $id_funcion)
    {

        $sql = "INSERT INTO Reserva (fecha_reserva, estado, id_usuario, id_funcion)
                VALUES (NOW(), 'activa', :id_usuario, :id_funcion)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_funcion', $id_funcion);

        return $stmt->execute();
    }

    // 🔥 CREAR RESERVA + ASIENTO (PRO)
    public function crearReservaConAsiento($id_usuario, $id_funcion, $id_asiento)
    {
        try {

            $this->conn->beginTransaction();

            // 1. Crear reserva
            $sql = "INSERT INTO Reserva (fecha_reserva, estado, id_usuario, id_funcion)
                    VALUES (NOW(), 'activa', :id_usuario, :id_funcion)";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':id_funcion', $id_funcion);
            $stmt->execute();

            // 2. Obtener ID generado
            $id_reserva = $this->conn->lastInsertId();

            // 3. Guardar asiento
            $sql2 = "INSERT INTO Reserva_Asiento (id_reserva, id_asiento, id_funcion)
                     VALUES (:id_reserva, :id_asiento, :id_funcion)";

            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bindParam(':id_reserva', $id_reserva);
            $stmt2->bindParam(':id_asiento', $id_asiento);
            $stmt2->bindParam(':id_funcion', $id_funcion);
            $stmt2->execute();

            $this->conn->commit();

            return true;
        } catch (Exception $e) {

            $this->conn->rollBack();
            exit("Error SQL: " . $e->getMessage());
        }
    }

    // 🔥 OBTENER RESERVAS DEL USUARIO
    public function obtenerReservasPorUsuario($id_usuario)
    {

        $sql = "SELECT 
                r.id_reserva,
                r.fecha_reserva,
                r.estado,
                p.titulo,
                p.descripcion
            FROM Reserva r
            INNER JOIN Funcion f ON r.id_funcion = f.id_funcion
            INNER JOIN Pelicula p ON f.id_pelicula = p.id_pelicula
            WHERE r.id_usuario = :id_usuario
            ORDER BY r.fecha_reserva DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔥 OBTENER SOLO IDs DE ASIENTOS OCUPADOS (MEJORADO)
    public function obtenerAsientosOcupados($id_funcion)
    {
        $sql = "SELECT id_asiento FROM Reserva_Asiento WHERE id_funcion = :id_funcion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcion', $id_funcion);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    // 🔥 ELIMINAR RESERVA (CON INTEGRIDAD REFERENCIAL)
    public function eliminarReserva($id_reserva)
    {
        try {

            $this->conn->beginTransaction();

            // 1. Eliminar asientos primero (FK)
            $sql1 = "DELETE FROM Reserva_Asiento WHERE id_reserva = :id_reserva";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->bindParam(':id_reserva', $id_reserva);
            $stmt1->execute();

            // 2. Eliminar reserva
            $sql2 = "DELETE FROM Reserva WHERE id_reserva = :id_reserva";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->bindParam(':id_reserva', $id_reserva);
            $stmt2->execute();

            $this->conn->commit();

            return true;
        } catch (Exception $e) {

            $this->conn->rollBack();

            // 🔥 opcional debug
            // echo $e->getMessage();

            return false;
        }
    }

    public function obtenerSalaPorFuncion($id_funcion)
    {

        $sql = "SELECT id_sala FROM Funcion WHERE id_funcion = :id_funcion";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_funcion', $id_funcion);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
    public function obtenerAsientosPorSala($id_sala)
    {

        $sql = "SELECT id_asiento, numero FROM Asiento WHERE id_sala = :id_sala";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_sala', $id_sala);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
