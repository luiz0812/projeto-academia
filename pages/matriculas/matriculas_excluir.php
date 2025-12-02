<?php
require "../includes/sessao.php";
require "../includes/conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM matricula WHERE id=$id";

if ($conn->query($sql)) {
    echo "Matrícula excluída!";
} else {
    echo "Erro: " . $conn->error;
}
?>
