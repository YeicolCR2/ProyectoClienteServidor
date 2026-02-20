<?php

class Database {

    private $host = "cine_db";
    private $db_name = "db_cine";
    private $username = "root";
    private $password = "root";
    public $conn;

    public function conectar() {

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo "Conectado correctamente 🚀";

        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}
