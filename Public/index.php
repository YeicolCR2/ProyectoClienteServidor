<?php
session_start();

// Obtener la ruta (por defecto: home)
$route = $_GET['route'] ?? 'home';

// 🔥 Rutas públicas (NO requieren login)
$rutas_publicas = ['login'];

// Si NO hay sesión y no es ruta pública → forzar login
if (!isset($_SESSION['usuario']) && !in_array($route, $rutas_publicas)) {
    require_once __DIR__ . '/../App/Views/auth/login.php';
    exit;
}

// Router principal MVC
switch ($route) {

    // 🔹 CLIENTE
    case 'home':
        require_once __DIR__ . '/../App/Views/cliente/home.php';
        break;

    case 'cartelera':
        require_once __DIR__ . '/../App/Controllers/PeliculaController.php';
        $controller = new PeliculaController();
        $controller->index();
        break;

    case 'cines':
        require_once __DIR__ . '/../App/Controllers/CineController.php';
        $controller = new CineController();
        $controller->index();
        break;

    case 'contacto':
        require_once __DIR__ . '/../App/Views/cliente/contacto.php';
        break;

    // 🔹 RESERVAS
    case 'reserva':
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->guardar();
        break;

    case 'reservas':
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->index();
        break;

    case 'asientos':
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->seleccionarAsiento();
        break;

    case 'guardar_reserva':
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->guardarConAsiento();
        break;

    // 🔥 NUEVO: CANCELAR RESERVA
    case 'cancelar_reserva':
        require_once __DIR__ . '/../App/Controllers/ReservaController.php';
        $controller = new ReservaController();
        $controller->cancelar();
        break;

    // 🔹 AUTH
    case 'login':
        require_once __DIR__ . '/../App/Views/auth/login.php';
        break;

    case 'logout':
        session_destroy();
        header("Location: /public/index.php?route=login");
        exit;

        // 🔹 ADMIN
    case 'admin':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->dashboard();
        break;

    case 'guardar-cine':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->guardarCine();
        break;

    case 'guardar-sala':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->guardarSala();
        break;

    case 'guardar-pelicula':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->guardarPelicula();
        break;

    case 'guardar-genero':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->guardarGenero();
        break;

    case 'guardar-funcion':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->guardarFuncion();
        break;

    case 'guardar-asiento':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->guardarAsiento();
        break;
    case 'eliminar-cine':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarCine();
        break;

    case 'eliminar-sala':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarSala();
        break;

    case 'eliminar-pelicula':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarPelicula();
        break;

    case 'editar-pelicula-form':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->editarPeliculaForm();
        break;
    case 'editar-pelicula':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->editarPelicula();
        break;

    case 'eliminar-genero':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarGenero();
        break;

    case 'eliminar-funcion':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarFuncion();
        break;

    case 'eliminar-asiento':
        require_once __DIR__ . '/../App/Controllers/AdminController.php';
        $controller = new AdminController();
        $controller->eliminarAsiento();
        break;

    // 🔴 DEFAULT
    default:
        echo "<h1>404 - Página no encontrada</h1>";
        break;
}
