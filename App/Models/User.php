<?php

require_once dirname(__DIR__) . '/../Config/database.php';

class User {

    private $conn;

    public function __construct() {
<<<<<<< HEAD
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $carpeta_data = __DIR__ . '/../../data';
        if (!file_exists($carpeta_data)) {
            mkdir($carpeta_data, 0777, true);
        }
    }
    
    private function getUsuarios() {
        if (!file_exists($this->archivo_usuarios)) {
            return [];
        }
        
        $contenido = file_get_contents($this->archivo_usuarios);
        if ($contenido === false) {
            return [];
        }
        
        $usuarios = json_decode($contenido, true);
        if (!is_array($usuarios)) {
            return [];
        }
        
        return $usuarios;
    }
    
    private function guardarUsuarios($usuarios) {
        if (!is_array($usuarios)) {
            $usuarios = [];
        }
        file_put_contents($this->archivo_usuarios, json_encode($usuarios, JSON_PRETTY_PRINT));
    }
    
    public function login($correo, $password) {
        $usuarios = $this->getUsuarios();
        
        if (empty($usuarios) || !is_array($usuarios)) {
            return false;
        }
        
        foreach($usuarios as $usuario) {
            if($usuario['correo'] === $correo && password_verify($password, $usuario['password'])) {
                return $usuario;
            }
=======
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
>>>>>>> Alejandro
        }

        return false;
    }

    public function emailExiste($correo) {
<<<<<<< HEAD
        $usuarios = $this->getUsuarios();
        
        if (empty($usuarios) || !is_array($usuarios)) {
            return false;
        }
        
        foreach($usuarios as $usuario) {
            if($usuario['correo'] === $correo) {
                return true;
            }
        }
        return false;
=======

        $sql = "SELECT * FROM Usuario WHERE correo = :correo";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        return $stmt->fetch() ? true : false;
>>>>>>> Alejandro
    }

    public function register($nombre, $correo, $password) {
<<<<<<< HEAD
        if($this->emailExiste($correo)) {
            return false;
        }
        
        $usuarios = $this->getUsuarios();
        
        if (!is_array($usuarios)) {
            $usuarios = [];
        }
        
        $nuevo_id = 1;
        if (!empty($usuarios)) {
            $ids = array_column($usuarios, 'id');
            if (!empty($ids)) {
                $nuevo_id = max($ids) + 1;
            }
        }
        
        $nuevo_usuario = [
            'id' => $nuevo_id,
            'nombre' => $nombre,
            'correo' => $correo,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'rol' => 'cliente'
        ];
        
        $usuarios[] = $nuevo_usuario;
        $this->guardarUsuarios($usuarios);
        
        return true;
=======

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Usuario (nombre, correo, password, estado, fecha_registro, id_rol)
                VALUES (:nombre, :correo, :password, 1, NOW(), 2)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':password', $passwordHash);

        return $stmt->execute();
>>>>>>> Alejandro
    }
}