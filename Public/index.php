<?php
session_start();

// Obtener la ruta (por defecto: home)
$route = $_GET['route'] ?? 'home';

// Si NO hay sesión y no está en login → forzar login
if (!isset($_SESSION['usuario']) && $route !== 'login') {
    require_once __DIR__ . '/../App/Views/auth/login.php';
    exit;
}

// Router principal MVC
switch ($route) {

    case 'home':
        require_once __DIR__ . '/../App/Views/cliente/home.php';
        break;

    case 'cartelera':
        require_once __DIR__ . '/../App/Controllers/PeliculaController.php';
        $controller = new PeliculaController();
        $controller->index();
        break;

    case 'cines':
        require_once __DIR__ . '/../App/Views/cliente/cines.php';
        break;

    case 'contacto':
        require_once __DIR__ . '/../App/Views/cliente/contacto.php';
        break;

    case 'reserva': // 🔥 ESTE DEBE IR ANTES DEL DEFAULT
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->guardar();
        break;

    case 'reservas':
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->index();
        break;

    case 'login':
        require_once __DIR__ . '/../App/Views/auth/login.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: /public/index.php?route=login");
        exit;

    default:
        echo "<h1>404 - Página no encontrada</h1>";
        break;
}