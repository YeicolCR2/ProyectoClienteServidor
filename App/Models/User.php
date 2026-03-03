<?php
class User {
    
    private $archivo_usuarios = __DIR__ . '/../../data/usuarios.json';
    
    public function __construct() {
        // Crear carpeta data si no existe
        $carpeta_data = __DIR__ . '/../../data';
        if (!file_exists($carpeta_data)) {
            mkdir($carpeta_data, 0777, true);
        }
        
        // Crear archivo de usuarios si no existe
        if (!file_exists($this->archivo_usuarios)) {
            $usuarios_iniciales = [
                [
                    'id' => 1,
                    'nombre' => 'Administrador',
                    'correo' => 'admin@cine.com',
                    'password' => password_hash('admin123', PASSWORD_DEFAULT),
                    'rol' => 'admin'
                ],
                [
                    'id' => 2,
                    'nombre' => 'Samuel Sandoval',
                    'correo' => 'samu02@gmail.com',
                    'password' => password_hash('Samuel123', PASSWORD_DEFAULT),
                    'rol' => 'cliente'
                ]
            ];
            file_put_contents($this->archivo_usuarios, json_encode($usuarios_iniciales, JSON_PRETTY_PRINT));
        }
    }
    
    private function getUsuarios() {
        $contenido = file_get_contents($this->archivo_usuarios);
        return json_decode($contenido, true);
    }
    
    private function guardarUsuarios($usuarios) {
        file_put_contents($this->archivo_usuarios, json_encode($usuarios, JSON_PRETTY_PRINT));
    }
    
    public function login($correo, $password) {
        $usuarios = $this->getUsuarios();
        
        foreach($usuarios as $usuario) {
            if($usuario['correo'] === $correo && password_verify($password, $usuario['password'])) {
                return $usuario;
            }
        }
        
        return false;
    }
    
    public function emailExiste($correo) {
        $usuarios = $this->getUsuarios();
        
        foreach($usuarios as $usuario) {
            if($usuario['correo'] === $correo) {
                return true;
            }
        }
        return false;
    }
    
    public function register($nombre, $correo, $password) {
        // Verificar si el correo ya existe
        if($this->emailExiste($correo)) {
            return false;
        }
        
        $usuarios = $this->getUsuarios();
        
        // Crear nuevo usuario
        $nuevo_usuario = [
            'id' => count($usuarios) + 1,
            'nombre' => $nombre,
            'correo' => $correo,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'rol' => 'cliente'
        ];
        
        // Agregar a la lista
        $usuarios[] = $nuevo_usuario;
        
        // Guardar en archivo
        $this->guardarUsuarios($usuarios);
        
        return true;
    }
}
?>