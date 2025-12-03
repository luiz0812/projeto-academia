<?php
$host = "localhost";
$user = "root"; // o seu user do xampp
$pass = "";     // se tiver senha coloque aqui
$dbname = "projeto_academia"; // nome do banco que criou no mysql

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro ao conectar com o banco: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");
?>
