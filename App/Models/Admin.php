<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class Admin
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function getCines()
    {
        $sql = "SELECT * FROM Cine ORDER BY id_cine DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getSalas()
    {
        $sql = "SELECT s.*, c.nombre AS cine_nombre
                FROM Sala s
                INNER JOIN Cine c ON s.id_cine = c.id_cine
                ORDER BY s.id_sala DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPeliculas()
    {
        $sql = "SELECT * FROM Pelicula ORDER BY id_pelicula DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getGeneros()
    {
        $sql = "SELECT g.*, p.titulo AS pelicula_titulo
                FROM Genero g
                INNER JOIN Pelicula p ON g.id_pelicula = p.id_pelicula
                ORDER BY g.id_genero DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getFunciones()
    {
        $sql = "SELECT f.*, p.titulo AS pelicula_titulo, s.numero AS sala_numero
                FROM Funcion f
                INNER JOIN Pelicula p ON f.id_pelicula = p.id_pelicula
                INNER JOIN Sala s ON f.id_sala = s.id_sala
                ORDER BY f.id_funcion DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAsientos()
    {
        $sql = "SELECT a.*, s.numero AS sala_numero
                FROM Asiento a
                INNER JOIN Sala s ON a.id_sala = s.id_sala
                ORDER BY a.id_asiento DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insertCine($nombre, $direccion, $ciudad)
    {
        $sql = "INSERT INTO Cine (nombre, direccion, ciudad)
                VALUES (:nombre, :direccion, :ciudad)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':ciudad', $ciudad);
        return $stmt->execute();
    }

    public function insertSala($numero, $tipo, $id_cine)
    {
        $sql = "INSERT INTO Sala (numero, tipo, id_cine)
                VALUES (:numero, :tipo, :id_cine)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':id_cine', $id_cine);
        return $stmt->execute();
    }

    public function insertPelicula($titulo, $duracion, $descripcion, $fecha_estreno, $estado)
    {
        $sql = "INSERT INTO Pelicula (titulo, duracion, descripcion, fecha_estreno, estado)
                VALUES (:titulo, :duracion, :descripcion, :fecha_estreno, :estado)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_estreno', $fecha_estreno);
        $stmt->bindParam(':estado', $estado);
        return $stmt->execute();
    }

    public function insertGenero($nombre, $id_pelicula)
    {
        $sql = "INSERT INTO Genero (nombre, id_pelicula)
                VALUES (:nombre, :id_pelicula)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id_pelicula', $id_pelicula);
        return $stmt->execute();
    }

    public function insertFuncion($fecha, $hora, $precio, $id_pelicula, $id_sala)
    {
        $sql = "INSERT INTO Funcion (fecha, hora, precio, id_pelicula, id_sala)
                VALUES (:fecha, :hora, :precio, :id_pelicula, :id_sala)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora', $hora);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':id_pelicula', $id_pelicula);
        $stmt->bindParam(':id_sala', $id_sala);
        return $stmt->execute();
    }

    public function insertAsiento($fila, $numero, $id_sala)
    {
        $sql = "INSERT INTO Asiento (fila, numero, id_sala)
                VALUES (:fila, :numero, :id_sala)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':fila', $fila);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':id_sala', $id_sala);
        return $stmt->execute();
    }
}