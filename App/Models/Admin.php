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

    // ------------------------------------------------------------
    // Métodos de consulta (GET)
    // ------------------------------------------------------------
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

    public function getPeliculaById($id)
    {
        $sql = "SELECT * FROM Pelicula WHERE id_pelicula = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
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

    // ------------------------------------------------------------
    // Métodos de inserción (INSERT)
    // ------------------------------------------------------------
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

    public function insertPelicula($titulo, $duracion, $descripcion, $fecha_estreno, $estado, $imagen = null)
    {
        // Si no se proporciona imagen, usar default.jpg
        $imagen = $imagen ?? 'default.jpg';
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

    // ------------------------------------------------------------
    // Método de actualización (UPDATE) para Película
    // ------------------------------------------------------------
    public function updatePelicula($id, $titulo, $duracion, $descripcion, $fecha_estreno, $estado, $imagen = null)
    {
        if ($imagen !== null) {
            // Si se proporciona una nueva imagen, la actualizamos
            $sql = "UPDATE Pelicula SET 
                    titulo = :titulo,
                    duracion = :duracion,
                    descripcion = :descripcion,
                    fecha_estreno = :fecha_estreno,
                    estado = :estado,
                    imagen = :imagen
                    WHERE id_pelicula = :id";
        } else {
            // Si no hay nueva imagen, no modificamos el campo imagen
            $sql = "UPDATE Pelicula SET 
                    titulo = :titulo,
                    duracion = :duracion,
                    descripcion = :descripcion,
                    fecha_estreno = :fecha_estreno,
                    estado = :estado
                    WHERE id_pelicula = :id";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_estreno', $fecha_estreno);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($imagen !== null) {
            $stmt->bindParam(':imagen', $imagen);
        }
        return $stmt->execute();
    }

    // ------------------------------------------------------------
    // Métodos de eliminación (DELETE)
    // ------------------------------------------------------------
    public function deleteCine($id)
    {
        try {
            $this->conn->beginTransaction();

            // Eliminar asientos de salas que pertenecen al cine
            $sqlAsientos = "DELETE a
                        FROM Asiento a
                        INNER JOIN Sala s ON a.id_sala = s.id_sala
                        WHERE s.id_cine = :id";
            $stmtAsientos = $this->conn->prepare($sqlAsientos);
            $stmtAsientos->bindParam(':id', $id);
            $stmtAsientos->execute();

            // Eliminar funciones de salas que pertenecen al cine
            $sqlFunciones = "DELETE f
                         FROM Funcion f
                         INNER JOIN Sala s ON f.id_sala = s.id_sala
                         WHERE s.id_cine = :id";
            $stmtFunciones = $this->conn->prepare($sqlFunciones);
            $stmtFunciones->bindParam(':id', $id);
            $stmtFunciones->execute();

            // Eliminar salas del cine
            $sqlSalas = "DELETE FROM Sala WHERE id_cine = :id";
            $stmtSalas = $this->conn->prepare($sqlSalas);
            $stmtSalas->bindParam(':id', $id);
            $stmtSalas->execute();

            // Eliminar cine
            $sqlCine = "DELETE FROM Cine WHERE id_cine = :id";
            $stmtCine = $this->conn->prepare($sqlCine);
            $stmtCine->bindParam(':id', $id);
            $stmtCine->execute();

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function deleteSala($id)
    {
        try {
            $this->conn->beginTransaction();

            // Eliminar asientos de la sala
            $sqlAsientos = "DELETE FROM Asiento WHERE id_sala = :id";
            $stmtAsientos = $this->conn->prepare($sqlAsientos);
            $stmtAsientos->bindParam(':id', $id);
            $stmtAsientos->execute();

            // Eliminar funciones de la sala
            $sqlFunciones = "DELETE FROM Funcion WHERE id_sala = :id";
            $stmtFunciones = $this->conn->prepare($sqlFunciones);
            $stmtFunciones->bindParam(':id', $id);
            $stmtFunciones->execute();

            // Eliminar sala
            $sqlSala = "DELETE FROM Sala WHERE id_sala = :id";
            $stmtSala = $this->conn->prepare($sqlSala);
            $stmtSala->bindParam(':id', $id);
            $stmtSala->execute();

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function deletePelicula($id)
    {
        try {
            $this->conn->beginTransaction();

            // Eliminar géneros de la película
            $sqlGeneros = "DELETE FROM Genero WHERE id_pelicula = :id";
            $stmtGeneros = $this->conn->prepare($sqlGeneros);
            $stmtGeneros->bindParam(':id', $id);
            $stmtGeneros->execute();

            // Eliminar funciones de la película
            $sqlFunciones = "DELETE FROM Funcion WHERE id_pelicula = :id";
            $stmtFunciones = $this->conn->prepare($sqlFunciones);
            $stmtFunciones->bindParam(':id', $id);
            $stmtFunciones->execute();

            // Eliminar película
            $sqlPelicula = "DELETE FROM Pelicula WHERE id_pelicula = :id";
            $stmtPelicula = $this->conn->prepare($sqlPelicula);
            $stmtPelicula->bindParam(':id', $id);
            $stmtPelicula->execute();

            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function deleteGenero($id)
    {
        try {
            $sql = "DELETE FROM Genero WHERE id_genero = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteFuncion($id)
    {
        try {
            $sql = "DELETE FROM Funcion WHERE id_funcion = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteAsiento($id)
    {
        try {
            $sql = "DELETE FROM Asiento WHERE id_asiento = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
