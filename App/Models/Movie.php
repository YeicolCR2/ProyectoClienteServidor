<?php
require_once dirname(__DIR__) . '/../Config/database.php';

class Movie
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // Obtener todas las películas en cartelera
    public function obtenerPeliculas()
    {
        $sql = "SELECT 
                p.id_pelicula,
                p.titulo,
                p.duracion,
                p.descripcion,
                p.fecha_estreno,
                p.estado,
                p.imagen,
                f.id_funcion,
                f.fecha,
                f.hora,
                f.id_sala
            FROM Pelicula p
            INNER JOIN Funcion f ON p.id_pelicula = f.id_pelicula
            WHERE p.estado = 'cartelera'
            ORDER BY p.id_pelicula DESC, f.hora ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Obtener TODAS las películas (para el admin)
    public function obtenerTodasPeliculas()
    {
        $sql = "SELECT * FROM Pelicula ORDER BY id_pelicula DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Obtener una película por ID
    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM Pelicula WHERE id_pelicula = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Guardar nueva película (incluye imagen)
    public function guardar($titulo, $duracion, $descripcion, $fecha_estreno, $estado, $imagen)
    {
        $sql = "INSERT INTO Pelicula (titulo, duracion, descripcion, fecha_estreno, estado, imagen)
                VALUES (:titulo, :duracion, :descripcion, :fecha_estreno, :estado, :imagen)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_estreno', $fecha_estreno);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':imagen', $imagen);
        return $stmt->execute();
    }

    // Actualizar película existente
    public function actualizar($id, $titulo, $duracion, $descripcion, $fecha_estreno, $estado, $imagen = null)
    {
        if ($imagen) {
            $sql = "UPDATE Pelicula SET titulo=:titulo, duracion=:duracion, descripcion=:descripcion,
                    fecha_estreno=:fecha_estreno, estado=:estado, imagen=:imagen WHERE id_pelicula=:id";
        } else {
            $sql = "UPDATE Pelicula SET titulo=:titulo, duracion=:duracion, descripcion=:descripcion,
                    fecha_estreno=:fecha_estreno, estado=:estado WHERE id_pelicula=:id";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_estreno', $fecha_estreno);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($imagen) {
            $stmt->bindParam(':imagen', $imagen);
        }
        return $stmt->execute();
    }

    // Eliminar película
    public function eliminar($id)
    {
        $sql = "DELETE FROM Pelicula WHERE id_pelicula = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
