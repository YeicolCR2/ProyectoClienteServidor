<?php
session_start();

if(isset($_SESSION['usuario'])) {
    require_once '../app/views/home.php';
} else {
    require_once '../app/views/auth/login.php';
}
