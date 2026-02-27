<?php
session_start();
require_once __DIR__ . '/../models/User.php'; //importamos el modelo de usuario para manejar la autenticación

if(isset($_POST['login'])) {

    $correo = trim($_POST['correo']);
    $password = trim($_POST['password']);

    if(empty($correo) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: ../../app/views/auth/login.php");
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

        if($resultado['rol'] === 'admin') {
            header("Location: ../../app/views/admin/dashboard.php");
        } else {
            header("Location: ../../app/views/cliente/home.php");
        }

    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
        header("Location: ../../app/views/auth/login.php");
    }
}