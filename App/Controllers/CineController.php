<?php

require_once __DIR__ . '/../Models/Cine.php';

class CineController
{
    private $cineModel;

    public function __construct()
    {
        $this->cineModel = new Cine();
    }

    public function index()
    {
        $cines = $this->cineModel->getAll();
        require_once __DIR__ . '/../Views/cliente/cines.php';
    }
}