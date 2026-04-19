<?php
require_once __DIR__ . '/../Models/Admin.php';

class AdminController
{
    private $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    private function validarAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
            header("Location: /public/index.php?route=home");
            exit;
        }
    }

    // ------------------------------------------------------------
    // Dashboard principal
    // ------------------------------------------------------------
    public function dashboard()
    {
        $this->validarAdmin();

        $cines = $this->adminModel->getCines();
        $salas = $this->adminModel->getSalas();
        $peliculas = $this->adminModel->getPeliculas();
        $generos = $this->adminModel->getGeneros();
        $funciones = $this->adminModel->getFunciones();
        $asientos = $this->adminModel->getAsientos();

        require_once __DIR__ . '/../Views/admin/dashboard.php';
    }

    // ------------------------------------------------------------
    // Procesamiento de imagen (privado)
    // ------------------------------------------------------------
    private function procesarImagen($archivo)
    {
        // Si no se subió archivo o hubo error
        if (!$archivo || $archivo['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $directorio = __DIR__ . '/../../Public/PIC/';
        
        // Crear directorio si no existe
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        
        // Validar tipos permitidos
        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extension, $tiposPermitidos)) {
            return null;
        }

        // Validar tamaño (por ejemplo, máximo 5MB)
        if ($archivo['size'] > 5 * 1024 * 1024) {
            return null;
        }

        // Generar nombre único
        $nombreUnico = uniqid('pelicula_') . '.' . $extension;
        $rutaDestino = $directorio . $nombreUnico;

        if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
            return $nombreUnico;
        }

        return null;
    }

    // ------------------------------------------------------------
    // Métodos de inserción (GUARDAR)
    // ------------------------------------------------------------
    public function guardarCine()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $direccion = trim($_POST['direccion'] ?? '');
            $ciudad = trim($_POST['ciudad'] ?? '');

            $this->adminModel->insertCine($nombre, $direccion, $ciudad);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarSala()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero = trim($_POST['numero'] ?? '');
            $tipo = trim($_POST['tipo'] ?? '');
            $id_cine = trim($_POST['id_cine'] ?? '');

            $this->adminModel->insertSala($numero, $tipo, $id_cine);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarPelicula()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo'] ?? '');
            $duracion = trim($_POST['duracion'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $fecha_estreno = trim($_POST['fecha_estreno'] ?? '');
            $estado = trim($_POST['estado'] ?? '');

            // Procesar imagen (si no se sube, será null y el modelo usará default.jpg)
            $imagen = $this->procesarImagen($_FILES['imagen'] ?? null);

            $this->adminModel->insertPelicula($titulo, $duracion, $descripcion, $fecha_estreno, $estado, $imagen);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarGenero()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $id_pelicula = trim($_POST['id_pelicula'] ?? '');

            $this->adminModel->insertGenero($nombre, $id_pelicula);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarFuncion()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fecha = trim($_POST['fecha'] ?? '');
            $hora = trim($_POST['hora'] ?? '');
            $precio = trim($_POST['precio'] ?? '');
            $id_pelicula = trim($_POST['id_pelicula'] ?? '');
            $id_sala = trim($_POST['id_sala'] ?? '');

            $this->adminModel->insertFuncion($fecha, $hora, $precio, $id_pelicula, $id_sala);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarAsiento()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fila = trim($_POST['fila'] ?? '');
            $numero = trim($_POST['numero'] ?? '');
            $id_sala = trim($_POST['id_sala'] ?? '');

            $this->adminModel->insertAsiento($fila, $numero, $id_sala);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    // ------------------------------------------------------------
    // Edición de película
    // ------------------------------------------------------------
    public function editarPeliculaForm()
    {
        $this->validarAdmin();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: /public/index.php?route=admin");
            exit;
        }

        $pelicula = $this->adminModel->getPeliculaById($id);
        if (!$pelicula) {
            header("Location: /public/index.php?route=admin");
            exit;
        }

        require_once __DIR__ . '/../Views/admin/editar-pelicula.php';
    }

    public function editarPelicula()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_pelicula'] ?? 0;
            $titulo = trim($_POST['titulo'] ?? '');
            $duracion = trim($_POST['duracion'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $fecha_estreno = trim($_POST['fecha_estreno'] ?? '');
            $estado = trim($_POST['estado'] ?? '');

            // Procesar nueva imagen solo si se subió un archivo
            $imagen = $this->procesarImagen($_FILES['imagen'] ?? null);

            $ok = $this->adminModel->updatePelicula($id, $titulo, $duracion, $descripcion, $fecha_estreno, $estado, $imagen);

            if ($ok) {
                header("Location: /public/index.php?route=admin&updated=1");
            } else {
                header("Location: /public/index.php?route=admin&error=1");
            }
            exit;
        }
    }

    // ------------------------------------------------------------
    // Métodos de eliminación
    // ------------------------------------------------------------
    public function eliminarCine()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_cine'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deleteCine($id);
                $param = $ok ? 'deleted=1' : 'error=1';
                header("Location: /public/index.php?route=admin&$param");
                exit;
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }

    public function eliminarSala()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_sala'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deleteSala($id);
                $param = $ok ? 'deleted=1' : 'error=1';
                header("Location: /public/index.php?route=admin&$param");
                exit;
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }

    public function eliminarPelicula()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_pelicula'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deletePelicula($id);
                $param = $ok ? 'deleted=1' : 'error=1';
                header("Location: /public/index.php?route=admin&$param");
                exit;
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }

    public function eliminarGenero()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_genero'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deleteGenero($id);
                $param = $ok ? 'deleted=1' : 'error=1';
                header("Location: /public/index.php?route=admin&$param");
                exit;
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }

    public function eliminarFuncion()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_funcion'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deleteFuncion($id);
                $param = $ok ? 'deleted=1' : 'error=1';
                header("Location: /public/index.php?route=admin&$param");
                exit;
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }

    public function eliminarAsiento()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_asiento'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deleteAsiento($id);
                $param = $ok ? 'deleted=1' : 'error=1';
                header("Location: /public/index.php?route=admin&$param");
                exit;
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }
}