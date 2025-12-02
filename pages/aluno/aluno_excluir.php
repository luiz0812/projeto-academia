<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

if ($_GET['token'] !== $_SESSION['token']) {
    die("Token inválido!");
}

$id = $_GET['id'];

$sql = "DELETE FROM aluno WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: aluno-lista.php?msg=Aluno excluído!");
} else {
    echo "Erro ao excluir!";
}
