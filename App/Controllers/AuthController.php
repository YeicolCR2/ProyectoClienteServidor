<?php
session_start();

require_once __DIR__ . '/../Models/User.php';

// LOGIN
if(isset($_POST['login'])) {

    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if(empty($correo) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: /public/index.php?route=login");
        exit;
    }

    $user = new User();
    $resultado = $user->login($correo, $password);

    if($resultado) {

        $_SESSION['usuario'] = [
            "id" => $resultado['id_usuario'],
            "nombre" => $resultado['nombre'],
            "rol" => $resultado['id_rol']
        ];

        header("Location: /public/index.php?route=home");
        exit;

    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
        header("Location: /public/index.php?route=login");
        exit;
    }
}

// REGISTER
if(isset($_POST['register'])) {

    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if(empty($nombre) || empty($correo) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: /public/index.php?route=login");
        exit;
    }

    $user = new User();

    if($user->emailExiste($correo)) {
        $_SESSION['error'] = "Este correo ya está registrado.";
        header("Location: /public/index.php?route=login");
        exit;
    }

    if($user->register($nombre, $correo, $password)) {
        $_SESSION['success'] = "Usuario registrado correctamente.";
    } else {
        $_SESSION['error'] = "Error al registrar.";
    }

    header("Location: /public/index.php?route=login");
    exit;
}