<?php
class User {
    
    private $archivo_usuarios = __DIR__ . '/../../data/usuarios.json';
    
    public function __construct() {
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
        }
        return false;
    }
    
    public function emailExiste($correo) {
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
    }
    
    public function register($nombre, $correo, $password) {
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
    }
}
?>