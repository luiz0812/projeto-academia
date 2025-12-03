<?php 
include "../includes/header.php";

$id = $_GET['id'];

$conn->query("DELETE FROM pagamentos WHERE id = $id");

header("Location: listar.php");
exit;
?>
