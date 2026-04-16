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
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 1) {
            header("Location: /public/index.php?route=home");
            exit;
        }
    }

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

    public function guardarCine()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $direccion = trim($_POST['direccion']);
            $ciudad = trim($_POST['ciudad']);

            $this->adminModel->insertCine($nombre, $direccion, $ciudad);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarSala()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero = trim($_POST['numero']);
            $tipo = trim($_POST['tipo']);
            $id_cine = trim($_POST['id_cine']);

            $this->adminModel->insertSala($numero, $tipo, $id_cine);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarPelicula()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = trim($_POST['titulo']);
            $duracion = trim($_POST['duracion']);
            $descripcion = trim($_POST['descripcion']);
            $fecha_estreno = trim($_POST['fecha_estreno']);
            $estado = trim($_POST['estado']);

            $this->adminModel->insertPelicula($titulo, $duracion, $descripcion, $fecha_estreno, $estado);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarGenero()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $id_pelicula = trim($_POST['id_pelicula']);

            $this->adminModel->insertGenero($nombre, $id_pelicula);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarFuncion()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fecha = trim($_POST['fecha']);
            $hora = trim($_POST['hora']);
            $precio = trim($_POST['precio']);
            $id_pelicula = trim($_POST['id_pelicula']);
            $id_sala = trim($_POST['id_sala']);

            $this->adminModel->insertFuncion($fecha, $hora, $precio, $id_pelicula, $id_sala);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function guardarAsiento()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fila = trim($_POST['fila']);
            $numero = trim($_POST['numero']);
            $id_sala = trim($_POST['id_sala']);

            $this->adminModel->insertAsiento($fila, $numero, $id_sala);
            header("Location: /public/index.php?route=admin&success=1");
            exit;
        }
    }

    public function eliminarCine()
    {
        $this->validarAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_cine'] ?? null;

            if ($id) {
                $ok = $this->adminModel->deleteCine($id);

                if ($ok) {
                    header("Location: /public/index.php?route=admin&deleted=1");
                    exit;
                } else {
                    header("Location: /public/index.php?route=admin&error=1");
                    exit;
                }
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

                if ($ok) {
                    header("Location: /public/index.php?route=admin&deleted=1");
                    exit;
                } else {
                    header("Location: /public/index.php?route=admin&error=1");
                    exit;
                }
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

                if ($ok) {
                    header("Location: /public/index.php?route=admin&deleted=1");
                    exit;
                } else {
                    header("Location: /public/index.php?route=admin&error=1");
                    exit;
                }
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

                if ($ok) {
                    header("Location: /public/index.php?route=admin&deleted=1");
                    exit;
                } else {
                    header("Location: /public/index.php?route=admin&error=1");
                    exit;
                }
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

                if ($ok) {
                    header("Location: /public/index.php?route=admin&deleted=1");
                    exit;
                } else {
                    header("Location: /public/index.php?route=admin&error=1");
                    exit;
                }
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

                if ($ok) {
                    header("Location: /public/index.php?route=admin&deleted=1");
                    exit;
                } else {
                    header("Location: /public/index.php?route=admin&error=1");
                    exit;
                }
            }
        }

        header("Location: /public/index.php?route=admin");
        exit;
    }
}
