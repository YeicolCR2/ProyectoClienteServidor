<?php
session_start();
require_once __DIR__ . '/../models/User.php';

// Login
if(isset($_POST['login'])) {
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if(empty($correo) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: /app/views/auth/login.php");
        exit;
    }

    $user = new User();
    $resultado = $user->login($correo, $password);

    if($resultado) {
        $_SESSION['usuario'] = [
            "id" => $resultado['id'],
            "nombre" => $resultado['nombre'],
            "rol" => $resultado['rol']
        ];

        header("Location: /app/views/cliente/home.php");
        exit;
    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
        header("Location: /app/views/auth/login.php");
        exit;
    }
}

// Registro
if(isset($_POST['register'])) {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);
    
    if(empty($nombre) || empty($correo) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: /app/views/auth/login.php");
        exit;
    }
    
    $user = new User();
    
    if($user->emailExiste($correo)) {
        $_SESSION['error'] = "Este correo ya está registrado.";
        header("Location: /app/views/auth/login.php");
        exit;
    }
    
    $registro = $user->register($nombre, $correo, $password);
    
    if($registro) {
        $_SESSION['registro_exitoso'] = [
            'nombre' => $nombre,
            'correo' => $correo
        ];
        header("Location: /app/views/auth/login.php");
    } else {
        $_SESSION['error'] = "Error al registrar. Intenta de nuevo.";
        header("Location: /app/views/auth/login.php");
    }
    exit;
}

header("Location: /app/views/auth/login.php");
exit;
?>