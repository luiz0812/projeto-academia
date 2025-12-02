<?php
include '../includes/sessao.php';
include '../includes/conexao.php';

if ($_GET['token'] !== $_SESSION['token']) {
    die("Token inválido!");
}

$id = $_GET['id'];

$sql = "DELETE FROM plano WHERE id=$id";

if ($conn->query($sql)) {
    header("Location: plano-lista.php?msg=Plano excluído!");
} else {
    echo "Erro ao excluir!";
}
