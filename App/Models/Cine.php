<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class Cine
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM Cine ORDER BY id_cine DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}