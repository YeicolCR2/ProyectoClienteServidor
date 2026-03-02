
<?php

require_once "../Config/database.php";

$db = new Database();
$conn = $db->conectar();

$stmt = $conn->prepare("SELECT * FROM Pelicula");
$stmt->execute();

$peliculas = $stmt->fetchAll();

echo "<pre>";
print_r($peliculas);
echo "</pre>";