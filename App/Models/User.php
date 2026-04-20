<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class User {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function login($correo, $password) {

        $sql = "SELECT * FROM Usuario WHERE correo = :correo AND estado = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }

        return false;
    }

    public function emailExiste($correo) {

        $sql = "SELECT * FROM Usuario WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        return $stmt->fetch() ? true : false;
    }

    public function register($nombre, $correo, $password) {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Usuario (nombre, correo, password, estado, fecha_registro, id_rol)
                VALUES (:nombre, :correo, :password, 1, NOW(), 2)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $passwordHash);

        return $stmt->execute();
    }
}